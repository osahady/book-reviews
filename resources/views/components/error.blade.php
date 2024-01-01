@props(['field'])

@error($field)
    <span {{ $attributes->merge(['class' => 'text-red-500 text-sm']) }}>{{ $message }}</span>
@enderror
