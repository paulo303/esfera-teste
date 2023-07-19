@props([
    'label',
    'name',
    'value' => null,
    'required' => null,
    'options' => [],
    'static' => null,
])
<div class="mb-4">
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        {{ $label }} {{ $required ? '*' : '' }}
    </label>
    <select name="{{ $name }}"
            id="{{ $name }}"
            data-te-select-init data-te-select-filter="true"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
           focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
           dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) }}>

        @if($static)
            @foreach($options as $key => $val)
                <option value="{{ $key }}" @selected(old($name, $value) == $key)>{{ $val }}</option>
            @endforeach
        @else
            @foreach($options as $key => $val)
                <option value="{{ $key }}" @selected(old($name, $value) == $key)>{{ $val }}</option>
            @endforeach
        @endif
    </select>
    @error($name)
    <span class="text-red-400">{{ $message }}</span>
    @enderror
</div>
<div>

</div>