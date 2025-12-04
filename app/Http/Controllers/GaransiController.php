<?php

namespace App\Http\Controllers;

use App\Models\Garansi;
use App\Models\KlaimGaransi;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\TiketServis;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GaransiController extends Controller
{
    private array $statusGaransi = ['aktif', 'kadaluarsa', 'dibatalkan'];

    public function index()
    {
        $tenant = app('tenant');
        $garansiList = Garansi::with('pelanggan')
            ->where('tenant_id', $tenant->id)
            ->latest()
            ->paginate(15);

        return view('garansi.index', compact('garansiList'));
    }

    public function create()
    {
        $tenant = app('tenant');
        $pelanggan = Pelanggan::where('tenant_id', $tenant->id)->orderBy('nama_pelanggan')->get();
        $penjualan = Penjualan::where('tenant_id', $tenant->id)->latest()->get();
        $servis = TiketServis::where('tenant_id', $tenant->id)->latest()->get();

        return view('garansi.form', [
            'pelanggan' => $pelanggan,
            'penjualan' => $penjualan,
            'servis' => $servis,
        ]);
    }

    public function store(Request $request)
    {
        $tenant = app('tenant');
        $data = $request->validate([
            'pelanggan_id' => ['nullable', 'exists:pelanggan,id'],
            'jenis' => ['required', 'in:produk,servis'],
            'referensi_id' => ['required', 'integer'],
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_berakhir' => ['required', 'date', 'after:tanggal_mulai'],
            'syarat_ketentuan' => ['nullable', 'string'],
            'status' => ['required', 'in:' . implode(',', $this->statusGaransi)],
        ]);

        $data['tenant_id'] = $tenant->id;

        Garansi::create($data);

        return redirect()->route('garansi.index')->with('success', 'Garansi berhasil disimpan.');
    }

    public function show(Garansi $garansi)
    {
        $this->authorizeTenant($garansi->tenant_id);

        $garansi->load(['pelanggan', 'klaimGaransi']);

        return view('garansi.detail', [
            'garansi' => $garansi,
            'klaimList' => $garansi->klaimGaransi,
        ]);
    }

    public function cek(Request $request)
    {
        $tenant = app('tenant');
        $keyword = $request->input('q');
        $garansi = null;

        if ($keyword) {
            $garansi = Garansi::with('pelanggan')
                ->where('tenant_id', $tenant->id)
                ->where(function ($query) use ($keyword) {
                    $query->where('referensi_id', $keyword)
                        ->orWhereHas('pelanggan', function ($sub) use ($keyword) {
                            $sub->where('nama_pelanggan', 'like', "%{$keyword}%");
                        });
                })
                ->first();
        }

        return view('garansi.cek', [
            'garansi' => $garansi,
            'keyword' => $keyword,
        ]);
    }

    private function authorizeTenant(int $tenantId): void
    {
        $tenant = app('tenant');

        if ($tenant && $tenant->id !== $tenantId) {
            abort(403);
        }
    }
}
