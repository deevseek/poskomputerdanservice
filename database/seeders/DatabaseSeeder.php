<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Plan, Tenant, KategoriProduk, Produk};
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $basic = Plan::create([
            'nama_paket' => 'Basic',
            'harga_per_bulan' => 150000,
            'harga_per_tahun' => 1500000,
            'maksimal_pengguna' => 5,
            'maksimal_produk' => 500,
            'fitur' => ['pos','servis','garansi']
        ]);

        $tenant = Tenant::create([
            'plan_id' => $basic->id,
            'nama_toko' => 'Contoh Komputer',
            'slug' => 'contoh-komputer',
            'nama_pemilik' => 'Admin Utama',
            'email' => 'admin@contoh.com',
            'nomor_hp' => '08123456789',
            'status' => 'aktif'
        ]);

        $kategori = KategoriProduk::create([
            'tenant_id' => $tenant->id,
            'nama_kategori' => 'Sparepart',
            'deskripsi' => 'Komponen komputer'
        ]);

        Produk::create([
            'tenant_id' => $tenant->id,
            'kategori_id' => $kategori->id,
            'nama_produk' => 'SSD 512GB',
            'kode_sku' => 'SSD-512',
            'jenis_produk' => 'barang_fisik',
            'harga_beli' => 500000,
            'harga_jual' => 750000,
            'stok' => 10,
        ]);
    }
}
