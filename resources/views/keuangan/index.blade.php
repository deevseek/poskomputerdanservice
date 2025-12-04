@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
    <div>
        <h1 class="text-2xl font-semibold">Keuangan</h1>
        <p class="text-sm text-slate-500">Pantau arus kas dan laporan</p>
    </div>
    <button class="rounded-xl bg-primary px-4 py-2 text-sm font-semibold text-white shadow hover:bg-primary/90">Tambah Transaksi</button>
</div>

<div class="grid gap-6 lg:grid-cols-3">
    <div class="space-y-6 lg:col-span-2">
        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-700 dark:bg-slate-800">
            <div class="flex flex-wrap items-center gap-3 text-sm">
                <input type="date" class="rounded-xl border border-slate-200 bg-white px-3 py-2 outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900" />
                <input type="date" class="rounded-xl border border-slate-200 bg-white px-3 py-2 outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900" />
                <select class="rounded-xl border border-slate-200 bg-white px-3 py-2 outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900">
                    <option>Kategori</option>
                    <option>Penjualan</option>
                    <option>Servis</option>
                    <option>Operasional</option>
                </select>
                <div class="relative">
                    <input type="text" placeholder="Cari transaksi" class="w-48 rounded-xl border border-slate-200 bg-slate-50 px-4 py-2 outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" />
                    <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607z" /></svg>
                    </span>
                </div>
            </div>
            <div class="mt-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-700">
                    <thead class="bg-slate-100 dark:bg-slate-800">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">Tanggal</th>
                            <th class="px-4 py-3 text-left font-semibold">Deskripsi</th>
                            <th class="px-4 py-3 text-left font-semibold">Kategori</th>
                            <th class="px-4 py-3 text-right font-semibold">Nominal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        @foreach([
                            ['12 Jan','Penjualan POS','Penjualan','Rp 1.250.000'],
                            ['11 Jan','Servis Laptop','Servis','Rp 450.000'],
                            ['10 Jan','Biaya Listrik','Operasional','- Rp 800.000'],
                        ] as $row)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/60">
                                <td class="px-4 py-3">{{ $row[0] }}</td>
                                <td class="px-4 py-3">{{ $row[1] }}</td>
                                <td class="px-4 py-3">{{ $row[2] }}</td>
                                <td class="px-4 py-3 text-right font-semibold {{ str_contains($row[3], '-') ? 'text-rose-500' : 'text-emerald-600' }}">{{ $row[3] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-700 dark:bg-slate-800">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold">Laporan Laba Rugi</h3>
                <button class="rounded-xl border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:border-primary hover:text-primary dark:border-slate-700 dark:text-slate-200">Unduh PDF</button>
            </div>
            <div class="mt-4 grid gap-4 md:grid-cols-3">
                <div class="rounded-2xl bg-emerald-50 p-4 text-emerald-700 dark:bg-emerald-900/30">
                    <p class="text-xs">Total Pemasukan</p>
                    <p class="text-2xl font-semibold">Rp 92.500.000</p>
                </div>
                <div class="rounded-2xl bg-rose-50 p-4 text-rose-700 dark:bg-rose-900/30">
                    <p class="text-xs">Total Pengeluaran</p>
                    <p class="text-2xl font-semibold">Rp 38.200.000</p>
                </div>
                <div class="rounded-2xl bg-primary/10 p-4 text-primary">
                    <p class="text-xs">Laba Bersih</p>
                    <p class="text-2xl font-semibold">Rp 54.300.000</p>
                </div>
            </div>
            <div class="mt-4 h-64">
                <canvas id="incomeChart"></canvas>
            </div>
        </div>
    </div>
    <div class="space-y-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
        <h3 class="text-lg font-semibold">Tambah Transaksi</h3>
        <form class="mt-4 space-y-3 text-sm">
            <div>
                <label class="font-semibold">Deskripsi</label>
                <input type="text" class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900" />
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="font-semibold">Nominal</label>
                    <input type="number" class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900" />
                </div>
                <div>
                    <label class="font-semibold">Kategori</label>
                    <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900">
                        <option>Penjualan</option>
                        <option>Servis</option>
                        <option>Operasional</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="font-semibold">Tanggal</label>
                <input type="date" class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900" />
            </div>
            <div>
                <label class="font-semibold">Catatan</label>
                <textarea rows="3" class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900"></textarea>
            </div>
            <button class="w-full rounded-xl bg-primary px-4 py-2 font-semibold text-white shadow hover:bg-primary/90">Simpan Transaksi</button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    const incomeCtx = document.getElementById('incomeChart');
    if (incomeCtx) {
        new Chart(incomeCtx, {
            type: 'bar',
            data: {
                labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
                datasets: [{
                    label: 'Pendapatan',
                    data: [8,9,7,10,11,12,13,12,14,13,15,16],
                    backgroundColor: '#4F46E5',
                    borderRadius: 8
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: { y: { grid: { color: 'rgba(148,163,184,0.3)' } }, x: { grid: { display: false } } }
            }
        });
    }
</script>
@endpush
@endsection
