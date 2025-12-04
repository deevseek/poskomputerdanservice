@extends('layouts.app')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-semibold">Tambah Role</h1>
        <p class="text-sm text-slate-500">Buat role baru untuk pengguna</p>
    </div>
    <a href="{{ url('/role') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-primary hover:text-primary dark:border-slate-700 dark:bg-slate-800">Kembali</a>
</div>

<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
    <form class="space-y-4 text-sm">
        <div>
            <label class="font-semibold">Nama Role</label>
            <input type="text" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" />
        </div>
        <div>
            <label class="font-semibold">Deskripsi</label>
            <textarea rows="4" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900"></textarea>
        </div>
        <button class="rounded-xl bg-primary px-5 py-2 text-sm font-semibold text-white shadow hover:bg-primary/90">Simpan Role</button>
    </form>
</div>
@endsection
