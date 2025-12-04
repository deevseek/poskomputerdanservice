@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">{{ isset($pelanggan) ? 'Edit Pelanggan' : 'Tambah Pelanggan' }}</h1>

    <form method="POST" action="{{ isset($pelanggan) ? route('pelanggan.update', $pelanggan->id) : route('pelanggan.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama_pelanggan" class="form-control" value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nomor HP</label>
            <input type="text" name="nomor_hp" class="form-control" value="{{ old('nomor_hp', $pelanggan->nomor_hp ?? '') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $pelanggan->email ?? '') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control">{{ old('alamat', $pelanggan->alamat ?? '') }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
