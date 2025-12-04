@props([
    'type' => 'info',
    'message' => '',
])

@php
    $isSuccess = $type === 'success';
    $isError = $type === 'error';
    $base = 'flex items-start gap-3 rounded-xl border px-4 py-3 text-sm shadow-sm';
    $styleMap = [
        'success' => 'border-emerald-200 bg-emerald-50/70 text-emerald-900 dark:border-emerald-700/60 dark:bg-emerald-900/30 dark:text-emerald-50',
        'error' => 'border-rose-200 bg-rose-50/80 text-rose-900 dark:border-rose-700/60 dark:bg-rose-900/40 dark:text-rose-50',
        'info' => 'border-slate-200 bg-white/80 text-slate-800 dark:border-slate-700/60 dark:bg-slate-800/80 dark:text-slate-100',
    ];
    $styles = $styleMap[$type] ?? $styleMap['info'];
@endphp

<div {{ $attributes->merge(['class' => $base.' '.$styles]) }}>
    <div class="mt-0.5 text-lg">
        @if ($isSuccess)
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m4.5 12.75 6 6 9-13.5"/></svg>
        @elseif($isError)
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v3m0 3h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
        @else
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
        @endif
    </div>
    <div class="text-sm leading-relaxed">{!! nl2br(e($message)) !!}</div>
</div>
