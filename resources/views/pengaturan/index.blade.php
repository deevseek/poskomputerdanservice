@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Pengaturan Aplikasi</h1>
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    <form action="{{ route('pengaturan.simpan') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block font-semibold">Nama Toko</label>
            <input type="text" name="nama_toko" value="{{ old('nama_toko', $pengaturan['nama_toko'] ?? '') }}" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block font-semibold">Alamat Toko</label>
            <textarea name="alamat_toko" class="w-full border rounded p-2">{{ old('alamat_toko', $pengaturan['alamat_toko'] ?? '') }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold">Nomor HP / WhatsApp</label>
                <input type="text" name="nomor_hp" value="{{ old('nomor_hp', $pengaturan['nomor_hp'] ?? '') }}" class="w-full border rounded p-2">
            </div>
            <div>
                <label class="block font-semibold">Logo Toko</label>
                <input type="file" name="logo" class="w-full border rounded p-2">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold">Printer Mode</label>
                <select name="printer_mode" class="w-full border rounded p-2">
                    <option value="Thermal" {{ (old('printer_mode', $pengaturan['printer_mode'] ?? '')=='Thermal')?'selected':'' }}>Thermal</option>
                    <option value="A4" {{ (old('printer_mode', $pengaturan['printer_mode'] ?? '')=='A4')?'selected':'' }}>A4</option>
                </select>
            </div>
            <div>
                <label class="block font-semibold">Pengaturan Pajak (%)</label>
                <input type="number" step="0.01" name="pajak_persen" value="{{ old('pajak_persen', $pengaturan['pajak_persen'] ?? '') }}" class="w-full border rounded p-2">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold">Masa Garansi Default (hari)</label>
                <input type="number" name="masa_garansi_default" value="{{ old('masa_garansi_default', $pengaturan['masa_garansi_default'] ?? '') }}" class="w-full border rounded p-2">
            </div>
            <div>
                <label class="block font-semibold">Bahasa</label>
                <input type="text" name="bahasa" value="{{ old('bahasa', $pengaturan['bahasa'] ?? 'Indonesia') }}" class="w-full border rounded p-2">
            </div>
        </div>
        <div>
            <label class="block font-semibold">Zona Waktu</label>
            <input type="text" name="zona_waktu" value="{{ old('zona_waktu', $pengaturan['zona_waktu'] ?? 'Asia/Jakarta') }}" class="w-full border rounded p-2">
        </div>
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Pengaturan</button>
        </div>
    </form>
</div>
@endsection
