@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="text-center">{{ $tenant->nama_toko ?? $tenant->nama }}</h4>
            <p class="text-center mb-4">Struk Penjualan #{{ $penjualan->id }}</p>

            <p><strong>Pelanggan:</strong> {{ $penjualan->pelanggan->nama_pelanggan ?? 'Umum' }}</p>
            <p><strong>Tanggal:</strong> {{ $penjualan->created_at }}</p>

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penjualan->itemPenjualan as $item)
                        <tr>
                            <td>{{ $item->produk->nama_produk }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>Rp {{ number_format($item->harga_satuan,0,',','.') }}</td>
                            <td>Rp {{ number_format($item->subtotal,0,',','.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-between">
                <span>Total</span>
                <strong>Rp {{ number_format($penjualan->total,0,',','.') }}</strong>
            </div>
            <div class="d-flex justify-content-between">
                <span>Dibayar</span>
                <strong>Rp {{ number_format($penjualan->bayar,0,',','.') }}</strong>
            </div>
            <div class="d-flex justify-content-between">
                <span>Kembalian</span>
                <strong>Rp {{ number_format($penjualan->kembalian,0,',','.') }}</strong>
            </div>
            <p class="mt-3">Metode: {{ strtoupper($penjualan->metode_pembayaran) }}</p>
            <p>Catatan: {{ $penjualan->catatan ?? '-' }}</p>
        </div>
    </div>
</div>
@endsection
