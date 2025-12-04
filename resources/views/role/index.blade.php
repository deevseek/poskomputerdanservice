@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
    <div>
        <h1 class="text-2xl font-semibold">Manajemen Role</h1>
        <p class="text-sm text-slate-500">Atur hak akses pengguna</p>
    </div>
    <a href="{{ url('/role/create') }}" class="rounded-xl bg-primary px-4 py-2 text-sm font-semibold text-white shadow hover:bg-primary/90">Tambah Role</a>
</div>

<div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-700 dark:bg-slate-800">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-700">
            <thead class="bg-slate-100 dark:bg-slate-800">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold">Role</th>
                    <th class="px-4 py-3 text-left font-semibold">Deskripsi</th>
                    <th class="px-4 py-3 text-left font-semibold">Jumlah User</th>
                    <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                @foreach([
                    ['Admin','Akses penuh ke seluruh modul',12],
                    ['Kasir','Akses POS dan transaksi',6],
                    ['Teknisi','Akses Servis dan Sparepart',4],
                ] as $role)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/60">
                        <td class="px-4 py-3 font-semibold">{{ $role[0] }}</td>
                        <td class="px-4 py-3">{{ $role[1] }}</td>
                        <td class="px-4 py-3">{{ $role[2] }} pengguna</td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ url('/role/'.$role[0].'/edit') }}" class="rounded-lg bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700 hover:bg-slate-200 dark:bg-slate-900 dark:text-slate-200">Edit</a>
                                <a href="{{ url('/role/'.$role[0].'/permissions') }}" class="rounded-lg bg-primary/10 px-3 py-1 text-xs font-semibold text-primary hover:bg-primary/20">Hak Akses</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
