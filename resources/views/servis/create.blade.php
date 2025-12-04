<h1>Buat Tiket Servis</h1>

@if($errors->any())
    <div>
        <p><strong>Terjadi kesalahan:</strong></p>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('servis.store') }}">
    @csrf
    <div>
        <label for="nama_pelanggan">Nama Pelanggan</label><br>
        <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" required>
    </div>

    <div>
        <label for="kontak">Kontak</label><br>
        <input type="text" id="kontak" name="kontak" value="{{ old('kontak') }}" required>
    </div>

    <div>
        <label for="perangkat">Perangkat</label><br>
        <input type="text" id="perangkat" name="perangkat" value="{{ old('perangkat') }}" required>
    </div>

    <div>
        <label for="keluhan">Keluhan</label><br>
        <textarea id="keluhan" name="keluhan" rows="4" required>{{ old('keluhan') }}</textarea>
    </div>

    <div>
        <label for="teknisi">Teknisi</label><br>
        <select id="teknisi" name="teknisi" required>
            <option value="">Pilih Teknisi</option>
            @foreach($teknisiList as $teknisi)
                <option value="{{ $teknisi }}" {{ old('teknisi') === $teknisi ? 'selected' : '' }}>{{ $teknisi }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit">Simpan Tiket</button>
</form>

<p><a href="{{ route('servis.index') }}">Kembali ke daftar tiket</a></p>
