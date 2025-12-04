@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Transaksi Keuangan</h1>
        <div class="space-x-2">
            <a href="{{ route('keuangan.buat') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Transaksi</a>
            <a href="{{ route('keuangan.laba_rugi') }}" class="bg-green-600 text-white px-4 py-2 rounded">Laporan Laba Rugi</a>
        </div>
    </div>
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    <table class="min-w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 text-left">Tanggal</th>
                <th class="p-2 text-left">Tipe</th>
                <th class="p-2 text-left">Kategori</th>
                <th class="p-2 text-left">Nominal</th>
                <th class="p-2 text-left">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi as $item)
            <tr class="border-t">
                <td class="p-2">{{ $item->tanggal_transaksi }}</td>
                <td class="p-2">{{ ucfirst($item->tipe) }}</td>
                <td class="p-2">{{ $item->kategori }}</td>
                <td class="p-2">Rp{{ number_format($item->nominal,0,',','.') }}</td>
                <td class="p-2">{{ $item->deskripsi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
