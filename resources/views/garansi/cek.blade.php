@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Cek Garansi</h1>
    <form method="POST" action="{{ route('garansi.cek') }}" class="mb-3">
        @csrf
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Masukkan ID referensi atau nama pelanggan" value="{{ $keyword }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>

    @if($garansi)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Garansi #{{ $garansi->id }}</h5>
                <p class="card-text">Pelanggan: {{ $garansi->pelanggan->nama_pelanggan ?? '-' }}</p>
                <p class="card-text">Periode: {{ $garansi->tanggal_mulai }} - {{ $garansi->tanggal_berakhir }}</p>
                <p class="card-text">Status: {{ ucfirst($garansi->status) }}</p>
                <a href="{{ route('garansi.show', $garansi->id) }}" class="btn btn-link">Lihat Detail</a>
            </div>
        </div>
    @elseif($keyword)
        <div class="alert alert-warning">Garansi tidak ditemukan.</div>
    @endif
</div>
@endsection
