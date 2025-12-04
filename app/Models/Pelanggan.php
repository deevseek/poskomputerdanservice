<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $fillable = ['tenant_id','nama_pelanggan','nomor_hp','alamat','email'];

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }
}
