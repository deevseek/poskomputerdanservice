<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model untuk pemasok barang per tenant.
 */
class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'nama_supplier',
        'kontak',
        'alamat',
        'catatan',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
