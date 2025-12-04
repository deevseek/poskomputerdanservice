<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\SparepartServis;
use App\Models\TiketServis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ServisController extends Controller
{
    private array $statusServis = [
        'Menunggu',
        'Diperiksa',
        'Menunggu Sparepart',
        'Dalam Perbaikan',
        'Selesai',
        'Dibatalkan',
    ];

    public function index()
    {
        $tenant = app('tenant');
        $tiket = TiketServis::with(['pelanggan', 'teknisi'])
            ->where('tenant_id', $tenant->id)
            ->latest()
            ->paginate(15);

        return view('servis.index', [
            'servisList' => $tiket,
            'statuses' => $this->statusServis,
        ]);
    }

    public function create()
    {
        $tenant = app('tenant');
        $pelanggan = Pelanggan::where('tenant_id', $tenant->id)->orderBy('nama_pelanggan')->get();
        $teknisi = User::where('tenant_id', $tenant->id)->whereIn('role', ['teknisi', 'admin'])->get();

        return view('servis.create', [
            'statuses' => $this->statusServis,
            'teknisiList' => $teknisi,
            'pelanggan' => $pelanggan,
        ]);
    }

    public function store(Request $request)
    {
        $tenant = app('tenant');
        $data = $request->validate([
            'pelanggan_id' => ['nullable', 'exists:pelanggan,id'],
            'teknisi_id' => ['nullable', 'exists:users,id'],
            'jenis_perangkat' => ['required', 'string'],
            'merk' => ['nullable', 'string'],
            'model' => ['nullable', 'string'],
            'nomor_seri' => ['nullable', 'string'],
            'keluhan' => ['required', 'string'],
            'biaya_jasa' => ['nullable', 'numeric', 'min:0'],
            'status_servis' => ['required', 'in:' . implode(',', $this->statusServis)],
            'catatan_teknisi' => ['nullable', 'string'],
        ]);

        $data['tenant_id'] = $tenant->id;

        TiketServis::create($data);

        return redirect()->route('servis.index')->with('success', 'Tiket servis berhasil dibuat.');
    }

    public function show(int $id)
    {
        $tenant = app('tenant');
        $servis = TiketServis::with(['pelanggan', 'teknisi', 'sparepartServis.produk'])
            ->where('tenant_id', $tenant->id)
            ->findOrFail($id);

        $spareparts = Produk::where('tenant_id', $tenant->id)
            ->where('jenis_produk', 'sparepart_servis')
            ->get();

        return view('servis.show', [
            'servis' => $servis,
            'statuses' => $this->statusServis,
            'spareparts' => $spareparts,
        ]);
    }

    public function updateStatus(int $id, Request $request)
    {
        $tenant = app('tenant');
        $request->validate([
            'status' => ['required', 'in:' . implode(',', $this->statusServis)],
            'catatan_teknisi' => ['nullable', 'string'],
        ]);

        $servis = TiketServis::where('tenant_id', $tenant->id)->findOrFail($id);
        $servis->update([
            'status_servis' => $request->status,
            'catatan_teknisi' => $request->catatan_teknisi,
        ]);

        return redirect()->route('servis.show', $id)->with('success', 'Status tiket diperbarui.');
    }

    public function tambahSparepart(int $id, Request $request)
    {
        $tenant = app('tenant');
        $data = $request->validate([
            'produk_id' => ['required', 'integer', 'exists:produk,id'],
            'qty' => ['required', 'integer', 'min:1'],
            'harga' => ['required', 'numeric', 'min:0'],
        ]);

        $servis = TiketServis::where('tenant_id', $tenant->id)->findOrFail($id);
        $produk = Produk::where('tenant_id', $tenant->id)->findOrFail($data['produk_id']);

        if ($data['qty'] > $produk->stok) {
            throw ValidationException::withMessages([
                'qty' => 'Stok produk tidak mencukupi.',
            ]);
        }

        DB::transaction(function () use ($produk, $data, $servis, $tenant) {
            $subtotal = $data['qty'] * $data['harga'];

            SparepartServis::create([
                'tiket_servis_id' => $servis->id,
                'produk_id' => $produk->id,
                'qty' => $data['qty'],
                'harga' => $data['harga'],
                'subtotal' => $subtotal,
            ]);

            $produk->decrement('stok', $data['qty']);
        });

        return redirect()->route('servis.show', $id)->with('success', 'Sparepart berhasil ditambahkan.');
    }
}
