@props([
    'type' => 'submit',
    'href' => null,
])

@php
    $classes = 'group relative inline-flex w-full items-center justify-center gap-2 overflow-hidden rounded-xl bg-gradient-to-r from-primary via-indigo-500 to-accent px-4 py-3 text-sm font-semibold text-white shadow-glow transition hover:-translate-y-0.5 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary';
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        <span class="absolute inset-0 bg-white/10 opacity-0 transition group-hover:opacity-100"></span>
        <span class="relative">{{ $slot }}</span>
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        <span class="absolute inset-0 bg-white/10 opacity-0 transition group-hover:opacity-100"></span>
        <span class="relative">{{ $slot }}</span>
    </button>
@endif
