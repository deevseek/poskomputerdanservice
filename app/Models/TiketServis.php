<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model untuk tiket servis perangkat pelanggan.
 */
class TiketServis extends Model
{
    use HasFactory;

    protected $table = 'tiket_servis';

    protected $fillable = [
        'tenant_id',
        'pelanggan_id',
        'jenis_perangkat',
        'merk',
        'model',
        'nomor_seri',
        'keluhan',
        'teknisi_id',
        'biaya_jasa',
        'status_servis',
        'catatan_teknisi',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }

    public function sparepartServis()
    {
        return $this->hasMany(SparepartServis::class);
    }
}
