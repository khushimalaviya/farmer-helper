<form action="{{ $action }}" method="{{ strtoupper($method) === 'GET' ? 'GET' : 'POST' }}" class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow" enctype="multipart/form-data">
    @csrf
    @if(strtoupper($method) !== 'GET' && strtoupper($method) !== 'POST')
        @method($method)
    @endif

    @foreach($fields as $field)
        <div class="mb-4">
            <label class="block text-gray-700">{{ $field['label'] }}</label>
            @if(isset($field['type']) && $field['type'] === 'select')
                <select name="{{ $field['name'] }}" class="w-full p-2 border rounded-md">
                    @foreach($field['options'] as $optionValue => $optionLabel)
                        <option value="{{ $optionValue }}" {{ old($field['name'], $field['value'] ?? '') == $optionValue ? 'selected' : '' }}>{{ $optionLabel }}</option>
                    @endforeach
                </select>
            @elseif(isset($field['type']) && $field['type'] === 'file')
                <input type="file" name="{{ $field['name'] }}" class="w-full p-2 border rounded-md" />
            @else
                <input type="{{ $field['type'] ?? 'text' }}" name="{{ $field['name'] }}" value="{{ old($field['name'], $field['value'] ?? '') }}" placeholder="{{ $field['placeholder'] ?? '' }}" class="w-full p-2 border rounded-md" />
            @endif
            @error($field['name'])
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
    @endforeach

    <!-- Render Hidden Inputs -->
    @foreach($hiddenInputs ?? [] as $name => $value)
        <input type="hidden" id="{{ $name }}" name="{{ $name }}" value="{{ $value }}" />
    @endforeach

    <x-button type="submit" class="w-full">{{ $buttonText }}</x-button>
</form>
