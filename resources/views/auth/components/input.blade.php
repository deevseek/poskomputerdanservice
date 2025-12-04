@props([
    'id',
    'label',
    'name',
    'type' => 'text',
    'placeholder' => '',
    'autocomplete' => '',
    'value' => null,
    'icon' => null,
])

<div class="space-y-1">
    <label for="{{ $id }}" class="text-sm font-medium text-slate-700 dark:text-slate-200">{{ $label }}</label>
    <div class="relative group">
        @if ($icon)
            <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400 group-focus-within:text-primary">
                {!! $icon !!}
            </span>
        @endif
        <input
            id="{{ $id }}"
            name="{{ $name }}"
            type="{{ $type }}"
            value="{{ old($name, $value) }}"
            autocomplete="{{ $autocomplete }}"
            placeholder="{{ $placeholder }}"
            class="w-full rounded-xl border border-slate-200 bg-white/70 px-3 py-3 text-sm font-medium text-slate-800 shadow-inner shadow-slate-100 outline-none transition focus:border-primary focus:bg-white focus:shadow-lg focus:shadow-primary/10 focus:ring-2 focus:ring-primary/30 dark:border-slate-700 dark:bg-slate-900/70 dark:text-slate-100 dark:focus:border-accent dark:focus:ring-accent/30 {{ $icon ? 'pl-11' : '' }}" required
        />
    </div>
    @error($name)
        <p class="flex items-center gap-2 rounded-lg bg-rose-100 text-rose-900 px-3 py-2 text-xs font-semibold dark:bg-rose-900/40 dark:text-rose-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v3m0 3h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
            {{ $message }}
        </p>
    @enderror
</div>
