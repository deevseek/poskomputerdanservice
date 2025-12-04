@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Daftar Produk</h1>
        <a href="{{ route('produk.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Produk</a>
    </div>
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    <table class="min-w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 text-left">Nama Produk</th>
                <th class="p-2">Kategori</th>
                <th class="p-2">Harga Beli</th>
                <th class="p-2">Harga Jual</th>
                <th class="p-2">Stok Saat Ini</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produk as $item)
            <tr class="border-t">
                <td class="p-2">{{ $item->nama_produk }}</td>
                <td class="p-2">{{ $item->kategoriProduk->nama_kategori ?? '-' }}</td>
                <td class="p-2">Rp{{ number_format($item->harga_beli,0,',','.') }}</td>
                <td class="p-2">Rp{{ number_format($item->harga_jual,0,',','.') }}</td>
                <td class="p-2">{{ $item->stok }}</td>
                <td class="p-2 space-x-2">
                    <a href="{{ route('produk.edit', $item->id) }}" class="text-blue-600">Edit</a>
                    <form action="{{ route('produk.destroy', $item->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
