<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model untuk data penyewa (tenant) aplikasi.
 */
class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_id',
        'nama_toko',
        'slug',
        'subdomain',
        'status',
        'trial_berakhir',
        'langganan_berakhir',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function pelanggan()
    {
        return $this->hasMany(Pelanggan::class);
    }

    public function supplier()
    {
        return $this->hasMany(Supplier::class);
    }

    public function kategoriProduk()
    {
        return $this->hasMany(KategoriProduk::class);
    }

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }

    public function pergerakanStok()
    {
        return $this->hasMany(PergerakanStok::class);
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }

    public function tiketServis()
    {
        return $this->hasMany(TiketServis::class);
    }

    public function garansi()
    {
        return $this->hasMany(Garansi::class);
    }

    public function pengaturanToko()
    {
        return $this->hasMany(PengaturanToko::class);
    }
}
