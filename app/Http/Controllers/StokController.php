<?php

namespace App\Http\Controllers;

use App\Models\{Produk, PergerakanStok};
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index(Request $request)
    {
        $produk = Produk::where('tenant_id', $request->user()->tenant_id)->get();
        $riwayat = PergerakanStok::where('tenant_id', $request->user()->tenant_id)
            ->with('produk')
            ->orderByDesc('created_at')
            ->get();
        return view('inventory.stok.index', compact('produk', 'riwayat'));
    }

    public function tambah(Request $request)
    {
        if (!auth()->user()->hasPermission('kelola_stok')) abort(403);

        $data = $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $produk = Produk::findOrFail($data['produk_id']);
        $produk->increment('stok', $data['jumlah']);

        PergerakanStok::create([
            'tenant_id' => $produk->tenant_id,
            'produk_id' => $produk->id,
            'tipe' => 'stok_masuk',
            'sumber' => 'penyesuaian',
            'jumlah' => $data['jumlah'],
            'keterangan' => $data['keterangan'] ?? 'Tambah stok',
        ]);

        return redirect()->route('stok.index')->with('success', 'Stok berhasil ditambah.');
    }

    public function kurangi(Request $request)
    {
        if (!auth()->user()->hasPermission('kelola_stok')) abort(403);

        $data = $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $produk = Produk::findOrFail($data['produk_id']);
        $produk->decrement('stok', $data['jumlah']);

        PergerakanStok::create([
            'tenant_id' => $produk->tenant_id,
            'produk_id' => $produk->id,
            'tipe' => 'stok_keluar',
            'sumber' => 'penyesuaian',
            'jumlah' => $data['jumlah'],
            'keterangan' => $data['keterangan'] ?? 'Kurangi stok',
        ]);

        return redirect()->route('stok.index')->with('success', 'Stok berhasil dikurangi.');
    }
}
