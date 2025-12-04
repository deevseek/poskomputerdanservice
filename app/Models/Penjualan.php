<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model untuk transaksi penjualan per tenant.
 */
class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $fillable = [
        'tenant_id',
        'pelanggan_id',
        'nomor_invoice',
        'subtotal',
        'diskon',
        'pajak',
        'total',
        'dibayar',
        'kembalian',
        'metode_pembayaran',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function itemPenjualan()
    {
        return $this->hasMany(ItemPenjualan::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
