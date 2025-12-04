<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $kategori = KategoriProduk::where('tenant_id', $request->user()->tenant_id)->get();
        return view('inventory.kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);
        $data['tenant_id'] = $request->user()->tenant_id;
        KategoriProduk::create($data);
        return redirect()->route('kategori.index')->with('success', 'Kategori tersimpan.');
    }
}
