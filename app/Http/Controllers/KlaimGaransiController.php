<?php

namespace App\Http\Controllers;

use App\Models\Garansi;
use App\Models\KlaimGaransi;
use Illuminate\Http\Request;

class KlaimGaransiController extends Controller
{
    private array $statusKlaim = ['diajukan', 'disetujui', 'ditolak', 'dalam_proses', 'selesai'];

    public function create(Garansi $garansi)
    {
        $this->authorizeTenant($garansi->tenant_id);

        return view('garansi.klaim_form', [
            'garansi' => $garansi,
            'statusKlaim' => $this->statusKlaim,
        ]);
    }

    public function store(Request $request, Garansi $garansi)
    {
        $this->authorizeTenant($garansi->tenant_id);

        $data = $request->validate([
            'pelanggan_id' => ['nullable', 'exists:pelanggan,id'],
            'deskripsi_keluhan' => ['required', 'string'],
            'teknisi_id' => ['nullable', 'exists:users,id'],
            'status_klaim' => ['required', 'in:' . implode(',', $this->statusKlaim)],
            'catatan_penyelesaian' => ['nullable', 'string'],
        ]);

        $data['garansi_id'] = $garansi->id;
        $data['tenant_id'] = $garansi->tenant_id;

        KlaimGaransi::create($data);

        return redirect()->route('garansi.show', $garansi->id)->with('success', 'Klaim garansi berhasil dikirim.');
    }

    private function authorizeTenant(int $tenantId): void
    {
        $tenant = app('tenant');

        if ($tenant && $tenant->id !== $tenantId) {
            abort(403);
        }
    }
}
