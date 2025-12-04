@extends('layouts.app')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-semibold">Tambah Produk</h1>
        <p class="text-sm text-slate-500">Lengkapi informasi produk baru</p>
    </div>
    <a href="{{ url('/produk') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-primary hover:text-primary dark:border-slate-700 dark:bg-slate-800">Kembali</a>
</div>

<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
    <form class="grid gap-6 md:grid-cols-2">
        <div class="space-y-4">
            <div>
                <label class="text-sm font-semibold">Nama Produk</label>
                <input type="text" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" placeholder="Masukkan nama" />
            </div>
            <div>
                <label class="text-sm font-semibold">SKU</label>
                <input type="text" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" placeholder="SKU unik" />
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-sm font-semibold">Kategori</label>
                    <select class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900">
                        <option>Laptop</option>
                        <option>Aksesoris</option>
                        <option>Komponen</option>
                    </select>
                </div>
                <div>
                    <label class="text-sm font-semibold">Jenis Produk</label>
                    <select class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary dark:border-slate-700 dark:bg-slate-900">
                        <option>Barang</option>
                        <option>Jasa</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-sm font-semibold">Harga Beli</label>
                    <input type="number" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" placeholder="Rp" />
                </div>
                <div>
                    <label class="text-sm font-semibold">Harga Jual</label>
                    <input type="number" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" placeholder="Rp" />
                </div>
            </div>
            <div>
                <label class="text-sm font-semibold">Stok</label>
                <input type="number" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" placeholder="Jumlah" />
            </div>
        </div>
        <div class="space-y-4">
            <div>
                <label class="text-sm font-semibold">Keterangan</label>
                <textarea rows="5" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" placeholder="Deskripsi produk"></textarea>
            </div>
            <div>
                <label class="text-sm font-semibold">Upload Gambar</label>
                <div class="mt-2 flex items-center gap-4 rounded-xl border border-dashed border-slate-300 bg-slate-50 px-4 py-5 text-sm text-slate-500 dark:border-slate-700 dark:bg-slate-900">
                    <svg class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 16.5v-9m0 0L9 10.5m3-3L15 10.5M6.75 19.5h10.5A2.25 2.25 0 0 0 19.5 17.25V6.75A2.25 2.25 0 0 0 17.25 4.5H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5A2.25 2.25 0 0 0 6.75 19.5z" /></svg>
                    <div>
                        <p class="font-semibold text-slate-700 dark:text-slate-200">Tarik &amp; letakkan file di sini</p>
                        <p class="text-xs">PNG, JPG maksimal 5MB</p>
                    </div>
                    <input type="file" class="hidden" />
                </div>
                <div class="mt-2 h-32 w-full overflow-hidden rounded-xl bg-slate-100 dark:bg-slate-900">
                    <img src="https://source.unsplash.com/400x300/?product" class="h-full w-full object-cover" alt="preview" />
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="reset" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-primary hover:text-primary dark:border-slate-700 dark:text-slate-200">Batal</button>
                <button class="rounded-xl bg-primary px-5 py-2 text-sm font-semibold text-white shadow hover:bg-primary/90">Simpan Produk</button>
            </div>
        </div>
    </form>
</div>
@endsection
