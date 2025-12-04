<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TenantRegisterController extends Controller
{
    public function create()
    {
        $plans = Plan::all();

        return view('tenant.daftar', compact('plans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_toko' => ['required', 'string', 'max:255'],
            'nama_pemilik' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'nomor_hp' => ['required', 'string', 'max:50'],
            'plan_id' => ['nullable', 'exists:plans,id'],
        ]);

        $slug = Str::slug($validated['nama_toko']);

        $tenant = Tenant::create([
            'plan_id' => $validated['plan_id'] ?? null,
            'nama_tenant' => $validated['nama_toko'],
            'slug' => $slug,
            'subdomain' => $slug,
            'status' => 'aktif',
        ]);

        $defaultPassword = 'password123';

        User::create([
            'name' => $validated['nama_pemilik'],
            'email' => $validated['email'],
            'password' => bcrypt($defaultPassword),
            'tenant_id' => $tenant->id,
            'role' => 'pemilik',
        ]);

        return redirect()
            ->route('tenant.register')
            ->with([
                'subdomain' => $slug,
                'default_password' => $defaultPassword,
                'success' => 'Pendaftaran berhasil. Silakan akses aplikasi melalui subdomain: ' . $slug,
            ]);
    }
}
