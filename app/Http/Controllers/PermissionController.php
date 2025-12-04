<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('role.permissions', compact('permissions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_permission' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
        ]);

        Permission::create($data);

        return redirect()->route('permission.index')->with('success', 'Permission baru ditambahkan.');
    }
}
