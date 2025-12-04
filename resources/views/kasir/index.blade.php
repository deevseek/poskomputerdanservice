@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
    <div>
        <h1 class="text-2xl font-semibold">POS (Kasir)</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400">Transaksi penjualan cepat dan akurat</p>
    </div>
    <div class="flex items-center gap-2">
        <button class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 shadow-sm transition hover:border-primary hover:text-primary dark:border-slate-700 dark:bg-slate-800">Selaraskan Harga</button>
        <button class="rounded-xl bg-primary px-4 py-2 text-sm font-semibold text-white shadow">Tutup Shift</button>
    </div>
</div>

<div class="grid gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2 space-y-6">
        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-700 dark:bg-slate-800">
            <div class="flex flex-wrap items-center gap-3">
                <div class="relative flex-1">
                    <input type="text" placeholder="Cari atau scan produk..." class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm shadow-inner outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" />
                    <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607z" /></svg>
                    </span>
                </div>
                <button class="rounded-xl bg-accent px-4 py-3 text-sm font-semibold text-white shadow hover:bg-accent/90">Tambah Manual</button>
            </div>
            <div class="mt-4 flex gap-2 overflow-x-auto pb-2 text-xs font-semibold text-slate-600 dark:text-slate-300">
                @foreach(['Semua','Laptop','Aksesoris','Komponen','Printer','Jasa Servis'] as $filter)
                    <button class="rounded-full border border-slate-200 bg-white px-3 py-1 transition hover:border-primary hover:text-primary dark:border-slate-700 dark:bg-slate-800">{{ $filter }}</button>
                @endforeach
            </div>
        </div>

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            @foreach(range(1,9) as $i)
                <div class="group rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-1 hover:border-primary hover:shadow-lg dark:border-slate-700 dark:bg-slate-800">
                    <div class="aspect-video w-full overflow-hidden rounded-xl bg-slate-100 dark:bg-slate-900">
                        <img src="https://source.unsplash.com/400x300/?laptop,{{ $i }}" alt="Produk" class="h-full w-full object-cover transition duration-300 group-hover:scale-105" />
                    </div>
                    <div class="mt-3 space-y-1">
                        <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">Laptop Seri {{ $i }}</p>
                        <p class="text-xs text-slate-500">SKU-00{{ $i }}</p>
                        <p class="text-lg font-bold text-primary">Rp {{ number_format($i*1250000,0,',','.') }}</p>
                    </div>
                    <div class="mt-3 flex items-center justify-between text-xs text-slate-500">
                        <span class="rounded-full bg-slate-100 px-3 py-1 dark:bg-slate-900">Stok {{ 20-$i }}</span>
                        <button class="rounded-full bg-primary px-3 py-1 text-white shadow hover:bg-primary/90">Tambah</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="lg:col-span-1 space-y-4">
        <div class="sticky top-24 space-y-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-700 dark:bg-slate-800">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold">Keranjang</h3>
                    <span class="rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold text-primary">3 item</span>
                </div>
                <div class="mt-3 space-y-3">
                    @foreach([
                        ['nama'=>'Keyboard Mekanik','qty'=>1,'harga'=>550000],
                        ['nama'=>'Mouse Wireless','qty'=>2,'harga'=>175000],
                        ['nama'=>'Pasta Thermal','qty'=>1,'harga'=>95000],
                    ] as $item)
                        <div class="flex items-center justify-between rounded-xl border border-slate-100 px-3 py-2 dark:border-slate-700">
                            <div>
                                <p class="text-sm font-semibold">{{ $item['nama'] }}</p>
                                <div class="flex items-center gap-2 text-xs text-slate-500">
                                    <span class="rounded-full bg-slate-100 px-2 py-0.5 dark:bg-slate-900">Qty: {{ $item['qty'] }}</span>
                                    <span>Rp {{ number_format($item['harga'],0,',','.') }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="rounded-lg bg-slate-100 px-2 py-1 text-xs dark:bg-slate-900">-</button>
                                <button class="rounded-lg bg-slate-100 px-2 py-1 text-xs dark:bg-slate-900">+</button>
                                <button class="text-red-500 hover:text-red-600">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="mt-3 w-full rounded-xl border border-dashed border-primary px-4 py-2 text-sm font-semibold text-primary hover:bg-primary/5">Tambah catatan</button>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-700 dark:bg-slate-800">
                <h3 class="text-lg font-semibold">Ringkasan Pembayaran</h3>
                <dl class="mt-3 space-y-2 text-sm">
                    <div class="flex justify-between"><dt>Subtotal</dt><dd class="font-semibold">Rp 995.000</dd></div>
                    <div class="flex justify-between"><dt>Diskon</dt><dd class="font-semibold text-emerald-500">- Rp 50.000</dd></div>
                    <div class="flex justify-between"><dt>PPN (10%)</dt><dd class="font-semibold">Rp 94.500</dd></div>
                    <div class="flex justify-between text-lg font-bold"><dt>Total</dt><dd class="text-primary">Rp 1.039.500</dd></div>
                </dl>

                <div class="mt-4 space-y-3">
                    <label class="text-sm font-semibold">Bayar</label>
                    <input type="number" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900" placeholder="Masukkan nominal" />
                    <div class="flex gap-2 text-xs font-semibold text-slate-600 dark:text-slate-300">
                        @foreach(['Rp 100.000','Rp 200.000','Pas'] as $nom)
                            <button class="flex-1 rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 transition hover:border-primary hover:text-primary dark:border-slate-700 dark:bg-slate-900">{{ $nom }}</button>
                        @endforeach
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-between rounded-xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-700 dark:bg-slate-900">
                    <span>Kembalian</span>
                    <span class="text-primary">Rp 60.500</span>
                </div>
                <button class="mt-4 w-full rounded-xl bg-primary px-4 py-3 text-base font-semibold text-white shadow-lg transition hover:-translate-y-0.5 hover:bg-primary/90">Proses Transaksi</button>
                <button class="mt-2 w-full rounded-xl border border-dashed border-slate-300 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:border-primary hover:text-primary dark:border-slate-700 dark:text-slate-200">Simpan sebagai Draft</button>
            </div>
        </div>
    </div>
</div>

<div x-data="{ open: false }" x-show="open" x-cloak class="fixed inset-0 z-40 flex items-center justify-center bg-slate-900/60 p-6 backdrop-blur">
    <div class="w-full max-w-md rounded-2xl border border-slate-200 bg-white p-6 shadow-2xl dark:border-slate-700 dark:bg-slate-800">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold">Struk Transaksi</h3>
            <button @click="open=false" class="text-slate-400 hover:text-slate-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
        <div class="mt-4 space-y-2 text-sm">
            <p class="font-semibold">Kode: PEN-210</p>
            <p>Kasir: Admin</p>
            <div class="rounded-xl bg-slate-50 p-3 dark:bg-slate-900">
                <p>Keyboard Mekanik x1 - Rp 550.000</p>
                <p>Mouse Wireless x2 - Rp 350.000</p>
            </div>
            <p class="font-bold text-primary">Total: Rp 1.039.500</p>
        </div>
        <div class="mt-4 flex items-center justify-end gap-2">
            <button class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-primary hover:text-primary dark:border-slate-700 dark:text-slate-200">Kirim ke Email</button>
            <button class="rounded-xl bg-primary px-4 py-2 text-sm font-semibold text-white shadow">Cetak</button>
        </div>
    </div>
</div>
@endsection
