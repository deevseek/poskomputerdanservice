@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Tambah Transaksi Keuangan</h1>
    <form action="{{ route('keuangan.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block font-semibold">Tipe Transaksi</label>
            <select name="tipe" class="w-full border rounded p-2">
                <option value="pemasukan">Pemasukan</option>
                <option value="pengeluaran">Pengeluaran</option>
            </select>
        </div>
        <div>
            <label class="block font-semibold">Kategori</label>
            <select name="kategori" class="w-full border rounded p-2">
                <option>Penjualan</option>
                <option>Servis</option>
                <option>Pengeluaran Operasional</option>
                <option>Pembelian Produk</option>
                <option>Gaji Teknisi</option>
                <option>Lain-lain</option>
            </select>
        </div>
        <div>
            <label class="block font-semibold">Nominal</label>
            <input type="number" name="nominal" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block font-semibold">Tanggal Transaksi</label>
            <input type="date" name="tanggal_transaksi" value="{{ date('Y-m-d') }}" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block font-semibold">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border rounded p-2"></textarea>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Transaksi</button>
    </form>
</div>
@endsection
