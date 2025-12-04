@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-semibold">Pengaturan Aplikasi</h1>
    <p class="text-sm text-slate-500">Sesuaikan preferensi toko Anda</p>
</div>

<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
    <form class="grid gap-6 md:grid-cols-2">
        <div class="space-y-4">
            <div>
                <label class="text-sm font-semibold">Nama Toko</label>
                <input type="text" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" value="POS Komputer &amp; Servis" />
            </div>
            <div>
                <label class="text-sm font-semibold">Alamat</label>
                <textarea rows="3" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900">Jl. Merdeka No. 10, Bandung</textarea>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-sm font-semibold">Nomor HP / WhatsApp</label>
                    <input type="text" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" value="0812-1234-5678" />
                </div>
                <div>
                    <label class="text-sm font-semibold">Printer Mode</label>
                    <select class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900">
                        <option>Thermal 58mm</option>
                        <option>Thermal 80mm</option>
                        <option>Inkjet</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-sm font-semibold">Pajak Default (%)</label>
                    <input type="number" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" value="10" />
                </div>
                <div>
                    <label class="text-sm font-semibold">Masa Garansi Default (bulan)</label>
                    <input type="number" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" value="12" />
                </div>
            </div>
        </div>
        <div class="space-y-4">
            <div>
                <label class="text-sm font-semibold">Logo Toko</label>
                <div class="mt-2 flex items-center gap-4 rounded-xl border border-dashed border-slate-300 bg-slate-50 px-4 py-5 text-sm text-slate-500 dark:border-slate-700 dark:bg-slate-900">
                    <div class="h-14 w-14 overflow-hidden rounded-xl bg-white shadow-sm dark:bg-slate-800">
                        <img src="https://source.unsplash.com/100x100/?computer" class="h-full w-full object-cover" alt="logo" />
                    </div>
                    <div>
                        <p class="font-semibold text-slate-700 dark:text-slate-200">Unggah logo baru</p>
                        <p class="text-xs">PNG, JPG maksimal 2MB</p>
                    </div>
                    <input type="file" class="hidden" />
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-sm font-semibold">Bahasa</label>
                    <select class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900">
                        <option>Bahasa Indonesia</option>
                        <option>English</option>
                    </select>
                </div>
                <div>
                    <label class="text-sm font-semibold">Timezone</label>
                    <select class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900">
                        <option>Asia/Jakarta</option>
                        <option>Asia/Makassar</option>
                        <option>Asia/Jayapura</option>
                    </select>
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-sm font-semibold">Tema</label>
                <div class="flex gap-2 text-xs font-semibold text-slate-600 dark:text-slate-300">
                    <button class="flex-1 rounded-xl border border-slate-200 bg-white px-3 py-2 transition hover:border-primary hover:text-primary dark:border-slate-700 dark:bg-slate-900">Terang</button>
                    <button class="flex-1 rounded-xl border border-slate-200 bg-white px-3 py-2 transition hover:border-primary hover:text-primary dark:border-slate-700 dark:bg-slate-900">Gelap</button>
                    <button class="flex-1 rounded-xl border border-slate-200 bg-white px-3 py-2 transition hover:border-primary hover:text-primary dark:border-slate-700 dark:bg-slate-900">Otomatis</button>
                </div>
            </div>
            <div class="flex justify-end">
                <button class="rounded-xl bg-primary px-6 py-3 text-sm font-semibold text-white shadow-lg hover:bg-primary/90">Simpan Pengaturan</button>
            </div>
        </div>
    </form>
</div>
@endsection
