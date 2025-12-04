@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Daftar Supplier</h1>
        <a href="{{ route('supplier.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Supplier</a>
    </div>
    <table class="min-w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Nama Supplier</th>
                <th class="p-2">Kontak</th>
                <th class="p-2">Alamat</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($supplier as $item)
            <tr class="border-t">
                <td class="p-2">{{ $item->nama_supplier }}</td>
                <td class="p-2">{{ $item->kontak }}</td>
                <td class="p-2">{{ $item->alamat }}</td>
                <td class="p-2 space-x-2">
                    <a href="{{ route('supplier.edit', $item->id) }}" class="text-blue-600">Edit</a>
                    <form action="{{ route('supplier.destroy', $item->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600" onclick="return confirm('Hapus supplier ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
