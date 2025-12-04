<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class GaransiController extends Controller
{
    private array $jenisGaransi = ['produk', 'servis'];

    public function index()
    {
        $garansiList = $this->garansiCollection()
            ->map(fn ($garansi) => $this->tambahkanStatus($garansi));

        return view('garansi.index', [
            'garansiList' => $garansiList,
        ]);
    }

    public function create()
    {
        return view('garansi.form', [
            'jenisGaransi' => $this->jenisGaransi,
            'penjualan' => $this->samplePenjualan(),
            'servis' => $this->sampleServis(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_garansi' => ['required', 'in:' . implode(',', $this->jenisGaransi)],
            'referensi_id' => ['required', 'integer'],
            'referensi_nomor' => ['required', 'string'],
            'pelanggan' => ['required', 'string'],
            'nomor_hp' => ['required', 'string'],
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_berakhir' => ['required', 'date', 'after:tanggal_mulai'],
            'syarat_ketentuan' => ['required', 'string'],
        ]);

        return redirect()
            ->route('garansi.index')
            ->with('success', 'Garansi baru berhasil disiapkan untuk referensi ' . $request->referensi_nomor . ' (simulasi tanpa penyimpanan data).');
    }

    public function show(int $garansi)
    {
        $garansiData = $this->garansiCollection()->firstWhere('id', $garansi);
        abort_if(!$garansiData, 404);

        $garansiData = $this->tambahkanStatus($garansiData);

        return view('garansi.detail', [
            'garansi' => $garansiData,
            'klaimList' => $this->sampleKlaimGaransi($garansi),
        ]);
    }

    public function cek(Request $request)
    {
        $keyword = $request->query('q');
        $garansiDitemukan = null;

        if ($keyword) {
            $garansiDitemukan = $this->garansiCollection()
                ->first(function ($garansi) use ($keyword) {
                    $keywordLower = strtolower($keyword);

                    return str_contains(strtolower($garansi['referensi_nomor']), $keywordLower)
                        || str_contains(strtolower($garansi['nomor_hp']), $keywordLower);
                });

            if ($garansiDitemukan) {
                $garansiDitemukan = $this->tambahkanStatus($garansiDitemukan);
            }
        }

        return view('garansi.cek', [
            'keyword' => $keyword,
            'garansi' => $garansiDitemukan,
        ]);
    }

    public static function sampleGaransiData(): array
    {
        return [
            [
                'id' => 1,
                'jenis_garansi' => 'produk',
                'referensi_id' => 101,
                'referensi_nomor' => 'INV-2024-001',
                'pelanggan' => 'Andi Wijaya',
                'nomor_hp' => '0812-3456-7890',
                'tanggal_mulai' => '2024-01-15',
                'tanggal_berakhir' => '2024-07-15',
                'syarat_ketentuan' => 'Garansi toko 6 bulan untuk kerusakan pabrikasi. Tidak berlaku untuk kerusakan fisik.',
            ],
            [
                'id' => 2,
                'jenis_garansi' => 'servis',
                'referensi_id' => 401,
                'referensi_nomor' => 'SV-002',
                'pelanggan' => 'Siti Rahma',
                'nomor_hp' => '0821-1111-2222',
                'tanggal_mulai' => '2024-03-01',
                'tanggal_berakhir' => '2024-06-01',
                'syarat_ketentuan' => 'Garansi servis 3 bulan untuk pekerjaan penggantian layar. Tidak mencakup kerusakan akibat benturan.',
            ],
            [
                'id' => 3,
                'jenis_garansi' => 'produk',
                'referensi_id' => 105,
                'referensi_nomor' => 'INV-2023-120',
                'pelanggan' => 'Bagus Pratama',
                'nomor_hp' => '0877-8888-9999',
                'tanggal_mulai' => '2023-09-10',
                'tanggal_berakhir' => '2024-03-10',
                'syarat_ketentuan' => 'Garansi distributor 6 bulan. Wajib menyertakan invoice saat klaim.',
            ],
        ];
    }

    public static function sampleKlaimGaransi(int $garansiId): array
    {
        $klaim = [
            [
                'id' => 1,
                'garansi_id' => 1,
                'pelanggan' => 'Andi Wijaya',
                'deskripsi_keluhan' => 'Keyboard tiba-tiba tidak berfungsi.',
                'status_klaim' => 'Dalam Proses',
                'catatan_penyelesaian' => 'Menunggu stok keyboard baru.',
                'tanggal_dibuat' => '2024-05-10',
            ],
            [
                'id' => 2,
                'garansi_id' => 2,
                'pelanggan' => 'Siti Rahma',
                'deskripsi_keluhan' => 'Layar kembali ghost touch setelah diganti.',
                'status_klaim' => 'Diajukan',
                'catatan_penyelesaian' => null,
                'tanggal_dibuat' => '2024-04-05',
            ],
            [
                'id' => 3,
                'garansi_id' => 3,
                'pelanggan' => 'Bagus Pratama',
                'deskripsi_keluhan' => 'Power supply restart sendiri.',
                'status_klaim' => 'Ditolak',
                'catatan_penyelesaian' => 'Kerusakan akibat modifikasi pihak ketiga.',
                'tanggal_dibuat' => '2024-02-01',
            ],
        ];

        return collect($klaim)
            ->where('garansi_id', $garansiId)
            ->values()
            ->all();
    }

    private function garansiCollection(): Collection
    {
        return collect(self::sampleGaransiData());
    }

    private function tambahkanStatus(array $garansi): array
    {
        $berakhir = Carbon::parse($garansi['tanggal_berakhir']);
        $garansi['status'] = $berakhir->isFuture() ? 'Aktif' : 'Kadaluarsa';
        return $garansi;
    }

    private function samplePenjualan(): array
    {
        return [
            ['id' => 101, 'nomor' => 'INV-2024-001', 'pelanggan' => 'Andi Wijaya'],
            ['id' => 102, 'nomor' => 'INV-2024-018', 'pelanggan' => 'Sinta Dewi'],
            ['id' => 105, 'nomor' => 'INV-2023-120', 'pelanggan' => 'Bagus Pratama'],
        ];
    }

    private function sampleServis(): array
    {
        return [
            ['id' => 401, 'nomor' => 'SV-002', 'pelanggan' => 'Siti Rahma'],
            ['id' => 402, 'nomor' => 'SV-009', 'pelanggan' => 'Indra Lesmana'],
        ];
    }
}
