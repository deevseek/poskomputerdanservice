<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model untuk data pelanggan per tenant.
 */
class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'nama_pelanggan',
        'nomor_hp',
        'alamat',
        'email',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
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

    public function klaimGaransi()
    {
        return $this->hasMany(KlaimGaransi::class);
    }
}
