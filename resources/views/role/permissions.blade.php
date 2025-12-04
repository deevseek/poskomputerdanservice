@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Daftar Permission</h1>
    <form action="{{ route('permission.store') }}" method="POST" class="mb-4 space-y-2">
        @csrf
        <div>
            <label class="block font-semibold">Nama Permission</label>
            <input type="text" name="nama_permission" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block font-semibold">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border rounded p-2"></textarea>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Permission</button>
    </form>
    <table class="min-w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 text-left">Nama Permission</th>
                <th class="p-2 text-left">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
            <tr class="border-t">
                <td class="p-2">{{ $permission->nama_permission }}</td>
                <td class="p-2">{{ $permission->deskripsi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
