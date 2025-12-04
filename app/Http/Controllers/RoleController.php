<?php

namespace App\Http\Controllers;

use App\Models\{Role, Permission, User};
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $tenantId = $request->user()->tenant_id;
        $roles = Role::where('tenant_id', $tenantId)->with('permissions')->get();

        return view('role.index', compact('roles'));
    }

    public function create(Request $request)
    {
        $permissions = Permission::all();
        $users = User::where('tenant_id', $request->user()->tenant_id)->get();
        return view('role.form', [
            'role' => new Role(),
            'permissions' => $permissions,
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $tenantId = $request->user()->tenant_id;
        $data = $request->validate([
            'nama_role' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
            'users' => 'array',
            'users.*' => 'exists:users,id',
        ]);

        $role = Role::create([
            'tenant_id' => $tenantId,
            'nama_role' => $data['nama_role'],
            'deskripsi' => $data['deskripsi'] ?? null,
        ]);

        $role->permissions()->sync($data['permissions'] ?? []);
        $role->users()->sync($data['users'] ?? []);

        return redirect()->route('role.index')->with('success', 'Role berhasil ditambahkan.');
    }

    public function edit(Request $request, int $id)
    {
        $tenantId = $request->user()->tenant_id;
        $role = Role::where('tenant_id', $tenantId)->findOrFail($id);
        $permissions = Permission::all();
        $users = User::where('tenant_id', $tenantId)->get();

        return view('role.form', compact('role', 'permissions', 'users'));
    }

    public function update(Request $request, int $id)
    {
        $tenantId = $request->user()->tenant_id;
        $role = Role::where('tenant_id', $tenantId)->findOrFail($id);

        $data = $request->validate([
            'nama_role' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
            'users' => 'array',
            'users.*' => 'exists:users,id',
        ]);

        $role->update([
            'nama_role' => $data['nama_role'],
            'deskripsi' => $data['deskripsi'] ?? null,
        ]);

        $role->permissions()->sync($data['permissions'] ?? []);
        $role->users()->sync($data['users'] ?? []);

        return redirect()->route('role.index')->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy(Request $request, int $id)
    {
        $tenantId = $request->user()->tenant_id;
        $role = Role::where('tenant_id', $tenantId)->findOrFail($id);
        $role->permissions()->detach();
        $role->users()->detach();
        $role->delete();

        return redirect()->route('role.index')->with('success', 'Role berhasil dihapus.');
    }
}
