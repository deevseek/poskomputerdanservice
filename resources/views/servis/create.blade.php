@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Buat Tiket Servis</h1>
    <form method="POST" action="{{ route('servis.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Pelanggan</label>
                <select name="pelanggan_id" class="form-select">
                    <option value="">Pilih pelanggan</option>
                    @foreach($pelanggan as $p)
                        <option value="{{ $p->id }}">{{ $p->nama_pelanggan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Teknisi</label>
                <select name="teknisi_id" class="form-select">
                    <option value="">Pilih teknisi</option>
                    @foreach($teknisiList as $t)
                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Jenis Perangkat</label>
                <input type="text" name="jenis_perangkat" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Merk</label>
                <input type="text" name="merk" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Model</label>
                <input type="text" name="model" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nomor Seri</label>
                <input type="text" name="nomor_seri" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Biaya Jasa (Rp)</label>
                <input type="number" step="0.01" name="biaya_jasa" class="form-control" value="0">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Keluhan</label>
            <textarea name="keluhan" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Status Servis</label>
            <select name="status_servis" class="form-select">
                @foreach($statuses as $status)
                    <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Catatan Teknisi</label>
            <textarea name="catatan_teknisi" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('servis.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
