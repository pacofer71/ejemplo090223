@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'text-xs text-red-600 italic']) }}>{{ $message }}</p>
@enderror
