{{-- create file input component --}}
@props(['id', 'name', 'label'])
<div>
    <input {{ $attributes->merge(['class' => 'block mt-1 w-full', 'type' => 'file', 'name' => $name]) }} />
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>