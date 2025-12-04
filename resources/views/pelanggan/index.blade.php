@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
    <div>
        <h1 class="text-2xl font-semibold">Pelanggan</h1>
        <p class="text-sm text-slate-500">Kelola data pelanggan setia</p>
    </div>
    <a href="{{ url('/pelanggan/create') }}" class="rounded-xl bg-primary px-4 py-2 text-sm font-semibold text-white shadow hover:bg-primary/90">Tambah Pelanggan</a>
</div>

<div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-700 dark:bg-slate-800">
    <div class="flex flex-wrap items-center gap-3">
        <div class="relative">
            <input type="text" placeholder="Cari pelanggan..." class="w-64 rounded-xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" />
            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607z" /></svg>
            </span>
        </div>
        <select class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900">
            <option>Status</option>
            <option>Aktif</option>
            <option>Nonaktif</option>
        </select>
    </div>

    <div class="mt-4 overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-700">
            <thead class="bg-slate-100 dark:bg-slate-800">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold">Nama</th>
                    <th class="px-4 py-3 text-left font-semibold">Kontak</th>
                    <th class="px-4 py-3 text-left font-semibold">Total Pembelian</th>
                    <th class="px-4 py-3 text-left font-semibold">Terakhir Transaksi</th>
                    <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                @foreach(range(1,6) as $row)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/60">
                        <td class="px-4 py-3 font-semibold">Pelanggan {{ $row }}</td>
                        <td class="px-4 py-3">0812-0000-0{{ $row }}</td>
                        <td class="px-4 py-3">Rp {{ number_format($row*1500000,0,',','.') }}</td>
                        <td class="px-4 py-3 text-slate-500">12-0{{ $row }}-2024</td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ url('/pelanggan/'.$row) }}" class="rounded-lg bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700 hover:bg-slate-200 dark:bg-slate-900 dark:text-slate-200">Profil</a>
                                <a href="{{ url('/pelanggan/'.$row.'/edit') }}" class="rounded-lg bg-primary/10 px-3 py-1 text-xs font-semibold text-primary hover:bg-primary/20">Edit</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
