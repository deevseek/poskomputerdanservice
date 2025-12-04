<?php

namespace App\Http\Controllers;

use App\Models\PengaturanToko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    public function index(Request $request)
    {
        $tenantId = $request->user()->tenant_id;
        $pengaturan = $this->ambilPengaturan($tenantId);

        return view('pengaturan.index', [
            'pengaturan' => $pengaturan,
        ]);
    }

    public function simpan(Request $request)
    {
        $tenantId = $request->user()->tenant_id;

        $validated = $request->validate([
            'nama_toko' => 'required|string|max:255',
            'alamat_toko' => 'nullable|string|max:500',
            'nomor_hp' => 'nullable|string|max:50',
            'logo' => 'nullable|image|max:2048',
            'printer_mode' => 'required|in:Thermal,A4',
            'pajak_persen' => 'nullable|numeric|min:0|max:100',
            'masa_garansi_default' => 'nullable|integer|min:0',
            'bahasa' => 'required|string|max:50',
            'zona_waktu' => 'required|string|max:100',
        ], [
            'nama_toko.required' => 'Nama toko wajib diisi.',
            'printer_mode.required' => 'Pilih mode printer.',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logo_toko', 'public');
        } else {
            $validated['logo'] = $this->ambilPengaturan($tenantId)['logo'] ?? null;
        }

        foreach ($validated as $key => $value) {
            $this->simpanPengaturan($tenantId, $key, $value);
        }

        return redirect()->route('pengaturan.index')->with('success', 'Pengaturan berhasil disimpan.');
    }

    protected function ambilPengaturan(int $tenantId): array
    {
        return PengaturanToko::where('tenant_id', $tenantId)
            ->pluck('value', 'key')
            ->toArray();
    }

    protected function simpanPengaturan(int $tenantId, string $key, $value): void
    {
        PengaturanToko::updateOrCreate(
            ['tenant_id' => $tenantId, 'key' => $key],
            ['value' => $value]
        );
    }
}
