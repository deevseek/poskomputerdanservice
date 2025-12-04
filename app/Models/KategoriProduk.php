<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model untuk kategori produk per tenant.
 */
class KategoriProduk extends Model
{
    use HasFactory;

    protected $table = 'kategori_produk';

    protected $fillable = [
        'tenant_id',
        'nama_kategori',
        'deskripsi',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}
