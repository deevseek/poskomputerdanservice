<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_id','nama_toko','slug','nama_pemilik','email','nomor_hp','status','trial_berakhir_pada','langganan_berakhir_pada'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}
