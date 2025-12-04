<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualan;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Pembayaran;
use App\Models\PergerakanStok;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class KasirController extends Controller
{
    public function index(Request $request)
    {
        if (! auth()->user()->hasPermission('kelola_penjualan')) {
            abort(403);
        }

        $tenant = app('tenant');

        if ($request->ajax()) {
            $search = $request->query('q');
            $produkQuery = Produk::where('tenant_id', $tenant->id)
                ->when($search, function ($query) use ($search) {
                    $query->where('nama_produk', 'like', "%{$search}%")
                        ->orWhere('sku', 'like', "%{$search}%");
                })
                ->orderBy('nama_produk')
                ->limit(20)
                ->get(['id', 'nama_produk', 'stok', 'harga_jual']);

            return response()->json($produkQuery);
        }

        $produk = Produk::where('tenant_id', $tenant->id)
            ->orderBy('nama_produk')
            ->limit(20)
            ->get(['id', 'nama_produk', 'stok', 'harga_jual']);

        $pelanggan = Pelanggan::where('tenant_id', $tenant->id)
            ->orderBy('nama_pelanggan')
            ->get();

        return view('kasir.index', compact('produk', 'pelanggan'));
    }

    public function proses(Request $request)
    {
        if (! auth()->user()->hasPermission('kelola_penjualan')) {
            abort(403);
        }

        $tenant = app('tenant');

        $validated = $request->validate([
            'pelanggan_id' => ['nullable', 'integer', 'exists:pelanggan,id'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.produk_id' => ['required', 'integer', 'exists:produk,id'],
            'items.*.qty' => ['required', 'integer', 'min:1'],
            'items.*.harga_satuan' => ['required', 'numeric', 'min:0'],
            'metode_pembayaran' => ['required', 'in:tunai,transfer,qris'],
            'bayar' => ['required', 'numeric', 'min:0'],
            'catatan' => ['nullable', 'string'],
        ]);

        $penjualan = null;

        DB::transaction(function () use ($tenant, $validated, &$penjualan) {
            $total = 0;
            $itemData = [];

            foreach ($validated['items'] as $item) {
                $produk = Produk::where('tenant_id', $tenant->id)->findOrFail($item['produk_id']);

                if ($item['qty'] > $produk->stok) {
                    throw ValidationException::withMessages([
                        'items' => "Stok untuk {$produk->nama_produk} tidak mencukupi.",
                    ]);
                }

                $subtotal = $item['qty'] * $item['harga_satuan'];
                $total += $subtotal;

                $itemData[] = [
                    'produk' => $produk,
                    'qty' => $item['qty'],
                    'harga_satuan' => $item['harga_satuan'],
                    'subtotal' => $subtotal,
                ];
            }

            $bayar = $validated['bayar'];
            $kembalian = max($bayar - $total, 0);

            $penjualan = Penjualan::create([
                'tenant_id' => $tenant->id,
                'pelanggan_id' => $validated['pelanggan_id'] ?? null,
                'total' => $total,
                'bayar' => $bayar,
                'kembalian' => $kembalian,
                'metode_pembayaran' => $validated['metode_pembayaran'],
                'catatan' => $validated['catatan'] ?? null,
            ]);

            foreach ($itemData as $detail) {
                ItemPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'produk_id' => $detail['produk']->id,
                    'qty' => $detail['qty'],
                    'harga_satuan' => $detail['harga_satuan'],
                    'subtotal' => $detail['subtotal'],
                ]);

                $detail['produk']->decrement('stok', $detail['qty']);

                PergerakanStok::create([
                    'tenant_id' => $tenant->id,
                    'produk_id' => $detail['produk']->id,
                    'jenis' => 'stok_keluar',
                    'referensi' => 'PENJUALAN-' . $penjualan->id,
                    'jumlah' => $detail['qty'],
                    'catatan' => 'Penjualan POS',
                ]);
            }

            Pembayaran::create([
                'penjualan_id' => $penjualan->id,
                'nominal' => $bayar,
                'metode' => $validated['metode_pembayaran'],
                'keterangan' => 'Pembayaran melalui POS',
            ]);
        });

        return redirect()->route('kasir.struk', $penjualan->id)->with('success', 'Transaksi berhasil diproses.');
    }

    public function riwayat()
    {
        if (! auth()->user()->hasPermission('kelola_penjualan')) {
            abort(403);
        }

        $tenant = app('tenant');
        $penjualan = Penjualan::with(['pelanggan'])
            ->where('tenant_id', $tenant->id)
            ->latest()
            ->paginate(15);

        return view('kasir.riwayat', compact('penjualan'));
    }

    public function struk($id)
    {
        if (! auth()->user()->hasPermission('kelola_penjualan')) {
            abort(403);
        }

        $tenant = app('tenant');
        $penjualan = Penjualan::with(['itemPenjualan.produk', 'pelanggan'])
            ->where('tenant_id', $tenant->id)
            ->findOrFail($id);

        return view('kasir.struk', compact('penjualan', 'tenant'));
    }
}
