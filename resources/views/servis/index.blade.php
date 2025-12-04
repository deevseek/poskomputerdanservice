@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
    <div>
        <h1 class="text-2xl font-semibold">Tiket Servis</h1>
        <p class="text-sm text-slate-500">Pantau status perangkat pelanggan</p>
    </div>
    <a href="{{ url('/servis/create') }}" class="rounded-xl bg-primary px-4 py-2 text-sm font-semibold text-white shadow hover:bg-primary/90">Buat Tiket Servis</a>
</div>

<div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-700 dark:bg-slate-800">
    <div class="flex flex-wrap items-center gap-3 text-sm">
        <select class="rounded-xl border border-slate-200 bg-white px-3 py-2 outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900">
            <option>Semua Status</option>
            <option>Menunggu</option>
            <option>Dalam Pengerjaan</option>
            <option>Selesai</option>
            <option>Diambil</option>
        </select>
        <input type="text" placeholder="Cari tiket..." class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-2 outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" />
    </div>

    <div class="mt-4 overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-700">
            <thead class="bg-slate-100 dark:bg-slate-800">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold">Kode</th>
                    <th class="px-4 py-3 text-left font-semibold">Pelanggan</th>
                    <th class="px-4 py-3 text-left font-semibold">Perangkat</th>
                    <th class="px-4 py-3 text-left font-semibold">Status</th>
                    <th class="px-4 py-3 text-left font-semibold">Teknisi</th>
                    <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                @foreach([
                    ['SRV-032','Ahmad','Laptop Gaming','Dalam Pengerjaan','Dimas'],
                    ['SRV-028','Sita','Printer','Menunggu','Riko'],
                    ['SRV-025','Dewi','PC Rakitan','Selesai','Bima'],
                ] as $row)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/60">
                        <td class="px-4 py-3 font-semibold">{{ $row[0] }}</td>
                        <td class="px-4 py-3">{{ $row[1] }}</td>
                        <td class="px-4 py-3">{{ $row[2] }}</td>
                        <td class="px-4 py-3">
                            @php
                                $colors = [
                                    'Menunggu' => 'bg-amber-100 text-amber-700',
                                    'Dalam Pengerjaan' => 'bg-blue-100 text-blue-700',
                                    'Selesai' => 'bg-emerald-100 text-emerald-700',
                                ];
                            @endphp
                            <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $colors[$row[3]] ?? 'bg-slate-100 text-slate-700' }}">{{ $row[3] }}</span>
                        </td>
                        <td class="px-4 py-3">{{ $row[4] }}</td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ url('/servis/'.$row[0]) }}" class="rounded-lg bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700 hover:bg-slate-200 dark:bg-slate-900 dark:text-slate-200">Detail</a>
                                <button class="rounded-lg bg-primary/10 px-3 py-1 text-xs font-semibold text-primary hover:bg-primary/20">Update</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
