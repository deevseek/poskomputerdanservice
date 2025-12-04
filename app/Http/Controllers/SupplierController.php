<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $tenantId = $request->user()->tenant_id;
        $supplier = Supplier::where('tenant_id', $tenantId)->get();
        return view('inventory.supplier.index', compact('supplier'));
    }

    public function create()
    {
        return view('inventory.supplier.form', ['supplier' => new Supplier()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'kontak' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);
        $data['tenant_id'] = $request->user()->tenant_id;
        Supplier::create($data);
        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function edit(Request $request, int $id)
    {
        $supplier = Supplier::where('tenant_id', $request->user()->tenant_id)->findOrFail($id);
        return view('inventory.supplier.form', compact('supplier'));
    }

    public function update(Request $request, int $id)
    {
        $supplier = Supplier::where('tenant_id', $request->user()->tenant_id)->findOrFail($id);
        $data = $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'kontak' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);
        $supplier->update($data);
        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    public function destroy(Request $request, int $id)
    {
        $supplier = Supplier::where('tenant_id', $request->user()->tenant_id)->findOrFail($id);
        $supplier->delete();
        return redirect()->route('supplier.index')->with('success', 'Supplier dihapus.');
    }
}
