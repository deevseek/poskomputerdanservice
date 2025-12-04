<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model untuk paket langganan yang bisa dipilih tenant.
 */
class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_paket',
        'harga_per_bulan',
        'harga_per_tahun',
        'maksimal_pengguna',
        'maksimal_produk',
        'fitur',
    ];

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }
}
