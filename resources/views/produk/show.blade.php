@extends('layouts.app')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-semibold">Detail Produk</h1>
        <p class="text-sm text-slate-500">Informasi lengkap produk</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ url('/produk/'.$id.'/edit') }}" class="rounded-xl bg-primary px-4 py-2 text-sm font-semibold text-white shadow">Edit</a>
        <a href="{{ url('/produk') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-primary hover:text-primary dark:border-slate-700 dark:bg-slate-800">Kembali</a>
    </div>
</div>

<div class="grid gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2 space-y-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
        <div class="flex items-center gap-4">
            <div class="h-24 w-24 overflow-hidden rounded-2xl bg-slate-100 dark:bg-slate-900">
                <img src="https://source.unsplash.com/200x200/?laptop" alt="produk" class="h-full w-full object-cover">
            </div>
            <div>
                <p class="text-lg font-semibold">Laptop Unggulan</p>
                <p class="text-sm text-slate-500">SKU0099 • Laptop</p>
                <div class="mt-2 flex gap-2 text-xs">
                    <span class="rounded-full bg-primary/10 px-3 py-1 text-primary">Barang</span>
                    <span class="rounded-full bg-accent/10 px-3 py-1 text-accent">Garansi 24 bulan</span>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div class="rounded-xl bg-slate-50 p-4 dark:bg-slate-900">
                <p class="text-xs text-slate-500">Harga Beli</p>
                <p class="text-lg font-bold">Rp 8.500.000</p>
            </div>
            <div class="rounded-xl bg-slate-50 p-4 dark:bg-slate-900">
                <p class="text-xs text-slate-500">Harga Jual</p>
                <p class="text-lg font-bold text-primary">Rp 10.500.000</p>
            </div>
            <div class="rounded-xl bg-slate-50 p-4 dark:bg-slate-900">
                <p class="text-xs text-slate-500">Stok</p>
                <p class="text-lg font-bold">12 unit</p>
            </div>
            <div class="rounded-xl bg-slate-50 p-4 dark:bg-slate-900">
                <p class="text-xs text-slate-500">Jenis</p>
                <p class="text-lg font-bold">Barang</p>
            </div>
        </div>
        <div>
            <h3 class="text-lg font-semibold">Deskripsi</h3>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Laptop premium dengan prosesor terbaru, RAM besar, dan garansi resmi. Cocok untuk kebutuhan bisnis maupun gaming ringan.</p>
        </div>
    </div>
    <div class="space-y-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
        <h3 class="text-lg font-semibold">Aktivitas Stok</h3>
        <div class="space-y-3 text-sm">
            <div class="flex items-center justify-between rounded-xl bg-slate-50 px-3 py-2 dark:bg-slate-900">
                <div>
                    <p class="font-semibold">Restok Gudang</p>
                    <p class="text-xs text-slate-500">+5 unit • 12 Jan</p>
                </div>
                <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-600">Masuk</span>
            </div>
            <div class="flex items-center justify-between rounded-xl bg-slate-50 px-3 py-2 dark:bg-slate-900">
                <div>
                    <p class="font-semibold">Penjualan POS</p>
                    <p class="text-xs text-slate-500">-2 unit • 10 Jan</p>
                </div>
                <span class="rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-600">Keluar</span>
            </div>
            <div class="flex items-center justify-between rounded-xl bg-slate-50 px-3 py-2 dark:bg-slate-900">
                <div>
                    <p class="font-semibold">Koreksi Stok</p>
                    <p class="text-xs text-slate-500">-1 unit • 08 Jan</p>
                </div>
                <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">Penyesuaian</span>
            </div>
        </div>
    </div>
</div>
@endsection
