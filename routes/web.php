<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController,TenantController,DashboardController,ProdukController,PelangganController,SupplierController,KasirController,ServisController,GaransiController,KlaimGaransiController,LaporanController,TenantRegisterController};

Route::get('/', [TenantController::class, 'daftar'])->name('tenant.daftar');
Route::get('/masuk', [AuthController::class, 'index'])->name('login');

Route::get('/daftar-tenant', [TenantRegisterController::class, 'create'])->name('tenant.register');
Route::post('/daftar-tenant', [TenantRegisterController::class, 'store'])->name('tenant.register.store');

Route::middleware(['tenant', 'auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('produk', ProdukController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('supplier', SupplierController::class);
    Route::get('kasir', [KasirController::class, 'index'])->name('kasir.index');
    Route::post('kasir/transaksi', [KasirController::class, 'store'])->name('kasir.store');
    Route::get('/servis', [ServisController::class, 'index'])->name('servis.index');
    Route::get('/servis/buat', [ServisController::class, 'create'])->name('servis.create');
    Route::post('/servis', [ServisController::class, 'store'])->name('servis.store');
    Route::get('/servis/{id}', [ServisController::class, 'show'])->name('servis.show');
    Route::post('/servis/{id}/update-status', [ServisController::class, 'updateStatus'])->name('servis.updateStatus');
    Route::post('/servis/{id}/tambah-sparepart', [ServisController::class, 'tambahSparepart'])->name('servis.tambahSparepart');
    Route::get('garansi/cek', [GaransiController::class, 'cek'])->name('garansi.cek');
    Route::resource('garansi', GaransiController::class)->except(['show']);
    Route::resource('klaim-garansi', KlaimGaransiController::class);
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
});
