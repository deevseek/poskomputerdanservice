<h1>Daftar Garansi</h1>

@if(session('success'))
    <div style="background:#e6ffed;border:1px solid #2ecc71;padding:10px;margin-bottom:16px;">
        {{ session('success') }}
    </div>
@endif

<div style="margin-bottom:16px;">
    <a href="{{ route('garansi.create') }}" style="padding:8px 12px;background:#3490dc;color:#fff;text-decoration:none;border-radius:4px;">Buat Garansi</a>
    <a href="{{ route('garansi.cek') }}" style="padding:8px 12px;background:#38c172;color:#fff;text-decoration:none;border-radius:4px;">Cek Garansi</a>
</div>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Jenis</th>
            <th>Referensi</th>
            <th>Pelanggan</th>
            <th>Periode</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($garansiList as $garansi)
            <tr>
                <td>{{ $garansi['id'] }}</td>
                <td style="text-transform:capitalize;">{{ $garansi['jenis_garansi'] }}</td>
                <td>{{ $garansi['referensi_nomor'] }}</td>
                <td>{{ $garansi['pelanggan'] }}</td>
                <td>{{ $garansi['tanggal_mulai'] }} s/d {{ $garansi['tanggal_berakhir'] }}</td>
                <td><strong>{{ $garansi['status'] }}</strong></td>
                <td>
                    <a href="{{ route('garansi.show', $garansi['id']) }}">Detail</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">Belum ada data garansi.</td>
            </tr>
        @endforelse
    </tbody>
</table>
