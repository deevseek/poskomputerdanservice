@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Riwayat Penjualan</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                    <th>Metode</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penjualan as $p)
                    <tr>
                        <td>#{{ $p->id }}</td>
                        <td>{{ $p->pelanggan->nama_pelanggan ?? 'Umum' }}</td>
                        <td>Rp {{ number_format($p->total,0,',','.') }}</td>
                        <td>{{ strtoupper($p->metode_pembayaran) }}</td>
                        <td>{{ $p->created_at }}</td>
                        <td><a href="{{ route('kasir.struk', $p->id) }}" class="btn btn-sm btn-primary">Lihat Struk</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $penjualan->links() }}
</div>
@endsection
