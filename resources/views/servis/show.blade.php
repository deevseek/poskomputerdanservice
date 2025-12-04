@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Detail Tiket Servis #{{ $servis->id }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row mb-3">
        <div class="col-md-6">
            <p><strong>Pelanggan:</strong> {{ $servis->pelanggan->nama_pelanggan ?? '-' }}</p>
            <p><strong>Perangkat:</strong> {{ $servis->jenis_perangkat }} {{ $servis->merk }} {{ $servis->model }}</p>
            <p><strong>Nomor Seri:</strong> {{ $servis->nomor_seri ?? '-' }}</p>
            <p><strong>Keluhan:</strong> {{ $servis->keluhan }}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Teknisi:</strong> {{ $servis->teknisi->name ?? '-' }}</p>
            <p><strong>Status:</strong> {{ $servis->status_servis }}</p>
            <p><strong>Biaya Jasa:</strong> Rp {{ number_format($servis->biaya_jasa,0,',','.') }}</p>
            <p><strong>Catatan:</strong> {{ $servis->catatan_teknisi ?? '-' }}</p>
        </div>
    </div>

    <form class="mb-4" method="POST" action="{{ route('servis.updateStatus', $servis->id) }}">
        @csrf
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Perbarui Status</label>
                <select name="status" class="form-select">
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" @selected($servis->status_servis === $status)>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Catatan Teknisi</label>
                <input type="text" name="catatan_teknisi" value="{{ old('catatan_teknisi', $servis->catatan_teknisi) }}" class="form-control">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100" type="submit">Update</button>
            </div>
        </div>
    </form>

    <h4>Sparepart Digunakan</h4>
    <table class="table table-sm">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($servis->sparepartServis as $sp)
                <tr>
                    <td>{{ $sp->produk->nama_produk }}</td>
                    <td>{{ $sp->qty }}</td>
                    <td>Rp {{ number_format($sp->harga,0,',','.') }}</td>
                    <td>Rp {{ number_format($sp->subtotal,0,',','.') }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">Belum ada sparepart.</td></tr>
            @endforelse
        </tbody>
    </table>

    <form method="POST" action="{{ route('servis.tambahSparepart', $servis->id) }}" class="mt-3">
        @csrf
        <div class="row g-2 align-items-end">
            <div class="col-md-5">
                <label class="form-label">Sparepart</label>
                <select name="produk_id" class="form-select">
                    @foreach($spareparts as $p)
                        <option value="{{ $p->id }}">{{ $p->nama_produk }} (Stok: {{ $p->stok }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Qty</label>
                <input type="number" name="qty" class="form-control" min="1" value="1">
            </div>
            <div class="col-md-3">
                <label class="form-label">Harga Satuan</label>
                <input type="number" step="0.01" name="harga" class="form-control" value="0">
            </div>
            <div class="col-md-1">
                <button class="btn btn-success w-100" type="submit">Tambah</button>
            </div>
        </div>
    </form>
</div>
@endsection
