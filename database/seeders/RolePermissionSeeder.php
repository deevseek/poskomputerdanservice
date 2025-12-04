<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Role, Permission, Tenant, User};

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $defaultPermissions = [
            ['nama_permission' => 'kelola_produk', 'deskripsi' => 'Mengelola data produk dan stok'],
            ['nama_permission' => 'kelola_stok', 'deskripsi' => 'Menambah atau mengurangi stok'],
            ['nama_permission' => 'kelola_penjualan', 'deskripsi' => 'Mengelola transaksi penjualan'],
            ['nama_permission' => 'kelola_servis', 'deskripsi' => 'Mengelola tiket servis'],
            ['nama_permission' => 'kelola_garansi', 'deskripsi' => 'Mengelola klaim garansi'],
            ['nama_permission' => 'kelola_keuangan', 'deskripsi' => 'Mengelola transaksi keuangan'],
            ['nama_permission' => 'kelola_pengaturan', 'deskripsi' => 'Mengubah pengaturan aplikasi'],
            ['nama_permission' => 'kelola_pengguna', 'deskripsi' => 'Menambah atau mengatur pengguna'],
        ];

        foreach ($defaultPermissions as $permission) {
            Permission::firstOrCreate(['nama_permission' => $permission['nama_permission']], $permission);
        }

        $roleNames = ['pemilik', 'admin', 'kasir', 'teknisi', 'keuangan', 'viewer'];

        $tenant = Tenant::first();
        if (!$tenant) {
            return;
        }

        foreach ($roleNames as $roleName) {
            $role = Role::firstOrCreate(
                ['tenant_id' => $tenant->id, 'nama_role' => $roleName],
                ['deskripsi' => 'Role bawaan: ' . $roleName]
            );

            // Pemilik dan admin mendapatkan semua permission
            if (in_array($roleName, ['pemilik', 'admin'])) {
                $role->permissions()->sync(Permission::pluck('id'));
            }
        }

        $user = User::where('tenant_id', $tenant->id)->first();
        if ($user) {
            $pemilikRole = Role::where('tenant_id', $tenant->id)->where('nama_role', 'pemilik')->first();
            if ($pemilikRole) {
                $user->roles()->syncWithoutDetaching([$pemilikRole->id]);
            }
        }
    }
}
