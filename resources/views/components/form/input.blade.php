@props([
    'label',
    'name',
    'type' => 'text',
    'placeholder' => '',
    'value' => null,
    'required' => null,
    'readonly' => null,
])

<div class="mb-4">
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        {{ $label }} {{ $required ? '*' : '' }}
    </label>
    <input 
        {{ $required ? 'required' : '' }}
        {{ $readonly ? 'readonly' : '' }}
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}"
        {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
               focus:ring-blue-500 focus:border-blue-500block w-full p-2.5
               dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
               dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) }}/>
    @error($name)
    <span class="text-red-400">{{ $message }}</span>
    @enderror
</div>
