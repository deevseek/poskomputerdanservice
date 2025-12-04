<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_paket','harga_per_bulan','harga_per_tahun','maksimal_pengguna','maksimal_produk','fitur'
    ];

    protected $casts = [
        'fitur' => 'array',
    ];

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }
}
