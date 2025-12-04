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
            'harga_bulanan' => 150000,
            'harga_tahunan' => 1500000,
            'maksimal_pengguna' => 5,
            'maksimal_produk' => 500,
            'fitur' => ['pos','servis','garansi']
        ]);

        $tenant = Tenant::create([
            'plan_id' => $basic->id,
            'nama_toko' => 'Contoh Komputer',
            'slug' => 'contoh-komputer',
            'subdomain' => 'contoh',
            'status' => 'aktif',
            'trial_berakhir' => now()->addDays(14),
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
            'sku' => 'SSD-512',
            'jenis_produk' => 'barang_fisik',
            'harga_beli' => 500000,
            'harga_jual' => 750000,
            'stok' => 10,
        ]);

        $this->call(RolePermissionSeeder::class);
    }
}
