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
        'harga_bulanan',
        'harga_tahunan',
        'maksimal_pengguna',
        'maksimal_produk',
        'fitur',
    ];

    protected $casts = [
        'fitur' => 'array',
    ];

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }
}
