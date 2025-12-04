<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketServis extends Model
{
    use HasFactory;

    protected $table = 'tiket_servis';

    protected $fillable = [
        'tenant_id','pelanggan_id','nomor_tiket','jenis_perangkat','merk_model','nomor_seri','keluhan','teknisi_id','biaya_jasa','status_servis'
    ];

    public function spareparts()
    {
        return $this->hasMany(PemakaianSparepart::class, 'tiket_servis_id');
    }
}
