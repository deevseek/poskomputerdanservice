@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
    <div>
        <h1 class="text-2xl font-semibold">Produk</h1>
        <p class="text-sm text-slate-500">Kelola katalog dan stok produk</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ url('/produk/create') }}" class="rounded-xl bg-primary px-4 py-2 text-sm font-semibold text-white shadow hover:bg-primary/90">Tambah Produk</a>
        <button class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 shadow-sm transition hover:border-primary hover:text-primary dark:border-slate-700 dark:bg-slate-800">Impor CSV</button>
    </div>
</div>

<div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-700 dark:bg-slate-800">
    <div class="flex flex-wrap items-center gap-3">
        <div class="relative">
            <input type="text" placeholder="Cari produk..." class="w-72 rounded-xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" />
            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607z" /></svg>
            </span>
        </div>
        <select class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none transition focus:border-primary dark:border-slate-700 dark:bg-slate-900">
            <option>Kategori</option>
            <option>Laptop</option>
            <option>Aksesoris</option>
            <option>Komponen</option>
        </select>
        <select class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none transition focus:border-primary dark:border-slate-700 dark:bg-slate-900">
            <option>Jenis Produk</option>
            <option>Barang</option>
            <option>Jasa</option>
        </select>
        <button class="rounded-xl bg-accent px-4 py-2 text-sm font-semibold text-white shadow hover:bg-accent/90">Filter</button>
    </div>

    <div class="mt-4 overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-700">
            <thead class="bg-slate-100 dark:bg-slate-800">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold">Produk</th>
                    <th class="px-4 py-3 text-left font-semibold">SKU</th>
                    <th class="px-4 py-3 text-left font-semibold">Kategori</th>
                    <th class="px-4 py-3 text-right font-semibold">Harga Jual</th>
                    <th class="px-4 py-3 text-right font-semibold">Stok</th>
                    <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                @foreach(range(1,6) as $row)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/60">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <span class="h-10 w-10 overflow-hidden rounded-xl bg-slate-100 dark:bg-slate-900">
                                    <img src="https://source.unsplash.com/80x80/?gadget,{{ $row }}" class="h-full w-full object-cover" alt="produk" />
                                </span>
                                <div>
                                    <p class="font-semibold">Produk Keren {{ $row }}</p>
                                    <p class="text-xs text-slate-500">Barang</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">SKU00{{ $row }}</td>
                        <td class="px-4 py-3">Kategori {{ $row }}</td>
                        <td class="px-4 py-3 text-right font-semibold text-primary">Rp 1.250.000</td>
                        <td class="px-4 py-3 text-right"><span class="rounded-full bg-slate-100 px-2 py-1 text-xs dark:bg-slate-900">{{ 20-$row }}</span></td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ url('/produk/'.$row) }}" class="rounded-lg bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700 hover:bg-slate-200 dark:bg-slate-900 dark:text-slate-200">Detail</a>
                                <a href="{{ url('/produk/'.$row.'/edit') }}" class="rounded-lg bg-primary/10 px-3 py-1 text-xs font-semibold text-primary hover:bg-primary/20">Edit</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
