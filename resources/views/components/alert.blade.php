@props(['type' => 'success'])

@php
    $colors = [
        'success' => 'bg-violet-100 dark:bg-violet-900 text-violet-800 dark:text-violet-200 border-violet-300 dark:border-violet-700',
        'error' => 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 border-red-300 dark:border-red-700',
        'info' => 'bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 border-blue-300 dark:border-blue-700',
        'warning' => 'bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 border-yellow-300 dark:border-yellow-700',
    ];
    $color = $colors[$type] ?? $colors['success'];
@endphp

<div {{ $attributes->merge(["class" => "rounded px-4 py-3 border shadow {$color} font-semibold text-center mb-4 animate-fade-in"]) }}>
    {{ $slot }}
</div>
