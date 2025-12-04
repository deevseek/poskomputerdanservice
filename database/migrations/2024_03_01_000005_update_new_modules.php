<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('penjualan')) {
            Schema::table('penjualan', function (Blueprint $table) {
                if (! Schema::hasColumn('penjualan', 'bayar')) {
                    $table->decimal('bayar', 15, 2)->default(0)->after('total');
                }

                if (! Schema::hasColumn('penjualan', 'catatan')) {
                    $table->text('catatan')->nullable()->after('metode_pembayaran');
                }
            });
        }

        if (Schema::hasTable('item_penjualan')) {
            Schema::table('item_penjualan', function (Blueprint $table) {
                if (! Schema::hasColumn('item_penjualan', 'harga_satuan')) {
                    $table->decimal('harga_satuan', 15, 2)->default(0)->after('produk_id');
                }

                if (! Schema::hasColumn('item_penjualan', 'subtotal')) {
                    $table->decimal('subtotal', 15, 2)->default(0)->after('harga_satuan');
                }
            });
        }

        if (Schema::hasTable('pembayaran')) {
            Schema::table('pembayaran', function (Blueprint $table) {
                if (! Schema::hasColumn('pembayaran', 'keterangan')) {
                    $table->text('keterangan')->nullable()->after('metode');
                }
            });
        }

        if (Schema::hasTable('tiket_servis')) {
            Schema::table('tiket_servis', function (Blueprint $table) {
                if (! Schema::hasColumn('tiket_servis', 'merk')) {
                    $table->string('merk')->nullable()->after('jenis_perangkat');
                }

                if (! Schema::hasColumn('tiket_servis', 'model')) {
                    $table->string('model')->nullable()->after('merk');
                }

                if (Schema::hasColumn('tiket_servis', 'merk_model')) {
                    $table->dropColumn('merk_model');
                }

                if (! Schema::hasColumn('tiket_servis', 'nomor_seri')) {
                    $table->string('nomor_seri')->nullable()->after('model');
                }

                if (! Schema::hasColumn('tiket_servis', 'catatan_teknisi')) {
                    $table->text('catatan_teknisi')->nullable()->after('status_servis');
                }
            });
        }

        if (Schema::hasTable('sparepart_servis')) {
            Schema::table('sparepart_servis', function (Blueprint $table) {
                if (! Schema::hasColumn('sparepart_servis', 'harga')) {
                    $table->decimal('harga', 15, 2)->default(0)->after('qty');
                }

                if (! Schema::hasColumn('sparepart_servis', 'subtotal')) {
                    $table->decimal('subtotal', 15, 2)->default(0)->after('harga');
                }

                if (Schema::hasColumn('sparepart_servis', 'biaya')) {
                    $table->dropColumn('biaya');
                }
            });
        }

        if (Schema::hasTable('garansi')) {
            Schema::table('garansi', function (Blueprint $table) {
                if (! Schema::hasColumn('garansi', 'jenis')) {
                    $table->enum('jenis', ['produk', 'servis'])->default('produk')->after('tenant_id');
                }

                if (Schema::hasColumn('garansi', 'jenis_garansi')) {
                    $table->dropColumn('jenis_garansi');
                }
            });
        }

        if (Schema::hasTable('klaim_garansi')) {
            Schema::table('klaim_garansi', function (Blueprint $table) {
                if (! Schema::hasColumn('klaim_garansi', 'tenant_id')) {
                    $table->foreignId('tenant_id')->nullable()->after('id')->constrained('tenants')->nullOnDelete();
                }
            });
        }

        if (Schema::hasTable('tenants')) {
            Schema::table('tenants', function (Blueprint $table) {
                if (Schema::hasColumn('tenants', 'nama_tenant')) {
                    $table->renameColumn('nama_tenant', 'nama_toko');
                }

                if (Schema::hasColumn('tenants', 'trial_berakhir_pada')) {
                    $table->renameColumn('trial_berakhir_pada', 'trial_berakhir');
                }

                if (Schema::hasColumn('tenants', 'langganan_berakhir_pada')) {
                    $table->renameColumn('langganan_berakhir_pada', 'langganan_berakhir');
                }
            });
        }

        if (Schema::hasTable('plans')) {
            Schema::table('plans', function (Blueprint $table) {
                if (Schema::hasColumn('plans', 'harga_per_bulan')) {
                    $table->renameColumn('harga_per_bulan', 'harga_bulanan');
                }

                if (Schema::hasColumn('plans', 'harga_per_tahun')) {
                    $table->renameColumn('harga_per_tahun', 'harga_tahunan');
                }
            });
        }

        if (! Schema::hasTable('subscriptions')) {
            Schema::create('subscriptions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
                $table->foreignId('plan_id')->constrained('plans')->cascadeOnDelete();
                $table->date('mulai');
                $table->date('berakhir')->nullable();
                $table->enum('status', ['aktif', 'nonaktif', 'kedaluwarsa'])->default('aktif');
                $table->timestamps();
            });
        }

        if (Schema::hasTable('pembayaran')) {
            Schema::table('pembayaran', function (Blueprint $table) {
                if (! Schema::hasColumn('pembayaran', 'created_at')) {
                    $table->timestamps();
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('subscriptions')) {
            Schema::dropIfExists('subscriptions');
        }

        // Reversal intentionally minimal to avoid data loss.
    }
};
