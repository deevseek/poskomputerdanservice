<?php

namespace App\Http\Controllers;

use App\Models\{Produk, KategoriProduk, Supplier, PergerakanStok};
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $tenantId = $request->user()->tenant_id;
        $produk = Produk::where('tenant_id', $tenantId)->with('kategoriProduk')->get();
        return view('inventory.produk.index', compact('produk'));
    }

    public function create(Request $request)
    {
        $tenantId = $request->user()->tenant_id;
        $kategori = KategoriProduk::where('tenant_id', $tenantId)->get();
        $supplier = Supplier::where('tenant_id', $tenantId)->get();
        return view('inventory.produk.form', ['produk' => new Produk(), 'kategori' => $kategori, 'supplier' => $supplier]);
    }

    public function store(Request $request)
    {
        $tenantId = $request->user()->tenant_id;
        if (!auth()->user()->hasPermission('kelola_produk')) abort(403);

        $data = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100',
            'kategori_id' => 'nullable|exists:kategori_produk,id',
            'jenis_produk' => 'required|in:barang_fisik,sparepart_servis',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $data['tenant_id'] = $tenantId;
        $produk = Produk::create($data);

        PergerakanStok::create([
            'tenant_id' => $tenantId,
            'produk_id' => $produk->id,
            'tipe' => 'stok_masuk',
            'sumber' => 'pembelian',
            'jumlah' => $data['stok'],
            'keterangan' => 'Stok awal produk',
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil disimpan.');
    }

    public function edit(Request $request, int $id)
    {
        $tenantId = $request->user()->tenant_id;
        $produk = Produk::where('tenant_id', $tenantId)->findOrFail($id);
        $kategori = KategoriProduk::where('tenant_id', $tenantId)->get();
        $supplier = Supplier::where('tenant_id', $tenantId)->get();
        return view('inventory.produk.form', compact('produk', 'kategori', 'supplier'));
    }

    public function update(Request $request, int $id)
    {
        $tenantId = $request->user()->tenant_id;
        if (!auth()->user()->hasPermission('kelola_produk')) abort(403);

        $produk = Produk::where('tenant_id', $tenantId)->findOrFail($id);

        $data = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100',
            'kategori_id' => 'nullable|exists:kategori_produk,id',
            'jenis_produk' => 'required|in:barang_fisik,sparepart_servis',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Request $request, int $id)
    {
        $tenantId = $request->user()->tenant_id;
        if (!auth()->user()->hasPermission('kelola_produk')) abort(403);

        $produk = Produk::where('tenant_id', $tenantId)->findOrFail($id);
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk dihapus.');
    }
}
