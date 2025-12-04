<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiKeuangan extends Model
{
    use HasFactory;

    protected $table = 'transaksi_keuangan';

    protected $fillable = [
        'tenant_id',
        'tipe',
        'kategori',
        'nominal',
        'deskripsi',
        'tanggal_transaksi',
        'referensi_id',
        'referensi_tipe',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
