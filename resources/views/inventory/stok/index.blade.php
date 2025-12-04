@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Pergerakan Stok</h1>
    <div class="grid grid-cols-2 gap-4 mb-6">
        <form action="{{ route('stok.tambah') }}" method="POST" class="space-y-2 border p-4 rounded">
            @csrf
            <h2 class="font-semibold">Tambah Stok</h2>
            <select name="produk_id" class="w-full border rounded p-2">
                @foreach($produk as $p)
                    <option value="{{ $p->id }}">{{ $p->nama_produk }} ({{ $p->stok }})</option>
                @endforeach
            </select>
            <input type="number" name="jumlah" min="1" class="w-full border rounded p-2" placeholder="Jumlah">
            <input type="text" name="keterangan" class="w-full border rounded p-2" placeholder="Keterangan">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Tambah</button>
        </form>
        <form action="{{ route('stok.kurangi') }}" method="POST" class="space-y-2 border p-4 rounded">
            @csrf
            <h2 class="font-semibold">Kurangi Stok</h2>
            <select name="produk_id" class="w-full border rounded p-2">
                @foreach($produk as $p)
                    <option value="{{ $p->id }}">{{ $p->nama_produk }} ({{ $p->stok }})</option>
                @endforeach
            </select>
            <input type="number" name="jumlah" min="1" class="w-full border rounded p-2" placeholder="Jumlah">
            <input type="text" name="keterangan" class="w-full border rounded p-2" placeholder="Keterangan">
            <button class="bg-red-600 text-white px-4 py-2 rounded">Kurangi</button>
        </form>
    </div>
    <table class="min-w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Produk</th>
                <th class="p-2">Tipe</th>
                <th class="p-2">Sumber</th>
                <th class="p-2">Jumlah</th>
                <th class="p-2">Keterangan</th>
                <th class="p-2">Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($riwayat as $item)
            <tr class="border-t">
                <td class="p-2">{{ $item->produk->nama_produk }}</td>
                <td class="p-2">{{ $item->tipe }}</td>
                <td class="p-2">{{ $item->sumber }}</td>
                <td class="p-2">{{ $item->jumlah }}</td>
                <td class="p-2">{{ $item->keterangan }}</td>
                <td class="p-2">{{ $item->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
