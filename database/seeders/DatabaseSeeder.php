<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Plan, Tenant, KategoriProduk, Produk};
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $basic = Plan::firstOrCreate(
            ['nama_paket' => 'Basic'],
            [
                'harga_bulanan' => 150000,
                'harga_tahunan' => 1500000,
                'maksimal_pengguna' => 5,
                'maksimal_produk' => 500,
                'fitur' => ['pos', 'servis', 'garansi'],
            ]
        );

        $tenant = Tenant::firstOrCreate(
            ['slug' => 'contoh-komputer'],
            [
                'plan_id' => $basic->id,
                'nama_toko' => 'Contoh Komputer',
                'subdomain' => 'contoh',
                'status' => 'aktif',
                'trial_berakhir' => now()->addDays(14),
            ]
        );

        $kategori = KategoriProduk::firstOrCreate(
            [
                'tenant_id' => $tenant->id,
                'nama_kategori' => 'Sparepart',
            ],
            [
                'deskripsi' => 'Komponen komputer',
            ]
        );

        Produk::firstOrCreate(
            [
                'tenant_id' => $tenant->id,
                'sku' => 'SSD-512',
            ],
            [
                'kategori_id' => $kategori->id,
                'nama_produk' => 'SSD 512GB',
                'jenis_produk' => 'barang_fisik',
                'harga_beli' => 500000,
                'harga_jual' => 750000,
                'stok' => 10,
            ]
        );

        $this->call(RolePermissionSeeder::class);
    }
}
