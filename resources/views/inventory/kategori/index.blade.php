@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Kategori Produk</h1>
    <form action="{{ route('kategori.store') }}" method="POST" class="space-y-2 mb-4">
        @csrf
        <div>
            <label class="block font-semibold">Nama Kategori</label>
            <input type="text" name="nama_kategori" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block font-semibold">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border rounded p-2"></textarea>
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
    <table class="min-w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Nama Kategori</th>
                <th class="p-2">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kategori as $item)
            <tr class="border-t">
                <td class="p-2">{{ $item->nama_kategori }}</td>
                <td class="p-2">{{ $item->deskripsi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
