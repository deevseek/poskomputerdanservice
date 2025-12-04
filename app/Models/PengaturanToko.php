<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model untuk pengaturan key/value per tenant.
 */
class PengaturanToko extends Model
{
    use HasFactory;

    protected $table = 'pengaturan_toko';

    protected $fillable = [
        'tenant_id',
        'key',
        'value',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
