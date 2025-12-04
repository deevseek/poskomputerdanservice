@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">{{ $supplier->id ? 'Edit Supplier' : 'Tambah Supplier' }}</h1>
    <form action="{{ $supplier->id ? route('supplier.update', $supplier->id) : route('supplier.store') }}" method="POST" class="space-y-4">
        @csrf
        @if($supplier->id)
            @method('PUT')
        @endif
        <div>
            <label class="block font-semibold">Nama Supplier</label>
            <input type="text" name="nama_supplier" value="{{ old('nama_supplier', $supplier->nama_supplier) }}" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block font-semibold">Kontak</label>
            <input type="text" name="kontak" value="{{ old('kontak', $supplier->kontak) }}" class="w-full border rounded p-2">
        </div>
        <div>
            <label class="block font-semibold">Alamat</label>
            <textarea name="alamat" class="w-full border rounded p-2">{{ old('alamat', $supplier->alamat) }}</textarea>
        </div>
        <div>
            <label class="block font-semibold">Catatan</label>
            <textarea name="catatan" class="w-full border rounded p-2">{{ old('catatan', $supplier->catatan) }}</textarea>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
