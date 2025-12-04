<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model untuk data produk yang dijual atau digunakan sebagai sparepart.
 */
class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'tenant_id',
        'kategori_id',
        'nama_produk',
        'sku',
        'jenis_produk',
        'harga_beli',
        'harga_jual',
        'stok',
        'keterangan',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function kategoriProduk()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_id');
    }

    public function pergerakanStok()
    {
        return $this->hasMany(PergerakanStok::class);
    }

    public function itemPenjualan()
    {
        return $this->hasMany(ItemPenjualan::class);
    }

    public function sparepartServis()
    {
        return $this->hasMany(SparepartServis::class);
    }
}
