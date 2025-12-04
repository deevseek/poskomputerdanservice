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
    Route::resource('servis', ServisController::class);
    Route::get('garansi/cek', [GaransiController::class, 'cek'])->name('garansi.cek');
    Route::resource('garansi', GaransiController::class)->except(['show']);
    Route::resource('klaim-garansi', KlaimGaransiController::class);
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
});
