@props(['active'])

@php
$classes = 'inline-flex items-center px-2 pt-1 border-b-4 border-t-4 text-sm font-medium leading-5 transition duration-300' .
            'ease-in-out ' . (($active ?? false)
            ? 'border-stone-500 bg-stone-700 text-stone-200 hover:text-stone-700 hover:bg-stone-200 focus:outline-none focus:border-stone-900 focus:bg-stone-100'
            : 'border-transparent text-stone-700 hover:text-stone-200 hover:border-stone-200 hover:bg-stone-700 focus:outline-none focus:text-stone-700 focus:border-stone-500 focus:bg-stone-100');
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
