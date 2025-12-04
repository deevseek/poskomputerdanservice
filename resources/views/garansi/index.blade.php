@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-semibold">Garansi &amp; Klaim</h1>
    <p class="text-sm text-slate-500">Cek status garansi dan ajukan klaim</p>
</div>

<div class="grid gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2 space-y-6">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
            <h3 class="text-lg font-semibold">Cek Garansi</h3>
            <div class="mt-4 grid gap-4 md:grid-cols-3">
                <input type="text" placeholder="Nomor Seri" class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" />
                <input type="text" placeholder="Nama Pelanggan" class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" />
                <button class="rounded-xl bg-primary px-4 py-3 text-sm font-semibold text-white shadow hover:bg-primary/90">Cek Garansi</button>
            </div>
            <div class="mt-4 rounded-2xl border border-dashed border-primary bg-primary/5 p-4 text-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-500">Status Garansi</p>
                        <p class="text-lg font-semibold text-emerald-600">Aktif</p>
                    </div>
                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">Valid</span>
                </div>
                <div class="mt-3 grid gap-2 text-sm md:grid-cols-2">
                    <div class="rounded-xl bg-white px-3 py-2 shadow-sm dark:bg-slate-900">
                        <p class="text-xs text-slate-500">Mulai</p>
                        <p class="font-semibold">12 Jan 2024</p>
                    </div>
                    <div class="rounded-xl bg-white px-3 py-2 shadow-sm dark:bg-slate-900">
                        <p class="text-xs text-slate-500">Berakhir</p>
                        <p class="font-semibold">12 Jan 2025</p>
                    </div>
                </div>
                <div class="mt-3 text-xs text-slate-500">
                    <p>Syarat &amp; ketentuan: garansi tidak berlaku untuk kerusakan fisik atau karena cairan.</p>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold">Ajukan Klaim Garansi</h3>
                <button class="rounded-full bg-accent px-3 py-1 text-xs font-semibold text-white">Riwayat Saya</button>
            </div>
            <form class="mt-4 grid gap-4 md:grid-cols-2">
                <div class="space-y-3">
                    <div>
                        <label class="text-sm font-semibold">Nomor Seri</label>
                        <input type="text" class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold">Tanggal Pembelian</label>
                        <input type="date" class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold">Dokumen Bukti</label>
                        <div class="mt-1 rounded-xl border border-dashed border-slate-300 bg-slate-50 px-4 py-4 text-sm text-slate-500 dark:border-slate-700 dark:bg-slate-900">Unggah invoice / kartu garansi</div>
                    </div>
                </div>
                <div class="space-y-3">
                    <div>
                        <label class="text-sm font-semibold">Deskripsi Klaim</label>
                        <textarea rows="5" class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" placeholder="Jelaskan masalah"></textarea>
                    </div>
                    <div>
                        <label class="text-sm font-semibold">Metode Kontak</label>
                        <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900">
                            <option>Email</option>
                            <option>Telepon</option>
                            <option>WhatsApp</option>
                        </select>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="reset" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-primary hover:text-primary dark:border-slate-700 dark:text-slate-200">Batal</button>
                        <button class="rounded-xl bg-primary px-5 py-2 text-sm font-semibold text-white shadow hover:bg-primary/90">Kirim Klaim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="space-y-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
        <h3 class="text-lg font-semibold">Riwayat Klaim Pelanggan</h3>
        <div class="mt-4 space-y-3 text-sm">
            @foreach([
                ['CLAIM-12','Disetujui','Laptop Unggulan','05 Jan 2024'],
                ['CLAIM-09','Ditolak','Mouse Wireless','15 Des 2023'],
            ] as $claim)
                <div class="rounded-xl border border-slate-100 bg-slate-50 px-3 py-2 dark:border-slate-700 dark:bg-slate-900">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold">{{ $claim[0] }}</p>
                        <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $claim[1]=='Disetujui' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">{{ $claim[1] }}</span>
                    </div>
                    <p class="text-xs text-slate-500">{{ $claim[2] }} • {{ $claim[3] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
