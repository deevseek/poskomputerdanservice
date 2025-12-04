@extends('layouts.app')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-semibold">Buat Tiket Servis</h1>
        <p class="text-sm text-slate-500">Catat perangkat dan keluhan pelanggan</p>
    </div>
    <a href="{{ url('/servis') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-primary hover:text-primary dark:border-slate-700 dark:bg-slate-800">Kembali</a>
</div>

<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
    <form class="grid gap-6 md:grid-cols-2">
        <div class="space-y-4">
            <div>
                <label class="text-sm font-semibold">Pelanggan</label>
                <select class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900">
                    <option>Ahmad Kurnia</option>
                    <option>Sita Dewi</option>
                </select>
            </div>
            <div>
                <label class="text-sm font-semibold">Perangkat</label>
                <input type="text" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" placeholder="Contoh: Laptop Asus ROG" />
            </div>
            <div>
                <label class="text-sm font-semibold">Nomor Seri</label>
                <input type="text" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" />
            </div>
            <div>
                <label class="text-sm font-semibold">Keluhan</label>
                <textarea rows="5" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" placeholder="Deskripsikan kendala"></textarea>
            </div>
        </div>
        <div class="space-y-4">
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-sm font-semibold">Estimasi Biaya</label>
                    <input type="number" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" placeholder="Rp" />
                </div>
                <div>
                    <label class="text-sm font-semibold">Teknisi</label>
                    <select class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900">
                        <option>Dimas</option>
                        <option>Riko</option>
                        <option>Bima</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-sm font-semibold">Prioritas</label>
                    <select class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900">
                        <option>Normal</option>
                        <option>High</option>
                        <option>Urgent</option>
                    </select>
                </div>
                <div>
                    <label class="text-sm font-semibold">Estimasi Selesai</label>
                    <input type="date" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900" />
                </div>
            </div>
            <div>
                <label class="text-sm font-semibold">Catatan Internal</label>
                <textarea rows="4" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" placeholder="Catatan teknisi"></textarea>
            </div>
            <div class="flex justify-end gap-3">
                <button type="reset" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-primary hover:text-primary dark:border-slate-700 dark:text-slate-200">Batal</button>
                <button class="rounded-xl bg-primary px-5 py-2 text-sm font-semibold text-white shadow hover:bg-primary/90">Simpan Tiket</button>
            </div>
        </div>
    </form>
</div>
@endsection
