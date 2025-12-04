@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Buat Garansi</h1>
    <form method="POST" action="{{ route('garansi.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Pelanggan</label>
            <select name="pelanggan_id" class="form-select">
                <option value="">Pilih Pelanggan</option>
                @foreach($pelanggan as $p)
                    <option value="{{ $p->id }}">{{ $p->nama_pelanggan }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Garansi</label>
            <select name="jenis" class="form-select" required>
                <option value="produk">Produk</option>
                <option value="servis">Servis</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Referensi (ID penjualan/servis)</label>
            <input type="number" name="referensi_id" class="form-control" required>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Berakhir</label>
                <input type="date" name="tanggal_berakhir" class="form-control" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Syarat & Ketentuan</label>
            <textarea name="syarat_ketentuan" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="aktif">Aktif</option>
                <option value="kadaluarsa">Kadaluarsa</option>
                <option value="dibatalkan">Dibatalkan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('garansi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
