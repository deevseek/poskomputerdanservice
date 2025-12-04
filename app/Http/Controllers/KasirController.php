<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualan;
use App\Models\Penjualan;
use App\Models\PergerakanStok;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class KasirController extends Controller
{
    public function index(Request $request)
    {
        $tenant = app('tenant');
        $search = $request->input('q');

        $produkQuery = Produk::where('tenant_id', $tenant->id)
            ->orderBy('nama_produk');

        if ($search) {
            $produkQuery->where(function ($query) use ($search) {
                $query->where('nama_produk', 'like', "%{$search}%")
                    ->orWhere('kode_sku', 'like', "%{$search}%");
            });
        }

        $produk = $produkQuery->get(['id', 'nama_produk', 'stok', 'harga_jual']);

        return view('kasir.index', [
            'produk' => $produk,
            'search' => $search,
        ]);
    }

    public function store(Request $request)
    {
        $tenant = app('tenant');

        $validated = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.produk_id' => ['required', 'integer', 'exists:produk,id'],
            'items.*.qty' => ['required', 'integer', 'min:1'],
            'items.*.harga_satuan' => ['required', 'numeric', 'min:0'],
            'items.*.diskon' => ['nullable', 'numeric', 'min:0'],
            'bayar' => ['required', 'numeric', 'min:0'],
            'metode_pembayaran' => ['nullable', 'in:tunai,transfer,qris'],
        ]);

        $metodePembayaran = $validated['metode_pembayaran'] ?? 'tunai';
        $itemsInput = $validated['items'];

        $penjualan = null;

        DB::transaction(function () use ($itemsInput, $tenant, $validated, $metodePembayaran, &$penjualan) {
            $subtotal = 0;
            $itemData = [];

            foreach ($itemsInput as $item) {
                $produk = Produk::where('tenant_id', $tenant->id)->findOrFail($item['produk_id']);

                if ($item['qty'] > $produk->stok) {
                    throw ValidationException::withMessages([
                        'items' => "Stok untuk {$produk->nama_produk} tidak mencukupi.",
                    ]);
                }

                $diskonPerUnit = $item['diskon'] ?? 0;
                $hargaNet = max($item['harga_satuan'] - $diskonPerUnit, 0);
                $totalItem = $hargaNet * $item['qty'];

                $subtotal += $totalItem;

                $itemData[] = [
                    'produk' => $produk,
                    'qty' => $item['qty'],
                    'harga' => $hargaNet,
                    'total' => $totalItem,
                ];
            }

            $total = $subtotal;
            $bayar = $validated['bayar'];
            $kembalian = max($bayar - $total, 0);

            $penjualan = Penjualan::create([
                'tenant_id' => $tenant->id,
                'pelanggan_id' => null,
                'nomor_invoice' => 'INV-' . now()->format('YmdHis') . '-' . $tenant->id,
                'subtotal' => $subtotal,
                'diskon' => 0,
                'pajak' => 0,
                'total' => $total,
                'dibayar' => $bayar,
                'kembalian' => $kembalian,
                'metode_pembayaran' => $metodePembayaran,
            ]);

            foreach ($itemData as $detail) {
                ItemPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'produk_id' => $detail['produk']->id,
                    'qty' => $detail['qty'],
                    'harga' => $detail['harga'],
                    'total' => $detail['total'],
                ]);

                $detail['produk']->decrement('stok', $detail['qty']);

                PergerakanStok::create([
                    'tenant_id' => $tenant->id,
                    'produk_id' => $detail['produk']->id,
                    'jenis' => 'stok_keluar',
                    'referensi' => $penjualan->nomor_invoice,
                    'jumlah' => $detail['qty'],
                    'catatan' => 'Penjualan',
                ]);
            }
        });

        return redirect()
            ->route('kasir.index')
            ->with('success', 'Transaksi berhasil disimpan.');
    }
}
