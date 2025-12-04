@extends('auth.layout')

@section('title', 'Registrasi Superadmin')
@section('subtitle', 'Buat akun pemilik untuk mengelola seluruh sistem.')

@php
    $userIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M4.5 20.118a7.5 7.5 0 0 1 15 0A17.933 17.933 0 0 1 12 21.75c-2.657 0-5.186-.568-7.5-1.632Z"/></svg>';
    $emailIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M3 8l7.89 5.26a2 2 0 0 0 2.22 0L21 8m-2 9H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2Z"/></svg>';
    $passwordIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7Z"/></svg>';
@endphp

@section('content')
    <div class="space-y-4">
        @if ($errors->any())
            @include('auth.components.alert', ['type' => 'error', 'message' => 'Lengkapi formulir dengan benar untuk membuat akun.'])
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            @include('auth.components.input', [
                'id' => 'name',
                'name' => 'name',
                'type' => 'text',
                'label' => 'Nama Lengkap',
                'placeholder' => 'Nama pemilik / admin utama',
                'autocomplete' => 'name',
                'icon' => $userIcon,
            ])

            @include('auth.components.input', [
                'id' => 'email',
                'name' => 'email',
                'type' => 'email',
                'label' => 'Email',
                'placeholder' => 'email@toko.com',
                'autocomplete' => 'email',
                'icon' => $emailIcon,
            ])

            @include('auth.components.input', [
                'id' => 'password',
                'name' => 'password',
                'type' => 'password',
                'label' => 'Password',
                'placeholder' => 'Minimal 8 karakter',
                'autocomplete' => 'new-password',
                'icon' => $passwordIcon,
            ])

            <input type="hidden" name="role" value="pemilik">

            @component('auth.components.button', ['type' => 'submit'])
                Daftar sebagai Pemilik
            @endcomponent
        </form>

        <div class="text-center text-xs text-slate-500 dark:text-slate-300">
            <a href="{{ route('login') }}" class="font-semibold text-primary hover:text-indigo-700 dark:text-accent">Sudah punya akun? Masuk</a>
        </div>
    </div>
@endsection
