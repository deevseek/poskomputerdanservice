<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model untuk pembayaran atas penjualan.
 */
class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'penjualan_id',
        'nominal',
        'metode',
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
}
