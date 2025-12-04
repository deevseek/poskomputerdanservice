@extends('layouts.app')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-semibold">Hak Akses Role</h1>
        <p class="text-sm text-slate-500">Atur permission untuk role tertentu</p>
    </div>
    <a href="{{ url('/role') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-primary hover:text-primary dark:border-slate-700 dark:bg-slate-800">Kembali</a>
</div>

<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
    <div class="mb-4 flex items-center justify-between">
        <div>
            <p class="text-sm text-slate-500">Role</p>
            <p class="text-lg font-semibold">Kasir</p>
        </div>
        <button class="rounded-full bg-primary px-4 py-2 text-xs font-semibold text-white shadow">Simpan Hak Akses</button>
    </div>
    <div class="grid gap-4 md:grid-cols-2">
        @php
            $groups = [
                'Dashboard' => ['Lihat dashboard'],
                'POS & Penjualan' => ['Lihat POS','Buat transaksi','Retur penjualan'],
                'Produk & Stok' => ['Kelola produk','Lihat stok','Pergerakan stok'],
                'Pelanggan' => ['Kelola pelanggan','Lihat profil'],
                'Servis' => ['Kelola tiket','Update status','Kelola sparepart'],
                'Keuangan' => ['Lihat laporan','Input transaksi'],
                'Pengaturan' => ['Ubah pengaturan', 'Kelola role'],
            ];
        @endphp
        @foreach($groups as $label => $items)
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-900">
                <div class="mb-2 flex items-center justify-between">
                    <p class="text-sm font-semibold">{{ $label }}</p>
                    <label class="flex items-center gap-2 text-xs font-semibold text-slate-600 dark:text-slate-300">
                        <input type="checkbox" class="h-4 w-4 rounded border-slate-300 text-primary focus:ring-primary" /> Pilih semua
                    </label>
                </div>
                <div class="space-y-2 text-sm">
                    @foreach($items as $item)
                        <label class="flex items-center gap-3 rounded-xl bg-white px-3 py-2 shadow-sm dark:bg-slate-800">
                            <input type="checkbox" class="h-4 w-4 rounded border-slate-300 text-primary focus:ring-primary" />
                            <span>{{ $item }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
