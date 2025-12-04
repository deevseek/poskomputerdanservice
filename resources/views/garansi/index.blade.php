@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Daftar Garansi</h1>
    <div class="mb-3">
        <a href="{{ route('garansi.create') }}" class="btn btn-primary">Buat Garansi</a>
        <a href="{{ route('garansi.cek') }}" class="btn btn-success">Cek Garansi</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Jenis</th>
                    <th>Pelanggan</th>
                    <th>Periode</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($garansiList as $garansi)
                    <tr>
                        <td>{{ $garansi->id }}</td>
                        <td>{{ ucfirst($garansi->jenis) }}</td>
                        <td>{{ $garansi->pelanggan->nama_pelanggan ?? '-' }}</td>
                        <td>{{ $garansi->tanggal_mulai }} s/d {{ $garansi->tanggal_berakhir }}</td>
                        <td>{{ ucfirst($garansi->status) }}</td>
                        <td><a href="{{ route('garansi.show', $garansi->id) }}" class="btn btn-sm btn-info">Detail</a></td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">Belum ada garansi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $garansiList->links() }}
</div>
@endsection
