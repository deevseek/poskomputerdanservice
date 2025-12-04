@extends('layouts.app')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-semibold">Profil Pelanggan</h1>
        <p class="text-sm text-slate-500">Ringkasan aktivitas pelanggan</p>
    </div>
    <a href="{{ url('/pelanggan') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-primary hover:text-primary dark:border-slate-700 dark:bg-slate-800">Kembali</a>
</div>

<div class="grid gap-6 lg:grid-cols-3">
    <div class="lg:col-span-1 space-y-4">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
            <div class="flex items-center gap-3">
                <span class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-lg font-semibold text-primary">AK</span>
                <div>
                    <p class="text-lg font-semibold">Ahmad Kurnia</p>
                    <p class="text-sm text-slate-500">Member sejak 2021</p>
                </div>
            </div>
            <div class="mt-4 space-y-2 text-sm">
                <div class="flex items-center gap-2 text-slate-600 dark:text-slate-300">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h17.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125H3.375A1.125 1.125 0 0 1 2.25 18.375z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 6l9 7.5L21 6" /></svg>
                    <span>ahmad@mail.com</span>
                </div>
                <div class="flex items-center gap-2 text-slate-600 dark:text-slate-300">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 4.5v15m0-15 7.5 6.75L17.25 4.5m-15 0H9m8.25 0h4.5v15h-4.5M9 4.5v15m0 0h6.75" /></svg>
                    <span>0812-1234-5678</span>
                </div>
                <div class="flex items-center gap-2 text-slate-600 dark:text-slate-300">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21c4.97 0 9-4.03 9-9s-4.03-9-9-9-9 4.03-9 9 4.03 9 9 9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m9.75 9.75 1.5 1.5 3-3" /></svg>
                    <span>Status: Aktif</span>
                </div>
            </div>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
            <h3 class="text-lg font-semibold">Garansi Aktif</h3>
            <div class="mt-4 space-y-3 text-sm">
                <div class="rounded-xl bg-slate-50 p-3 dark:bg-slate-900">
                    <p class="font-semibold">Laptop Unggulan</p>
                    <p class="text-xs text-slate-500">Berlaku hingga 12 Jan 2025</p>
                </div>
                <div class="rounded-xl bg-slate-50 p-3 dark:bg-slate-900">
                    <p class="font-semibold">Mouse Wireless</p>
                    <p class="text-xs text-slate-500">Berlaku hingga 10 Sep 2024</p>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:col-span-2 space-y-4">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold">Riwayat Pembelian</h3>
                <a href="#" class="text-sm font-semibold text-primary">Lihat semua</a>
            </div>
            <div class="mt-4 divide-y divide-slate-100 text-sm dark:divide-slate-700">
                @foreach([
                    ['PEN-210','12 Jan 2024','Rp 1.250.000'],
                    ['PEN-211','10 Jan 2024','Rp 2.100.000'],
                ] as $trx)
                    <div class="flex items-center justify-between py-3">
                        <div>
                            <p class="font-semibold">{{ $trx[0] }}</p>
                            <p class="text-xs text-slate-500">{{ $trx[1] }}</p>
                        </div>
                        <span class="font-semibold text-primary">{{ $trx[2] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="grid gap-4 md:grid-cols-2">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold">Riwayat Servis</h3>
                    <a href="#" class="text-sm font-semibold text-primary">Detail</a>
                </div>
                <div class="mt-4 space-y-3 text-sm">
                    <div class="rounded-xl bg-slate-50 p-3 dark:bg-slate-900">
                        <p class="font-semibold">SRV-032 • Laptop</p>
                        <p class="text-xs text-slate-500">Status: Selesai • 08 Jan 2024</p>
                    </div>
                    <div class="rounded-xl bg-slate-50 p-3 dark:bg-slate-900">
                        <p class="font-semibold">SRV-020 • Printer</p>
                        <p class="text-xs text-slate-500">Status: Dalam Proses • 20 Des 2023</p>
                    </div>
                </div>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold">Riwayat Klaim Garansi</h3>
                    <a href="#" class="text-sm font-semibold text-primary">Detail</a>
                </div>
                <div class="mt-4 space-y-3 text-sm">
                    <div class="rounded-xl bg-slate-50 p-3 dark:bg-slate-900">
                        <p class="font-semibold">CLAIM-12 • Disetujui</p>
                        <p class="text-xs text-slate-500">Penggantian keyboard • 05 Jan 2024</p>
                    </div>
                    <div class="rounded-xl bg-slate-50 p-3 dark:bg-slate-900">
                        <p class="font-semibold">CLAIM-09 • Ditolak</p>
                        <p class="text-xs text-slate-500">Kerusakan karena cairan • 15 Des 2023</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
