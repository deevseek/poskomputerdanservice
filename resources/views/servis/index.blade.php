<h1>Daftar Tiket Servis</h1>

@if(session('success'))
    <p><strong>{{ session('success') }}</strong></p>
@endif

<form method="GET" action="{{ route('servis.index') }}">
    <label for="status">Filter Status:</label>
    <select name="status" id="status">
        <option value="">Semua Status</option>
        @foreach($statuses as $status)
            <option value="{{ $status }}" {{ $statusFilter === $status ? 'selected' : '' }}>{{ $status }}</option>
        @endforeach
    </select>
    <button type="submit">Terapkan</button>
</form>

<p><a href="{{ route('servis.create') }}">+ Buat Tiket Servis</a></p>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Pelanggan</th>
            <th>Perangkat</th>
            <th>Teknisi</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($servisList as $servis)
            <tr>
                <td>{{ $servis['kode'] }}</td>
                <td>{{ $servis['pelanggan'] }}</td>
                <td>{{ $servis['perangkat'] }}</td>
                <td>{{ $servis['teknisi'] }}</td>
                <td>{{ $servis['status'] }}</td>
                <td><a href="{{ route('servis.show', $servis['id']) }}">Detail</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="6">Belum ada tiket servis.</td>
            </tr>
        @endforelse
    </tbody>
</table>
