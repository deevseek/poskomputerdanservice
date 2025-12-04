<?php

namespace App\Http\Controllers;

use App\Models\TransaksiKeuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class KeuanganController extends Controller
{
    public function index(Request $request)
    {
        $tenantId = $request->user()->tenant_id;
        $transaksi = TransaksiKeuangan::where('tenant_id', $tenantId)
            ->orderByDesc('tanggal_transaksi')
            ->get();

        return view('keuangan.index', compact('transaksi'));
    }

    public function create()
    {
        return view('keuangan.form');
    }

    public function store(Request $request)
    {
        $tenantId = $request->user()->tenant_id;
        $data = $request->validate([
            'tipe' => 'required|in:pemasukan,pengeluaran',
            'kategori' => 'required|string|max:150',
            'nominal' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'tanggal_transaksi' => 'required|date',
        ]);

        $data['tenant_id'] = $tenantId;
        TransaksiKeuangan::create($data);

        return redirect()->route('keuangan.index')->with('success', 'Transaksi keuangan tersimpan.');
    }

    public function laporan(Request $request)
    {
        return $this->labaRugi($request);
    }

    public function labaRugi(Request $request)
    {
        $tenantId = $request->user()->tenant_id;
        $transaksi = TransaksiKeuangan::where('tenant_id', $tenantId)->get();

        $totalPemasukan = $transaksi->where('tipe', 'pemasukan')->sum('nominal');
        $totalPengeluaran = $transaksi->where('tipe', 'pengeluaran')->sum('nominal');
        $labaKotor = $totalPemasukan;
        $labaBersih = $totalPemasukan - $totalPengeluaran;

        return view('keuangan.laba_rugi', compact('totalPemasukan', 'totalPengeluaran', 'labaKotor', 'labaBersih'));
    }
}
