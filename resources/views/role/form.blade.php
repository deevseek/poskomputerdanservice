@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">{{ $role->id ? 'Edit Role' : 'Buat Role' }}</h1>
    <form action="{{ $role->id ? route('role.update', $role->id) : route('role.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block font-semibold">Nama Role</label>
            <input type="text" name="nama_role" value="{{ old('nama_role', $role->nama_role) }}" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block font-semibold">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border rounded p-2">{{ old('deskripsi', $role->deskripsi) }}</textarea>
        </div>
        <div>
            <p class="font-semibold mb-2">Pilih Permission</p>
            <div class="grid grid-cols-2 gap-2">
                @foreach($permissions as $permission)
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray())) ? 'checked' : '' }}>
                    <span>{{ $permission->nama_permission }}</span>
                </label>
                @endforeach
            </div>
        </div>
        <div>
            <p class="font-semibold mb-2">Assign ke Pengguna</p>
            <div class="grid grid-cols-2 gap-2">
                @foreach($users as $user)
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="users[]" value="{{ $user->id }}" {{ in_array($user->id, old('users', $role->users->pluck('id')->toArray())) ? 'checked' : '' }}>
                    <span>{{ $user->name }}</span>
                </label>
                @endforeach
            </div>
        </div>
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Role</button>
            <a href="{{ route('role.index') }}" class="ml-2 text-gray-600">Batal</a>
        </div>
    </form>
</div>
@endsection
