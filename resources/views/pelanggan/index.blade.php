@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Daftar Pelanggan</h1>
    <a href="{{ route('pelanggan.create') }}" class="btn btn-primary mb-3">Tambah Pelanggan</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Nomor HP</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pelanggan as $item)
                    <tr>
                        <td>{{ $item->nama_pelanggan }}</td>
                        <td>{{ $item->nomor_hp ?? '-' }}</td>
                        <td>{{ $item->email ?? '-' }}</td>
                        <td>{{ $item->alamat ?? '-' }}</td>
                        <td>
                            <a href="{{ route('pelanggan.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('pelanggan.hapus', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus pelanggan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data pelanggan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $pelanggan->links() }}
</div>
@endsection
