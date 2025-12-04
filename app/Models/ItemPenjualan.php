<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model untuk detail item pada transaksi penjualan.
 */
class ItemPenjualan extends Model
{
    use HasFactory;

    protected $table = 'item_penjualan';

    protected $fillable = [
        'penjualan_id',
        'produk_id',
        'qty',
        'harga_satuan',
        'subtotal',
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
