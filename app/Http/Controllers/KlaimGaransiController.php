<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KlaimGaransiController extends Controller
{
    private array $statusKlaim = [
        'Diajukan',
        'Disetujui',
        'Ditolak',
        'Dalam Proses',
        'Selesai',
    ];

    public function create(int $garansi)
    {
        $garansiData = collect(GaransiController::sampleGaransiData())->firstWhere('id', $garansi);
        abort_if(!$garansiData, 404);

        return view('garansi.klaim_form', [
            'garansi' => $garansiData,
            'statusKlaim' => $this->statusKlaim,
        ]);
    }

    public function store(int $garansi, Request $request)
    {
        $garansiData = collect(GaransiController::sampleGaransiData())->firstWhere('id', $garansi);
        abort_if(!$garansiData, 404);

        $request->validate([
            'deskripsi_keluhan' => ['required', 'string'],
            'status_klaim' => ['required', 'in:' . implode(',', $this->statusKlaim)],
            'catatan_penyelesaian' => ['nullable', 'string'],
        ]);

        return redirect()
            ->route('garansi.show', $garansi)
            ->with('success', 'Klaim garansi telah diajukan dengan status awal: ' . $request->status_klaim . ' (simulasi tanpa penyimpanan data).');
    }
}
