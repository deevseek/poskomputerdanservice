<h1>Buat Garansi</h1>

@if($errors->any())
    <div style="background:#ffecec;border:1px solid #e3342f;padding:10px;margin-bottom:16px;">
        <strong>Validasi gagal:</strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('garansi.store') }}">
    @csrf
    <div style="margin-bottom:12px;">
        <label for="jenis_garansi">Jenis Garansi</label><br>
        <select id="jenis_garansi" name="jenis_garansi" required>
            <option value="">-- Pilih Jenis --</option>
            @foreach($jenisGaransi as $jenis)
                <option value="{{ $jenis }}" @selected(old('jenis_garansi') === $jenis)>{{ ucfirst($jenis) }}</option>
            @endforeach
        </select>
    </div>

    <div style="margin-bottom:12px;">
        <label for="referensi_nomor">Referensi Penjualan / Tiket Servis</label><br>
        <select id="referensi_nomor" name="referensi_nomor" required>
            <option value="">-- Pilih Referensi --</option>
            <optgroup label="Penjualan">
                @foreach($penjualan as $item)
                    <option value="{{ $item['nomor'] }}" data-id="{{ $item['id'] }}" @selected(old('referensi_nomor') === $item['nomor'])>
                        {{ $item['nomor'] }} - {{ $item['pelanggan'] }}
                    </option>
                @endforeach
            </optgroup>
            <optgroup label="Servis">
                @foreach($servis as $item)
                    <option value="{{ $item['nomor'] }}" data-id="{{ $item['id'] }}" @selected(old('referensi_nomor') === $item['nomor'])>
                        {{ $item['nomor'] }} - {{ $item['pelanggan'] }}
                    </option>
                @endforeach
            </optgroup>
        </select>
        <input type="hidden" name="referensi_id" id="referensi_id" value="{{ old('referensi_id') }}">
    </div>

    <div style="margin-bottom:12px;">
        <label for="pelanggan">Nama Pelanggan</label><br>
        <input type="text" id="pelanggan" name="pelanggan" value="{{ old('pelanggan') }}" required>
    </div>

    <div style="margin-bottom:12px;">
        <label for="nomor_hp">Nomor HP Pelanggan</label><br>
        <input type="text" id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp') }}" required>
    </div>

    <div style="margin-bottom:12px;">
        <label for="tanggal_mulai">Tanggal Mulai</label><br>
        <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
    </div>

    <div style="margin-bottom:12px;">
        <label for="tanggal_berakhir">Tanggal Berakhir</label><br>
        <input type="date" id="tanggal_berakhir" name="tanggal_berakhir" value="{{ old('tanggal_berakhir') }}" required>
    </div>

    <div style="margin-bottom:12px;">
        <label for="syarat_ketentuan">Syarat &amp; Ketentuan</label><br>
        <textarea id="syarat_ketentuan" name="syarat_ketentuan" rows="4" required>{{ old('syarat_ketentuan') }}</textarea>
    </div>

    <button type="submit" style="padding:10px 16px;background:#38c172;color:#fff;border:none;border-radius:4px;">Simpan Garansi</button>
    <a href="{{ route('garansi.index') }}" style="margin-left:8px;">Kembali</a>
</form>

<script>
    const referensiSelect = document.getElementById('referensi_nomor');
    const referensiIdInput = document.getElementById('referensi_id');

    referensiSelect.addEventListener('change', function () {
        const selected = referensiSelect.options[referensiSelect.selectedIndex];
        referensiIdInput.value = selected.getAttribute('data-id') || '';
    });
</script>
