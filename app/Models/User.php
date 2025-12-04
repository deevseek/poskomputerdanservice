<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Model untuk akun pengguna aplikasi.
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'tenant_id',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function tiketServis()
    {
        return $this->hasMany(TiketServis::class, 'teknisi_id');
    }

    public function klaimGaransi()
    {
        return $this->hasMany(KlaimGaransi::class, 'teknisi_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function permissions()
    {
        return $this->roles()->with('permissions')->get()->pluck('permissions')->flatten()->unique('id');
    }

    public function hasPermission(string $permission): bool
    {
        return $this->permissions()->where('nama_permission', $permission)->isNotEmpty();
    }
}
