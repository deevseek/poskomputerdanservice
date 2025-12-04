<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PergerakanStok extends Model
{
    use HasFactory;

    protected $table = 'pergerakan_stok';

    protected $fillable = ['tenant_id','produk_id','jenis','referensi','jumlah','catatan'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
