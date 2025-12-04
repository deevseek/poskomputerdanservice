<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garansi extends Model
{
    use HasFactory;

    protected $table = 'garansi';

    protected $fillable = ['tenant_id','jenis_garansi','referensi_id','pelanggan_id','tanggal_mulai','tanggal_berakhir','syarat_ketentuan','status'];

    protected $dates = ['tanggal_mulai','tanggal_berakhir'];

    public function klaim()
    {
        return $this->hasMany(KlaimGaransi::class, 'garansi_id');
    }
}
