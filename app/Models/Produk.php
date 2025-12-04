<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'tenant_id','kategori_id','nama_produk','kode_sku','jenis_produk','harga_beli','harga_jual','stok','keterangan'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_id');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
