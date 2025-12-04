@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
    <div>
        <h1 class="text-2xl font-semibold">Pergerakan Stok</h1>
        <p class="text-sm text-slate-500">Catat setiap stok masuk dan keluar</p>
    </div>
    <div class="flex gap-2">
        <button x-data @click="$dispatch('open-modal','stok-masuk')" class="rounded-xl bg-primary px-4 py-2 text-sm font-semibold text-white shadow">Tambah Stok</button>
        <button x-data @click="$dispatch('open-modal','stok-keluar')" class="rounded-xl bg-rose-500 px-4 py-2 text-sm font-semibold text-white shadow">Kurangi Stok</button>
    </div>
</div>

<div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-700 dark:bg-slate-800">
    <div class="flex flex-wrap items-center gap-3">
        <select class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900">
            <option>Semua Tipe</option>
            <option>Stok Masuk</option>
            <option>Stok Keluar</option>
        </select>
        <input type="date" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900" />
        <input type="date" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900" />
        <div class="relative">
            <input type="text" placeholder="Cari catatan..." class="w-56 rounded-xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" />
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
                    <th class="px-4 py-3 text-left font-semibold">Produk</th>
                    <th class="px-4 py-3 text-left font-semibold">Tipe</th>
                    <th class="px-4 py-3 text-left font-semibold">Qty</th>
                    <th class="px-4 py-3 text-left font-semibold">Catatan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                @foreach([
                    ['2024-01-12','Laptop Unggulan','Stok Masuk','5','Restok Gudang'],
                    ['2024-01-10','Laptop Unggulan','Stok Keluar','-2','Penjualan POS'],
                    ['2024-01-08','Laptop Unggulan','Penyesuaian','-1','Koreksi'],
                ] as $row)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/60">
                        <td class="px-4 py-3">{{ $row[0] }}</td>
                        <td class="px-4 py-3">{{ $row[1] }}</td>
                        <td class="px-4 py-3">
                            <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $row[2]=='Stok Masuk' ? 'bg-emerald-100 text-emerald-600' : ($row[2]=='Stok Keluar' ? 'bg-rose-100 text-rose-600' : 'bg-amber-100 text-amber-700') }}">{{ $row[2] }}</span>
                        </td>
                        <td class="px-4 py-3 font-semibold">{{ $row[3] }} unit</td>
                        <td class="px-4 py-3 text-slate-500">{{ $row[4] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div x-data="{ show: false, type: '' }" @open-modal.window="type = $event.detail; show = true" x-show="show" x-cloak class="fixed inset-0 z-40 flex items-center justify-center bg-slate-900/60 p-6 backdrop-blur">
    <div class="w-full max-w-lg rounded-2xl border border-slate-200 bg-white p-6 shadow-2xl dark:border-slate-700 dark:bg-slate-800">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold" x-text="type === 'stok-masuk' ? 'Tambah Stok' : 'Kurangi Stok'"></h3>
            <button @click="show=false" class="text-slate-400 hover:text-slate-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
        <form class="mt-4 space-y-3 text-sm">
            <div>
                <label class="font-semibold">Produk</label>
                <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900">
                    <option>Laptop Unggulan</option>
                    <option>Mouse Wireless</option>
                </select>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="font-semibold">Qty</label>
                    <input type="number" class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" />
                </div>
                <div>
                    <label class="font-semibold">Tanggal</label>
                    <input type="date" class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900" />
                </div>
            </div>
            <div>
                <label class="font-semibold">Catatan</label>
                <textarea rows="3" class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" placeholder="Contoh: Restok gudang"></textarea>
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="show=false" class="rounded-xl border border-slate-200 px-4 py-2 font-semibold text-slate-700 transition hover:border-primary hover:text-primary dark:border-slate-700 dark:text-slate-200">Batal</button>
                <button class="rounded-xl bg-primary px-5 py-2 font-semibold text-white shadow" x-text="type === 'stok-masuk' ? 'Simpan Stok Masuk' : 'Simpan Stok Keluar'"></button>
            </div>
        </form>
    </div>
</div>
@endsection
