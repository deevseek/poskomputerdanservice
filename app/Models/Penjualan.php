<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $fillable = [
        'tenant_id','pelanggan_id','nomor_invoice','subtotal','diskon','pajak','total','dibayar','kembalian','metode_pembayaran'
    ];

    public function items()
    {
        return $this->hasMany(ItemPenjualan::class, 'penjualan_id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'penjualan_id');
    }
}
