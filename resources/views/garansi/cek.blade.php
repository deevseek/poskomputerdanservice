<h1>Cek Garansi</h1>

<form method="GET" action="{{ route('garansi.cek') }}" style="margin-bottom:16px;">
    <label for="q">Nomor Invoice / Nomor Tiket / Nomor HP</label><br>
    <input type="text" id="q" name="q" value="{{ $keyword }}" placeholder="Contoh: INV-2024-001 atau 0812xxxx" required>
    <button type="submit">Cari</button>
</form>

@if($keyword && !$garansi)
    <div style="background:#ffecec;border:1px solid #e3342f;padding:10px;">
        Garansi tidak ditemukan untuk kata kunci "{{ $keyword }}".
    </div>
@endif

@if($garansi)
    <div style="background:#f8fafc;border:1px solid #cbd5e0;padding:12px;">
        <h3>Hasil Pencarian</h3>
        <p><strong>Referensi:</strong> {{ $garansi['referensi_nomor'] }}</p>
        <p><strong>Jenis Garansi:</strong> {{ ucfirst($garansi['jenis_garansi']) }}</p>
        <p><strong>Pelanggan:</strong> {{ $garansi['pelanggan'] }} ({{ $garansi['nomor_hp'] }})</p>
        <p><strong>Periode:</strong> {{ $garansi['tanggal_mulai'] }} s/d {{ $garansi['tanggal_berakhir'] }}</p>
        <p><strong>Status:</strong> {{ $garansi['status'] }}</p>
        <a href="{{ route('garansi.show', $garansi['id']) }}">Lihat detail</a>
    </div>
@endif
