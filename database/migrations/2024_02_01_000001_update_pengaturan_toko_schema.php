<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pengaturan_toko', function (Blueprint $table) {
            if (!Schema::hasColumn('pengaturan_toko', 'key')) {
                $table->string('key')->after('tenant_id');
                $table->text('value')->nullable()->after('key');
                $table->unique(['tenant_id', 'key'], 'pengaturan_toko_tenant_key_unique');
            }
            if (Schema::hasColumn('pengaturan_toko', 'kunci') && !Schema::hasColumn('pengaturan_toko', 'key')) {
                // Placeholder if renaming is preferred in future.
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengaturan_toko', function (Blueprint $table) {
            if (Schema::hasColumn('pengaturan_toko', 'value')) {
                $table->dropColumn(['value']);
            }
            if (Schema::hasColumn('pengaturan_toko', 'key')) {
                $table->dropUnique('pengaturan_toko_tenant_key_unique');
                $table->dropColumn(['key']);
            }
        });
    }
};
