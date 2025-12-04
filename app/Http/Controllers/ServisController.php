<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServisController extends Controller
{
    private array $statusServis = [
        'Menunggu',
        'Diperiksa',
        'Menunggu Sparepart',
        'Sedang Dikerjakan',
        'Selesai',
        'Dibatalkan',
    ];

    public function index(Request $request)
    {
        $statusFilter = $request->query('status');
        $servisList = collect($this->sampleServisData());

        if ($statusFilter) {
            $servisList = $servisList->where('status', $statusFilter);
        }

        return view('servis.index', [
            'servisList' => $servisList->values(),
            'statuses' => $this->statusServis,
            'statusFilter' => $statusFilter,
        ]);
    }

    public function create()
    {
        return view('servis.create', [
            'statuses' => $this->statusServis,
            'teknisiList' => ['Raka', 'Siti', 'Bagus'],
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => ['required', 'string'],
            'kontak' => ['required', 'string'],
            'perangkat' => ['required', 'string'],
            'keluhan' => ['required', 'string'],
            'teknisi' => ['required', 'string'],
        ]);

        return redirect()
            ->route('servis.index')
            ->with('success', 'Tiket servis berhasil dibuat (contoh simulasi tanpa penyimpanan data).');
    }

    public function show(int $id)
    {
        $servis = collect($this->sampleServisData())->firstWhere('id', $id);

        abort_if(!$servis, 404);

        $spareparts = collect($this->produkContoh());

        return view('servis.show', [
            'servis' => $servis,
            'statuses' => $this->statusServis,
            'spareparts' => $spareparts,
        ]);
    }

    public function updateStatus(int $id, Request $request)
    {
        $request->validate([
            'status' => ['required', 'in:' . implode(',', $this->statusServis)],
        ]);

        return redirect()
            ->route('servis.show', $id)
            ->with('success', 'Status tiket diperbarui menjadi: ' . $request->status . ' (contoh simulasi).');
    }

    public function tambahSparepart(int $id, Request $request)
    {
        $request->validate([
            'produk_id' => ['required', 'integer'],
            'jumlah' => ['required', 'integer', 'min:1'],
        ]);

        return redirect()
            ->route('servis.show', $id)
            ->with('success', 'Sparepart berhasil ditambahkan ke tiket (contoh simulasi).');
    }

    private function sampleServisData(): array
    {
        return [
            [
                'id' => 1,
                'kode' => 'SV-001',
                'pelanggan' => 'Andi Wijaya',
                'kontak' => '0812-3456-7890',
                'perangkat' => 'Laptop - Dell Inspiron 14',
                'keluhan' => 'Laptop mati total setelah terkena air.',
                'teknisi' => 'Raka',
                'status' => 'Diperiksa',
                'catatan' => 'Perlu pengecekan motherboard dan keyboard.',
            ],
            [
                'id' => 2,
                'kode' => 'SV-002',
                'pelanggan' => 'Siti Rahma',
                'kontak' => '0821-1111-2222',
                'perangkat' => 'Handphone - Samsung A52',
                'keluhan' => 'Layar retak dan sentuh kurang responsif.',
                'teknisi' => 'Siti',
                'status' => 'Menunggu Sparepart',
                'catatan' => 'Menunggu stok layar pengganti.',
            ],
            [
                'id' => 3,
                'kode' => 'SV-003',
                'pelanggan' => 'Bagus Pratama',
                'kontak' => '0877-8888-9999',
                'perangkat' => 'PC Rakitan',
                'keluhan' => 'Sering restart sendiri saat digunakan.',
                'teknisi' => 'Bagus',
                'status' => 'Sedang Dikerjakan',
                'catatan' => 'Tes PSU dan RAM, kemungkinan overheat.',
            ],
        ];
    }

    private function produkContoh(): array
    {
        return [
            ['id' => 101, 'nama' => 'Layar Samsung A52', 'stok' => 3],
            ['id' => 102, 'nama' => 'Keyboard Laptop Dell', 'stok' => 5],
            ['id' => 103, 'nama' => 'RAM DDR4 8GB', 'stok' => 7],
            ['id' => 104, 'nama' => 'Thermal Paste Premium', 'stok' => 10],
        ];
    }
}
