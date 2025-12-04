<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transaksi_keuangan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->enum('tipe', ['pemasukan', 'pengeluaran']);
            $table->string('kategori');
            $table->decimal('nominal', 15, 2);
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_transaksi');
            $table->unsignedBigInteger('referensi_id')->nullable();
            $table->string('referensi_tipe')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_keuangan');
    }
};
