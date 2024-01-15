

@props(['value'])

<label {{ $attributes->merge(['class' => 'font-openSans text-black-light opacity-80 font-medium text-sm tracking-tight ']) }}>
    {{ $value ?? $slot }}
</label>