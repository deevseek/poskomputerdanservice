<h1>Detail Tiket Servis</h1>

@if(session('success'))
    <p><strong>{{ session('success') }}</strong></p>
@endif

<div>
    <p><strong>Kode:</strong> {{ $servis['kode'] }}</p>
    <p><strong>Pelanggan:</strong> {{ $servis['pelanggan'] }} ({{ $servis['kontak'] }})</p>
    <p><strong>Perangkat:</strong> {{ $servis['perangkat'] }}</p>
    <p><strong>Keluhan:</strong> {{ $servis['keluhan'] }}</p>
    <p><strong>Teknisi:</strong> {{ $servis['teknisi'] }}</p>
    <p><strong>Status:</strong> {{ $servis['status'] }}</p>
    <p><strong>Catatan:</strong> {{ $servis['catatan'] }}</p>
</div>

<hr>
<h2>Ubah Status</h2>
<form method="POST" action="{{ route('servis.updateStatus', $servis['id']) }}">
    @csrf
    <label for="status">Status Servis</label>
    <select id="status" name="status" required>
        @foreach($statuses as $status)
            <option value="{{ $status }}" {{ $servis['status'] === $status ? 'selected' : '' }}>{{ $status }}</option>
        @endforeach
    </select>
    <button type="submit">Update Status</button>
</form>

<hr>
<h2>Tambah Sparepart</h2>
<form method="POST" action="{{ route('servis.tambahSparepart', $servis['id']) }}">
    @csrf
    <div>
        <label for="produk_id">Produk</label><br>
        <select name="produk_id" id="produk_id" required>
            <option value="">Pilih Produk</option>
            @foreach($spareparts as $produk)
                <option value="{{ $produk['id'] }}">{{ $produk['nama'] }} (Stok: {{ $produk['stok'] }})</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="jumlah">Jumlah Pakai</label><br>
        <input type="number" name="jumlah" id="jumlah" min="1" value="1" required>
    </div>
    <button type="submit">Tambahkan</button>
</form>

<p><a href="{{ route('servis.index') }}">Kembali ke daftar tiket</a></p>
