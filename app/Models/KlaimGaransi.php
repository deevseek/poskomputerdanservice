<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model untuk klaim garansi yang diajukan pelanggan.
 */
class KlaimGaransi extends Model
{
    use HasFactory;

    protected $table = 'klaim_garansi';

    protected $fillable = [
        'tenant_id',
        'garansi_id',
        'pelanggan_id',
        'deskripsi_keluhan',
        'teknisi_id',
        'status_klaim',
        'catatan_penyelesaian',
    ];

    public function garansi()
    {
        return $this->belongsTo(Garansi::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }
}
