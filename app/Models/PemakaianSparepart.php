<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemakaianSparepart extends Model
{
    use HasFactory;

    protected $table = 'pemakaian_sparepart';

    protected $fillable = ['tiket_servis_id','produk_id','qty','biaya'];
}
