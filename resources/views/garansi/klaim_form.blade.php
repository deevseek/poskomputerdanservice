@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Buat Klaim Garansi untuk #{{ $garansi->id }}</h1>
    <form method="POST" action="{{ route('garansi.klaim.store', $garansi->id) }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Pelanggan</label>
            <input type="text" class="form-control" value="{{ $garansi->pelanggan->nama_pelanggan ?? '-' }}" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi Keluhan</label>
            <textarea name="deskripsi_keluhan" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Teknisi</label>
            <input type="number" name="teknisi_id" class="form-control" placeholder="ID teknisi (opsional)">
        </div>
        <div class="mb-3">
            <label class="form-label">Status Klaim</label>
            <select name="status_klaim" class="form-select">
                @foreach($statusKlaim as $status)
                    <option value="{{ $status }}">{{ ucfirst(str_replace('_',' ',$status)) }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Catatan Penyelesaian</label>
            <textarea name="catatan_penyelesaian" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Klaim</button>
        <a href="{{ route('garansi.show', $garansi->id) }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
