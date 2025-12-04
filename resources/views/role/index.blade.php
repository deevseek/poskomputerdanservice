@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Manajemen Role</h1>
        <a href="{{ route('role.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Role</a>
    </div>
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    <table class="min-w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 text-left">Nama Role</th>
                <th class="p-2 text-left">Deskripsi</th>
                <th class="p-2">Permission</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr class="border-t">
                <td class="p-2">{{ $role->nama_role }}</td>
                <td class="p-2">{{ $role->deskripsi }}</td>
                <td class="p-2">{{ $role->permissions->pluck('nama_permission')->implode(', ') }}</td>
                <td class="p-2 space-x-2">
                    <a href="{{ route('role.edit', $role->id) }}" class="text-blue-600">Edit</a>
                    <form action="{{ route('role.hapus', $role->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600" onclick="return confirm('Hapus role ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
