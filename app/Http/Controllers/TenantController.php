<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use Illuminate\Support\Facades\Hash;

class TenantController extends Controller
{
    public function daftar()
    {
        return view('tenant.daftar');
    }

    public function index()
    {
        $tenants = Tenant::with('plan')->latest()->paginate(20);

        return view('tenant.index', compact('tenants'));
    }

    public function suspend($id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->update(['status' => 'suspend']);

        return redirect()->route('admin.tenant')->with('success', 'Tenant berhasil disuspend.');
    }
}
