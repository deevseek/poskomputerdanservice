@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Detail Garansi #{{ $garansi->id }}</h1>
    <p><strong>Jenis:</strong> {{ ucfirst($garansi->jenis) }}</p>
    <p><strong>Pelanggan:</strong> {{ $garansi->pelanggan->nama_pelanggan ?? '-' }}</p>
    <p><strong>Periode:</strong> {{ $garansi->tanggal_mulai }} s/d {{ $garansi->tanggal_berakhir }}</p>
    <p><strong>Status:</strong> {{ ucfirst($garansi->status) }}</p>
    <p><strong>Syarat & Ketentuan:</strong> {{ $garansi->syarat_ketentuan ?? '-' }}</p>

    <h4 class="mt-4">Klaim Garansi</h4>
    <a href="{{ route('garansi.klaim.create', $garansi->id) }}" class="btn btn-primary mb-2">Buat Klaim</a>
    <table class="table table-sm">
        <thead>
            <tr>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Teknisi</th>
                <th>Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($klaimList as $klaim)
                <tr>
                    <td>{{ $klaim->deskripsi_keluhan }}</td>
                    <td>{{ ucfirst($klaim->status_klaim) }}</td>
                    <td>{{ $klaim->teknisi->name ?? '-' }}</td>
                    <td>{{ $klaim->created_at }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">Belum ada klaim.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
