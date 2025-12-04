<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $tenant = app('tenant');
        $pelanggan = Pelanggan::where('tenant_id', $tenant->id)
            ->orderBy('nama_pelanggan')
            ->paginate(20);

        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        return view('pelanggan.form');
    }

    public function store(Request $request)
    {
        $tenant = app('tenant');
        $data = $request->validate([
            'nama_pelanggan' => ['required', 'string'],
            'nomor_hp' => ['nullable', 'string'],
            'alamat' => ['nullable', 'string'],
            'email' => ['nullable', 'email'],
        ]);

        $data['tenant_id'] = $tenant->id;

        Pelanggan::create($data);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil disimpan.');
    }

    public function edit(int $id)
    {
        $tenant = app('tenant');
        $pelanggan = Pelanggan::where('tenant_id', $tenant->id)->findOrFail($id);

        return view('pelanggan.form', compact('pelanggan'));
    }

    public function update(Request $request, int $id)
    {
        $tenant = app('tenant');
        $pelanggan = Pelanggan::where('tenant_id', $tenant->id)->findOrFail($id);

        $data = $request->validate([
            'nama_pelanggan' => ['required', 'string'],
            'nomor_hp' => ['nullable', 'string'],
            'alamat' => ['nullable', 'string'],
            'email' => ['nullable', 'email'],
        ]);

        $pelanggan->update($data);

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan diperbarui.');
    }

    public function destroy(int $id)
    {
        $tenant = app('tenant');
        $pelanggan = Pelanggan::where('tenant_id', $tenant->id)->findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan dihapus.');
    }
}
