<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model untuk catatan garansi produk atau servis.
 */
class Garansi extends Model
{
    use HasFactory;

    protected $table = 'garansi';

    protected $fillable = [
        'tenant_id',
        'jenis_garansi',
        'referensi_id',
        'pelanggan_id',
        'tanggal_mulai',
        'tanggal_berakhir',
        'syarat_ketentuan',
        'status',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function klaimGaransi()
    {
        return $this->hasMany(KlaimGaransi::class);
    }
}
