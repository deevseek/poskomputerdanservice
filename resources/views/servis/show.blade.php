@extends('layouts.app')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-semibold">Detail Tiket Servis</h1>
        <p class="text-sm text-slate-500">Pantau progres perbaikan</p>
    </div>
    <div class="flex gap-2">
        <button class="rounded-xl bg-primary px-4 py-2 text-sm font-semibold text-white shadow">Update Status</button>
        <a href="{{ url('/servis') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-primary hover:text-primary dark:border-slate-700 dark:bg-slate-800">Kembali</a>
    </div>
</div>

<div class="grid gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2 space-y-4">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
            <div class="flex flex-wrap items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Kode Tiket</p>
                    <p class="text-xl font-semibold">SRV-032</p>
                    <div class="mt-2 flex gap-2 text-xs">
                        <span class="rounded-full bg-blue-100 px-3 py-1 font-semibold text-blue-700">Dalam Pengerjaan</span>
                        <span class="rounded-full bg-slate-100 px-3 py-1 font-semibold text-slate-700">Teknisi: Dimas</span>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm text-slate-500">Estimasi</p>
                    <p class="text-lg font-semibold">Rp 850.000</p>
                    <p class="text-xs text-slate-500">Estimasi selesai: 15 Jan 2024</p>
                </div>
            </div>
            <div class="mt-4 grid gap-3 text-sm md:grid-cols-2">
                <div class="rounded-xl bg-slate-50 p-4 dark:bg-slate-900">
                    <p class="text-xs text-slate-500">Pelanggan</p>
                    <p class="text-lg font-semibold">Ahmad Kurnia</p>
                    <p class="text-xs text-slate-500">0812-1234-5678</p>
                </div>
                <div class="rounded-xl bg-slate-50 p-4 dark:bg-slate-900">
                    <p class="text-xs text-slate-500">Perangkat</p>
                    <p class="text-lg font-semibold">Laptop Gaming</p>
                    <p class="text-xs text-slate-500">SN: ABC123XYZ</p>
                </div>
            </div>
            <div class="mt-4">
                <h3 class="text-lg font-semibold">Keluhan</h3>
                <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Laptop sering mati mendadak saat bermain gim, kipas berisik, dan suhu tinggi.</p>
            </div>
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold">Timeline Status</h3>
                    <button class="rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold text-primary">Tambah Log</button>
                </div>
                <div class="mt-4 space-y-3 text-sm">
                    @foreach([
                        ['12 Jan 09:00','Pemeriksaan awal','blue'],
                        ['12 Jan 11:30','Ganti pasta termal','emerald'],
                        ['12 Jan 14:00','Menunggu approval biaya','amber'],
                    ] as $log)
                        <div class="flex gap-3">
                            <div class="mt-1 h-2 w-2 rounded-full bg-{{ $log[2] }}-500"></div>
                            <div>
                                <p class="font-semibold">{{ $log[0] }}</p>
                                <p class="text-xs text-slate-500">{{ $log[1] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold">Sparepart Digunakan</h3>
                    <button class="rounded-full bg-accent px-3 py-1 text-xs font-semibold text-white">Tambah</button>
                </div>
                <div class="mt-4 space-y-3 text-sm">
                    <div class="flex items-center justify-between rounded-xl bg-slate-50 px-3 py-2 dark:bg-slate-900">
                        <div>
                            <p class="font-semibold">Pasta Thermal Pro</p>
                            <p class="text-xs text-slate-500">Qty 1 • Rp 95.000</p>
                        </div>
                        <button class="text-red-500 hover:text-red-600">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                    <div class="flex items-center justify-between rounded-xl bg-slate-50 px-3 py-2 dark:bg-slate-900">
                        <div>
                            <p class="font-semibold">Fan Laptop</p>
                            <p class="text-xs text-slate-500">Qty 1 • Rp 250.000</p>
                        </div>
                        <button class="text-red-500 hover:text-red-600">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="space-y-4">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
            <h3 class="text-lg font-semibold">Update Status</h3>
            <div class="mt-4 space-y-3 text-sm">
                <label class="block text-sm font-semibold">Status Servis</label>
                <select class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900">
                    <option>Menunggu</option>
                    <option selected>Dalam Pengerjaan</option>
                    <option>Selesai</option>
                    <option>Siap Diambil</option>
                </select>
                <label class="block text-sm font-semibold">Catatan</label>
                <textarea rows="4" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900"></textarea>
                <button class="w-full rounded-xl bg-primary px-4 py-2 font-semibold text-white shadow hover:bg-primary/90">Simpan Status</button>
            </div>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
            <h3 class="text-lg font-semibold">Informasi Pembayaran</h3>
            <dl class="mt-3 space-y-2 text-sm">
                <div class="flex justify-between"><dt>Estimasi Biaya</dt><dd class="font-semibold">Rp 850.000</dd></div>
                <div class="flex justify-between"><dt>Sparepart</dt><dd class="font-semibold">Rp 345.000</dd></div>
                <div class="flex justify-between"><dt>Jasa Servis</dt><dd class="font-semibold">Rp 505.000</dd></div>
                <div class="flex justify-between text-lg font-bold"><dt>Total</dt><dd class="text-primary">Rp 1.200.000</dd></div>
            </dl>
            <button class="mt-3 w-full rounded-xl border border-dashed border-primary px-4 py-2 text-sm font-semibold text-primary hover:bg-primary/5">Buat Invoice</button>
        </div>
    </div>
</div>
@endsection
