<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Tenant</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; }
        .card { max-width: 640px; margin: 0 auto; padding: 1.5rem; border: 1px solid #ccc; border-radius: 8px; }
        .field { margin-bottom: 1rem; }
        label { display: block; font-weight: bold; margin-bottom: 0.25rem; }
        input, select { width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 0.75rem 1.25rem; background: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .alert { padding: 0.75rem 1rem; border-radius: 6px; margin-bottom: 1rem; }
        .alert-success { background: #ecfdf3; border: 1px solid #22c55e; color: #166534; }
        .alert-error { background: #fef2f2; border: 1px solid #ef4444; color: #991b1b; }
        ul { margin: 0.5rem 0 0 1.25rem; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Daftar Tenant Baru</h1>

        @if(session('success'))
            <div class="alert alert-success">
                <p>{{ session('success') }}.</p>
                <p>Silakan akses aplikasi melalui subdomain: <strong>{{ session('subdomain') }}</strong>.</p>
                <p>Kata sandi awal pemilik: <strong>{{ session('default_password') }}</strong>. Segera ubah setelah login.</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <p>Terjadi kesalahan pada data yang dikirimkan:</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('tenant.register.store') }}">
            @csrf
            <div class="field">
                <label for="nama_toko">Nama Toko / Perusahaan</label>
                <input type="text" id="nama_toko" name="nama_toko" value="{{ old('nama_toko') }}" required>
            </div>
            <div class="field">
                <label for="nama_pemilik">Nama Pemilik</label>
                <input type="text" id="nama_pemilik" name="nama_pemilik" value="{{ old('nama_pemilik') }}" required>
            </div>
            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="field">
                <label for="nomor_hp">Nomor HP</label>
                <input type="text" id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp') }}" required>
            </div>
            <div class="field">
                <label for="plan_id">Pilih Paket</label>
                <select id="plan_id" name="plan_id">
                    <option value="">Pilih paket langganan</option>
                    @foreach ($plans as $plan)
                        <option value="{{ $plan->id }}" @selected(old('plan_id') == $plan->id)>{{ $plan->nama_paket }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Daftar</button>
        </form>
    </div>
</body>
</html>
