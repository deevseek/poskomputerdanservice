@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Daftar Tiket Servis</h1>
    <a href="{{ route('servis.create') }}" class="btn btn-primary mb-3">Tambah Tiket</a>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Perangkat</th>
                    <th>Status</th>
                    <th>Teknisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($servisList as $item)
                    <tr>
                        <td>#{{ $item->id }}</td>
                        <td>{{ $item->pelanggan->nama_pelanggan ?? '-' }}</td>
                        <td>{{ $item->jenis_perangkat }} {{ $item->merk }} {{ $item->model }}</td>
                        <td>{{ $item->status_servis }}</td>
                        <td>{{ $item->teknisi->name ?? '-' }}</td>
                        <td><a href="{{ route('servis.show', $item->id) }}" class="btn btn-sm btn-info">Detail</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada tiket.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $servisList->links() }}
</div>
@endsection
