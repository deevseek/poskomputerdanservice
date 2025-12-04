@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
    <div>
        <h1 class="text-2xl font-semibold text-slate-800 dark:text-slate-100">Dashboard</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400">Ringkasan performa toko hari ini</p>
    </div>
    <div class="flex gap-2">
        <button class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-primary hover:text-primary dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200">Buka Kasir</button>
        <button class="rounded-xl bg-primary px-4 py-2 text-sm font-semibold text-white shadow-lg transition hover:bg-primary/90">Buat Tiket Servis</button>
    </div>
</div>

<div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
    @php
        $stats = [
            ['title' => 'Total Penjualan Hari Ini', 'value' => 'Rp 7.850.000', 'change' => '+12%', 'icon' => 'shopping-bag'],
            ['title' => 'Servis Dalam Pengerjaan', 'value' => '18 tiket', 'change' => '+3 tiket', 'icon' => 'wrench'],
            ['title' => 'Produk Stok Menipis', 'value' => '12 produk', 'change' => 'Perlu restok', 'icon' => 'exclamation'],
            ['title' => 'Laba Bersih Bulan Ini', 'value' => 'Rp 42.300.000', 'change' => '+8%', 'icon' => 'chart'],
        ];
    @endphp
    @foreach($stats as $stat)
        <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-slate-700 dark:bg-slate-800">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-slate-500 dark:text-slate-400">{{ $stat['title'] }}</p>
                    <p class="mt-2 text-2xl font-semibold text-slate-900 dark:text-white">{{ $stat['value'] }}</p>
                    <span class="mt-3 inline-flex items-center gap-1 rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold text-primary dark:bg-primary/20">
                        {{ $stat['change'] }}
                    </span>
                </div>
                <span class="rounded-xl bg-primary/10 p-3 text-primary dark:bg-primary/20">
                    @switch($stat['icon'])
                        @case('shopping-bag')
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 7.5h16.5l-.9 10.8a1.5 1.5 0 0 1-1.5 1.2H6.15a1.5 1.5 0 0 1-1.5-1.2L3.75 7.5zm3 0a5.25 5.25 0 1 1 10.5 0" /></svg>
                            @break
                        @case('wrench')
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m4.75 19.25 6.5-6.5M9 5.75A4.25 4.25 0 0 1 14.75 11a4.25 4.25 0 0 1 5.25 4.08 4.25 4.25 0 0 1-7.08 3.17L5.75 11" /></svg>
                            @break
                        @case('exclamation')
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v3.75m0 3.75h.008M12 2.25 3.75 21h16.5L12 2.25z" /></svg>
                            @break
                        @case('chart')
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 19.5 7.5 12l4.5 6 6-10.5 3 5.25" /></svg>
                            @break
                    @endswitch
                </span>
            </div>
        </div>
    @endforeach
</div>

<div class="mt-8 grid gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold">Grafik Penjualan Bulanan</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400">Performa 12 bulan terakhir</p>
            </div>
            <div class="flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600 dark:bg-slate-700 dark:text-slate-200">
                <span class="h-2 w-2 rounded-full bg-primary"></span> Penjualan
            </div>
        </div>
        <div class="mt-4 h-72">
            <canvas id="salesChart"></canvas>
        </div>
    </div>
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold">Transaksi Terbaru</h2>
            <a href="#" class="text-sm font-semibold text-primary">Lihat semua</a>
        </div>
        <div class="mt-4 space-y-4">
            @foreach([['PEN-210','Kasir A','Rp 1.250.000'],['PEN-211','Kasir B','Rp 2.100.000'],['SRV-032','Servis','Rp 450.000'],['PEN-212','Online','Rp 800.000']] as $trx)
                <div class="flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50 px-4 py-3 text-sm dark:border-slate-700 dark:bg-slate-800/60">
                    <div>
                        <p class="font-semibold text-slate-800 dark:text-slate-100">{{ $trx[0] }}</p>
                        <p class="text-xs text-slate-500">{{ $trx[1] }}</p>
                    </div>
                    <p class="text-sm font-semibold text-primary">{{ $trx[2] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="mt-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-semibold">Ringkasan Transaksi Terbaru</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">Data singkat hari ini</p>
        </div>
        <button class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 shadow-sm transition hover:border-primary hover:text-primary dark:border-slate-700 dark:bg-slate-800">Ekspor</button>
    </div>
    <div class="mt-4 overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-700">
            <thead class="bg-slate-100 dark:bg-slate-800">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-slate-600 dark:text-slate-300">Kode</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-600 dark:text-slate-300">Jenis</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-600 dark:text-slate-300">Kasir</th>
                    <th class="px-4 py-3 text-right font-semibold text-slate-600 dark:text-slate-300">Total</th>
                    <th class="px-4 py-3 text-right font-semibold text-slate-600 dark:text-slate-300">Waktu</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                @foreach([
                    ['PEN-210','Penjualan','Admin','Rp 1.250.000','09:15'],
                    ['PEN-211','Penjualan','Sita','Rp 2.100.000','10:22'],
                    ['SRV-032','Servis','Admin','Rp 450.000','11:01'],
                    ['PEN-212','Penjualan','Dewa','Rp 800.000','12:45'],
                ] as $row)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/60">
                        <td class="px-4 py-3 font-semibold">{{ $row[0] }}</td>
                        <td class="px-4 py-3">{{ $row[1] }}</td>
                        <td class="px-4 py-3">{{ $row[2] }}</td>
                        <td class="px-4 py-3 text-right font-semibold text-primary">{{ $row[3] }}</td>
                        <td class="px-4 py-3 text-right text-slate-500">{{ $row[4] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
    const salesCtx = document.getElementById('salesChart');
    if (salesCtx) {
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
                datasets: [{
                    label: 'Penjualan',
                    data: [12,15,9,18,22,25,28,24,30,26,29,33],
                    borderColor: '#4F46E5',
                    backgroundColor: 'rgba(79,70,229,0.15)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 3,
                    pointRadius: 4,
                    pointBackgroundColor: '#06B6D4',
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: 'rgba(148,163,184,0.3)' } },
                    x: { grid: { display: false } }
                }
            }
        });
    }
</script>
@endpush
@endsection
