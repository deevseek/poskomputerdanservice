<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket');
            $table->decimal('harga_per_bulan', 15, 2)->default(0);
            $table->decimal('harga_per_tahun', 15, 2)->default(0);
            $table->integer('maksimal_pengguna')->default(1);
            $table->integer('maksimal_produk')->default(0);
            $table->json('fitur')->nullable();
            $table->timestamps();
        });

        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->nullable()->constrained('plans')->nullOnDelete();
            $table->string('nama_tenant');
            $table->string('slug')->unique();
            $table->string('subdomain')->unique();
            $table->enum('status', ['aktif', 'suspend', 'masa_trial', 'kadaluarsa'])->default('masa_trial');
            $table->date('trial_berakhir_pada')->nullable();
            $table->date('langganan_berakhir_pada')->nullable();
            $table->timestamps();
        });

        if (! Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->foreignId('tenant_id')->nullable()->constrained('tenants')->nullOnDelete();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->enum('role', ['pemilik', 'admin', 'kasir', 'teknisi', 'keuangan', 'viewer'])->default('viewer');
                $table->rememberToken();
                $table->timestamps();
            });
        } else {
            Schema::table('users', function (Blueprint $table) {
                if (! Schema::hasColumn('users', 'tenant_id')) {
                    $table->foreignId('tenant_id')->nullable()->after('id')->constrained('tenants')->nullOnDelete();
                }

                if (! Schema::hasColumn('users', 'role')) {
                    $table->enum('role', ['pemilik', 'admin', 'kasir', 'teknisi', 'keuangan', 'viewer'])->default('viewer')->after('password');
                }
            });
        }

        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->string('nama_pelanggan');
            $table->string('nomor_hp')->nullable();
            $table->string('alamat')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });

        Schema::create('supplier', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->string('nama_supplier');
            $table->string('kontak')->nullable();
            $table->string('alamat')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        Schema::create('kategori_produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->string('nama_kategori');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('kategori_produk_id')->nullable()->constrained('kategori_produk')->nullOnDelete();
            $table->string('nama_produk');
            $table->string('kode_sku')->unique();
            $table->enum('jenis_produk', ['barang_fisik', 'sparepart_servis']);
            $table->decimal('harga_beli', 15, 2)->default(0);
            $table->decimal('harga_jual', 15, 2)->default(0);
            $table->integer('stok')->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::create('pergerakan_stok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('produk_id')->constrained('produk')->cascadeOnDelete();
            $table->enum('jenis', ['stok_masuk', 'stok_keluar']);
            $table->string('referensi')->nullable();
            $table->integer('jumlah');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('pelanggan_id')->nullable()->constrained('pelanggan')->nullOnDelete();
            $table->string('nomor_invoice')->unique();
            $table->decimal('subtotal', 15, 2);
            $table->decimal('diskon', 15, 2)->default(0);
            $table->decimal('pajak', 15, 2)->default(0);
            $table->decimal('total', 15, 2);
            $table->decimal('dibayar', 15, 2);
            $table->decimal('kembalian', 15, 2)->default(0);
            $table->enum('metode_pembayaran', ['tunai', 'transfer', 'qris']);
            $table->timestamps();
        });

        Schema::create('item_penjualan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penjualan_id')->constrained('penjualan')->cascadeOnDelete();
            $table->foreignId('produk_id')->constrained('produk');
            $table->integer('qty');
            $table->decimal('harga', 15, 2);
            $table->decimal('total', 15, 2);
            $table->timestamps();
        });

        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penjualan_id')->constrained('penjualan')->cascadeOnDelete();
            $table->decimal('nominal', 15, 2);
            $table->enum('metode', ['tunai', 'transfer', 'qris']);
            $table->timestamps();
        });

        Schema::create('tiket_servis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('pelanggan_id')->nullable()->constrained('pelanggan')->nullOnDelete();
            $table->string('nomor_tiket')->unique();
            $table->enum('jenis_perangkat', ['laptop', 'pc', 'printer', 'lainnya']);
            $table->string('merk_model')->nullable();
            $table->string('nomor_seri')->nullable();
            $table->text('keluhan');
            $table->foreignId('teknisi_id')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('biaya_jasa', 15, 2)->default(0);
            $table->enum('status_servis', ['menunggu', 'diperiksa', 'menunggu_sparepart', 'sedang_dikerjakan', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->timestamps();
        });

        Schema::create('sparepart_servis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tiket_servis_id')->constrained('tiket_servis')->cascadeOnDelete();
            $table->foreignId('produk_id')->constrained('produk');
            $table->integer('qty');
            $table->decimal('biaya', 15, 2);
            $table->timestamps();
        });

        Schema::create('garansi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->enum('jenis_garansi', ['produk', 'servis']);
            $table->unsignedBigInteger('referensi_id');
            $table->foreignId('pelanggan_id')->nullable()->constrained('pelanggan')->nullOnDelete();
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->text('syarat_ketentuan')->nullable();
            $table->enum('status', ['aktif', 'kadaluarsa', 'dibatalkan'])->default('aktif');
            $table->timestamps();
        });

        Schema::create('klaim_garansi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('garansi_id')->constrained('garansi')->cascadeOnDelete();
            $table->foreignId('pelanggan_id')->nullable()->constrained('pelanggan')->nullOnDelete();
            $table->text('deskripsi_keluhan');
            $table->foreignId('teknisi_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status_klaim', ['diajukan', 'disetujui', 'ditolak', 'dalam_proses', 'selesai'])->default('diajukan');
            $table->text('catatan_penyelesaian')->nullable();
            $table->timestamps();
        });

        Schema::create('pengaturan_toko', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->string('kunci');
            $table->text('nilai')->nullable();
            $table->timestamps();

            $table->unique(['tenant_id', 'kunci']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan_toko');
        Schema::dropIfExists('klaim_garansi');
        Schema::dropIfExists('garansi');
        Schema::dropIfExists('sparepart_servis');
        Schema::dropIfExists('tiket_servis');
        Schema::dropIfExists('pembayaran');
        Schema::dropIfExists('item_penjualan');
        Schema::dropIfExists('penjualan');
        Schema::dropIfExists('pergerakan_stok');
        Schema::dropIfExists('produk');
        Schema::dropIfExists('kategori_produk');
        Schema::dropIfExists('supplier');
        Schema::dropIfExists('pelanggan');
        Schema::dropIfExists('users');
        Schema::dropIfExists('tenants');
        Schema::dropIfExists('plans');
    }
};
