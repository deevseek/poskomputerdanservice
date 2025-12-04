<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model untuk pemakaian sparepart pada proses servis.
 */
class SparepartServis extends Model
{
    use HasFactory;

    protected $table = 'sparepart_servis';

    protected $fillable = [
        'tiket_servis_id',
        'produk_id',
        'qty',
        'biaya',
    ];

    public function tiketServis()
    {
        return $this->belongsTo(TiketServis::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
