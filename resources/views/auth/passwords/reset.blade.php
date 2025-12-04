@extends('auth.layout')

@section('title', 'Simpan Password Baru')
@section('subtitle', 'Masukkan password baru Anda untuk keamanan akun.')

@php
    $emailIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M3 8l7.89 5.26a2 2 0 0 0 2.22 0L21 8m-2 9H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2Z"/></svg>';
    $passwordIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7Z"/></svg>';
@endphp

@section('content')
    <div class="space-y-4">
        @if ($errors->any())
            @include('auth.components.alert', ['type' => 'error', 'message' => 'Pastikan seluruh data sudah benar dan memenuhi ketentuan keamanan.'])
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
            @csrf
            <input type="hidden" name="token" value="{{ $token ?? '' }}">

            @include('auth.components.input', [
                'id' => 'email',
                'name' => 'email',
                'type' => 'email',
                'label' => 'Email',
                'placeholder' => 'email@toko.com',
                'autocomplete' => 'email',
                'value' => $email ?? old('email'),
                'icon' => $emailIcon,
            ])

            @include('auth.components.input', [
                'id' => 'password',
                'name' => 'password',
                'type' => 'password',
                'label' => 'Password Baru',
                'placeholder' => 'Minimal 8 karakter',
                'autocomplete' => 'new-password',
                'icon' => $passwordIcon,
            ])

            @include('auth.components.input', [
                'id' => 'password_confirmation',
                'name' => 'password_confirmation',
                'type' => 'password',
                'label' => 'Konfirmasi Password',
                'placeholder' => 'Ulangi password baru',
                'autocomplete' => 'new-password',
                'icon' => $passwordIcon,
            ])

            @component('auth.components.button', ['type' => 'submit'])
                Simpan Password Baru
            @endcomponent
        </form>

        <div class="text-center text-xs text-slate-500 dark:text-slate-300">
            <a href="{{ route('login') }}" class="font-semibold text-primary hover:text-indigo-700 dark:text-accent">Kembali ke halaman masuk</a>
        </div>
    </div>
@endsection
