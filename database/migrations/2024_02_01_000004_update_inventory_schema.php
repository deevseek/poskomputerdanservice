<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            if (!Schema::hasColumn('produk', 'kategori_id')) {
                $table->foreignId('kategori_id')->nullable()->after('tenant_id')->constrained('kategori_produk')->nullOnDelete();
            }
            if (!Schema::hasColumn('produk', 'sku')) {
                $table->string('sku')->nullable()->after('nama_produk');
            }
        });

        Schema::table('pergerakan_stok', function (Blueprint $table) {
            if (!Schema::hasColumn('pergerakan_stok', 'tipe')) {
                $table->enum('tipe', ['stok_masuk', 'stok_keluar'])->after('produk_id')->default('stok_masuk');
            }
            if (!Schema::hasColumn('pergerakan_stok', 'sumber')) {
                $table->string('sumber')->nullable()->after('tipe');
            }
            if (!Schema::hasColumn('pergerakan_stok', 'keterangan')) {
                $table->text('keterangan')->nullable()->after('jumlah');
            }
        });
    }

    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            if (Schema::hasColumn('produk', 'kategori_id')) {
                $table->dropForeign(['kategori_id']);
                $table->dropColumn('kategori_id');
            }
            if (Schema::hasColumn('produk', 'sku')) {
                $table->dropColumn('sku');
            }
        });

        Schema::table('pergerakan_stok', function (Blueprint $table) {
            if (Schema::hasColumn('pergerakan_stok', 'tipe')) {
                $table->dropColumn('tipe');
            }
            if (Schema::hasColumn('pergerakan_stok', 'sumber')) {
                $table->dropColumn('sumber');
            }
            if (Schema::hasColumn('pergerakan_stok', 'keterangan')) {
                $table->dropColumn('keterangan');
            }
        });
    }
};
