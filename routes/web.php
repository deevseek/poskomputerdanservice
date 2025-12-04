<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController,TenantController,DashboardController,ProdukController,PelangganController,SupplierController,KasirController,ServisController,GaransiController,KlaimGaransiController,LaporanController,TenantRegisterController, PengaturanController, RoleController, PermissionController, KeuanganController, KategoriController, StokController};

Route::get('/', [TenantController::class, 'daftar'])->name('tenant.daftar');
Route::get('/masuk', [AuthController::class, 'index'])->name('login');

Route::get('/daftar-tenant', [TenantRegisterController::class, 'create'])->name('tenant.register');
Route::post('/daftar-tenant', [TenantRegisterController::class, 'store'])->name('tenant.register.store');
Route::get('/admin/tenant', [TenantController::class, 'index'])->name('admin.tenant');
Route::post('/admin/tenant/{id}/suspend', [TenantController::class, 'suspend'])->name('admin.tenant.suspend');

Route::middleware(['tenant', 'auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('produk', ProdukController::class);
    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
    Route::get('/pelanggan/buat', [PelangganController::class, 'create'])->name('pelanggan.create');
    Route::post('/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
    Route::get('/pelanggan/{id}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
    Route::post('/pelanggan/{id}/update', [PelangganController::class, 'update'])->name('pelanggan.update');
    Route::post('/pelanggan/{id}/hapus', [PelangganController::class, 'destroy'])->name('pelanggan.hapus');
    Route::resource('supplier', SupplierController::class);
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('kasir', [KasirController::class, 'index'])->name('kasir.index');
    Route::post('kasir/proses', [KasirController::class, 'proses'])->name('kasir.proses');
    Route::get('kasir/riwayat', [KasirController::class, 'riwayat'])->name('kasir.riwayat');
    Route::get('kasir/riwayat/{id}', [KasirController::class, 'struk'])->name('kasir.struk');
    Route::get('/stok', [StokController::class, 'index'])->name('stok.index');
    Route::post('/stok/tambah', [StokController::class, 'tambah'])->name('stok.tambah');
    Route::post('/stok/kurangi', [StokController::class, 'kurangi'])->name('stok.kurangi');
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::post('/pengaturan/simpan', [PengaturanController::class, 'simpan'])->name('pengaturan.simpan');
    Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    Route::get('/role/buat', [RoleController::class, 'create'])->name('role.create');
    Route::post('/role', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('/role/{id}/update', [RoleController::class, 'update'])->name('role.update');
    Route::post('/role/{id}/hapus', [RoleController::class, 'destroy'])->name('role.hapus');
    Route::get('/permission', [PermissionController::class, 'index'])->name('permission.index');
    Route::post('/permission', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan.index');
    Route::get('/keuangan/buat', [KeuanganController::class, 'create'])->name('keuangan.buat');
    Route::post('/keuangan', [KeuanganController::class, 'store'])->name('keuangan.store');
    Route::get('/keuangan/laporan', [KeuanganController::class, 'laporan'])->name('keuangan.laporan');
    Route::get('/keuangan/laba-rugi', [KeuanganController::class, 'labaRugi'])->name('keuangan.laba_rugi');
    Route::get('/servis', [ServisController::class, 'index'])->name('servis.index');
    Route::get('/servis/buat', [ServisController::class, 'create'])->name('servis.create');
    Route::post('/servis', [ServisController::class, 'store'])->name('servis.store');
    Route::get('/servis/{id}', [ServisController::class, 'show'])->name('servis.show');
    Route::post('/servis/{id}/update-status', [ServisController::class, 'updateStatus'])->name('servis.updateStatus');
    Route::post('/servis/{id}/tambah-sparepart', [ServisController::class, 'tambahSparepart'])->name('servis.tambahSparepart');
    Route::match(['get','post'], 'garansi/cek', [GaransiController::class, 'cek'])->name('garansi.cek');
    Route::get('garansi/{garansi}/klaim/buat', [KlaimGaransiController::class, 'create'])->name('garansi.klaim.create');
    Route::post('garansi/{garansi}/klaim', [KlaimGaransiController::class, 'store'])->name('garansi.klaim.store');
    Route::resource('garansi', GaransiController::class);
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
});
