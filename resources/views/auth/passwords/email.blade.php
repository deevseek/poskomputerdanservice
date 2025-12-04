@extends('auth.layout')

@section('title', 'Atur Ulang Password')
@section('subtitle', 'Kami akan mengirimkan tautan reset ke email Anda.')

@php
    $emailIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M3 8l7.89 5.26a2 2 0 0 0 2.22 0L21 8m-2 9H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2Z"/></svg>';
@endphp

@section('content')
    <div class="space-y-4">
        @if (session('status'))
            @include('auth.components.alert', ['type' => 'success', 'message' => session('status')])
        @endif

        @if ($errors->any())
            @include('auth.components.alert', ['type' => 'error', 'message' => 'Email tidak ditemukan atau terjadi kesalahan.'])
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            @include('auth.components.input', [
                'id' => 'email',
                'name' => 'email',
                'type' => 'email',
                'label' => 'Email Terdaftar',
                'placeholder' => 'email@toko.com',
                'autocomplete' => 'email',
                'icon' => $emailIcon,
            ])

            @component('auth.components.button', ['type' => 'submit'])
                Kirim Tautan Reset
            @endcomponent
        </form>

        <div class="text-center text-xs text-slate-500 dark:text-slate-300">
            <a href="{{ route('login') }}" class="font-semibold text-primary hover:text-indigo-700 dark:text-accent">Kembali ke halaman masuk</a>
        </div>
    </div>
@endsection
