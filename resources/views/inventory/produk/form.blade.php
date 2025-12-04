@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">{{ $produk->id ? 'Edit Produk' : 'Tambah Produk' }}</h1>
    <form action="{{ $produk->id ? route('produk.update', $produk->id) : route('produk.store') }}" method="POST" class="space-y-4">
        @csrf
        @if($produk->id)
            @method('PUT')
        @endif
        <div>
            <label class="block font-semibold">Nama Produk</label>
            <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" class="w-full border rounded p-2" required>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold">SKU</label>
                <input type="text" name="sku" value="{{ old('sku', $produk->sku) }}" class="w-full border rounded p-2">
            </div>
            <div>
                <label class="block font-semibold">Kategori</label>
                <select name="kategori_id" class="w-full border rounded p-2">
                    <option value="">Pilih Kategori</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ old('kategori_id', $produk->kategori_id)==$kat->id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold">Jenis Produk</label>
                <select name="jenis_produk" class="w-full border rounded p-2">
                    <option value="barang_fisik" {{ old('jenis_produk', $produk->jenis_produk)=='barang_fisik'?'selected':'' }}>Barang Fisik</option>
                    <option value="sparepart_servis" {{ old('jenis_produk', $produk->jenis_produk)=='sparepart_servis'?'selected':'' }}>Sparepart Servis</option>
                </select>
            </div>
            <div>
                <label class="block font-semibold">Harga Beli</label>
                <input type="number" name="harga_beli" value="{{ old('harga_beli', $produk->harga_beli) }}" class="w-full border rounded p-2" required>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold">Harga Jual</label>
                <input type="number" name="harga_jual" value="{{ old('harga_jual', $produk->harga_jual) }}" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block font-semibold">Stok Saat Ini</label>
                <input type="number" name="stok" value="{{ old('stok', $produk->stok) }}" class="w-full border rounded p-2" required>
            </div>
        </div>
        <div>
            <label class="block font-semibold">Keterangan</label>
            <textarea name="keterangan" class="w-full border rounded p-2">{{ old('keterangan', $produk->keterangan) }}</textarea>
        </div>
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Data Produk</button>
            <a href="{{ route('produk.index') }}" class="ml-2 text-gray-600">Batal</a>
        </div>
    </form>
</div>
@endsection
