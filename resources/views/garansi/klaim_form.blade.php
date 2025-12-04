<h1>Klaim Garansi</h1>

<div style="margin-bottom:12px;">
    <strong>Referensi Garansi:</strong> {{ $garansi['referensi_nomor'] }}<br>
    <strong>Pelanggan:</strong> {{ $garansi['pelanggan'] }} ({{ $garansi['nomor_hp'] }})
</div>

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

<form method="POST" action="{{ route('garansi.klaim.store', $garansi['id']) }}">
    @csrf
    <div style="margin-bottom:12px;">
        <label for="deskripsi_keluhan">Deskripsi Keluhan</label><br>
        <textarea id="deskripsi_keluhan" name="deskripsi_keluhan" rows="4" required>{{ old('deskripsi_keluhan') }}</textarea>
    </div>

    <div style="margin-bottom:12px;">
        <label for="status_klaim">Status Klaim</label><br>
        <select id="status_klaim" name="status_klaim" required>
            @foreach($statusKlaim as $status)
                <option value="{{ $status }}" @selected(old('status_klaim', 'Diajukan') === $status)>{{ $status }}</option>
            @endforeach
        </select>
    </div>

    <div style="margin-bottom:12px;">
        <label for="catatan_penyelesaian">Catatan Penyelesaian (opsional)</label><br>
        <textarea id="catatan_penyelesaian" name="catatan_penyelesaian" rows="3">{{ old('catatan_penyelesaian') }}</textarea>
    </div>

    <button type="submit" style="padding:10px 16px;background:#38c172;color:#fff;border:none;border-radius:4px;">Kirim Klaim</button>
    <a href="{{ route('garansi.show', $garansi['id']) }}" style="margin-left:8px;">Batal</a>
</form>
