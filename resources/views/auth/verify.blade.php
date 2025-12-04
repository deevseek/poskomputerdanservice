@extends('auth.layout')

@section('title', 'Verifikasi Email')
@section('subtitle', 'Kami telah mengirim tautan verifikasi ke email Anda.')

@section('content')
    <div class="space-y-4">
        @if (session('resent') || session('status'))
            @include('auth.components.alert', ['type' => 'success', 'message' => session('status') ?? 'Tautan verifikasi baru telah dikirim ke email Anda.'])
        @endif

        <p class="rounded-xl bg-white/60 px-4 py-3 text-sm leading-relaxed text-slate-600 shadow-inner shadow-white/40 ring-1 ring-slate-200/60 dark:bg-slate-900/70 dark:text-slate-200 dark:ring-slate-800/80">
            Sebelum lanjut, harap cek email dan klik tautan verifikasi. Jika belum menerima email, kirim ulang menggunakan tombol di bawah ini.
        </p>

        <form method="POST" action="{{ route('verification.resend') }}" class="space-y-3">
            @csrf
            @component('auth.components.button', ['type' => 'submit'])
                Kirim Ulang Email Verifikasi
            @endcomponent
        </form>

        <div class="text-center text-xs text-slate-500 dark:text-slate-300">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="font-semibold text-primary hover:text-indigo-700 dark:text-accent">Keluar akun</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </div>
@endsection
