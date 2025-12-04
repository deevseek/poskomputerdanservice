@extends('layouts.app')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-semibold">Tambah Pelanggan</h1>
        <p class="text-sm text-slate-500">Simpan data pelanggan baru</p>
    </div>
    <a href="{{ url('/pelanggan') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-primary hover:text-primary dark:border-slate-700 dark:bg-slate-800">Kembali</a>
</div>

<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
    <form class="grid gap-6 md:grid-cols-2">
        <div class="space-y-4">
            <div>
                <label class="text-sm font-semibold">Nama Lengkap</label>
                <input type="text" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" />
            </div>
            <div>
                <label class="text-sm font-semibold">Nomor HP / WhatsApp</label>
                <input type="text" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" />
            </div>
            <div>
                <label class="text-sm font-semibold">Email</label>
                <input type="email" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" />
            </div>
            <div>
                <label class="text-sm font-semibold">Alamat</label>
                <textarea rows="4" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900"></textarea>
            </div>
        </div>
        <div class="space-y-4">
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-sm font-semibold">Tanggal Bergabung</label>
                    <input type="date" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900" />
                </div>
                <div>
                    <label class="text-sm font-semibold">Status</label>
                    <select class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900">
                        <option>Aktif</option>
                        <option>Nonaktif</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="text-sm font-semibold">Catatan</label>
                <textarea rows="5" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" placeholder="Riwayat preferensi atau catatan khusus"></textarea>
            </div>
            <div class="flex justify-end gap-3">
                <button type="reset" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-primary hover:text-primary dark:border-slate-700 dark:text-slate-200">Batal</button>
                <button class="rounded-xl bg-primary px-5 py-2 text-sm font-semibold text-white shadow hover:bg-primary/90">Simpan Pelanggan</button>
            </div>
        </div>
    </form>
</div>
@endsection
