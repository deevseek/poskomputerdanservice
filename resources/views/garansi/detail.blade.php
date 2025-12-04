<h1>Detail Garansi</h1>

@if(session('success'))
    <div style="background:#e6ffed;border:1px solid #2ecc71;padding:10px;margin-bottom:16px;">
        {{ session('success') }}
    </div>
@endif

<div style="margin-bottom:12px;">
    <strong>Jenis Garansi:</strong> {{ ucfirst($garansi['jenis_garansi']) }}<br>
    <strong>Referensi:</strong> {{ $garansi['referensi_nomor'] }}<br>
    <strong>Pelanggan:</strong> {{ $garansi['pelanggan'] }} ({{ $garansi['nomor_hp'] }})<br>
    <strong>Periode:</strong> {{ $garansi['tanggal_mulai'] }} s/d {{ $garansi['tanggal_berakhir'] }}<br>
    <strong>Status:</strong> {{ $garansi['status'] }}
</div>

<div style="margin-bottom:12px;">
    <h3>Syarat &amp; Ketentuan</h3>
    <p>{{ $garansi['syarat_ketentuan'] }}</p>
</div>

<div style="margin-bottom:12px;">
    <a href="{{ route('garansi.klaim.create', $garansi['id']) }}" style="padding:8px 12px;background:#f6993f;color:#fff;text-decoration:none;border-radius:4px;">Ajukan Klaim Garansi</a>
    <a href="{{ route('garansi.index') }}" style="margin-left:8px;">Kembali ke daftar</a>
</div>

<h3>Riwayat Klaim</h3>
<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Deskripsi</th>
            <th>Status</th>
            <th>Catatan Penyelesaian</th>
        </tr>
    </thead>
    <tbody>
        @forelse($klaimList as $klaim)
            <tr>
                <td>{{ $klaim['tanggal_dibuat'] }}</td>
                <td>{{ $klaim['deskripsi_keluhan'] }}</td>
                <td>{{ $klaim['status_klaim'] }}</td>
                <td>{{ $klaim['catatan_penyelesaian'] ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Belum ada klaim garansi untuk kasus ini.</td>
            </tr>
        @endforelse
    </tbody>
</table>
