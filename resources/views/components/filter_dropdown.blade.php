@props(['title' => 'Filter', 'name' => 'filter', 'options' => [], 'selected' => null])

<details class="bg-white rounded-md shadow-sm" {{ $selected ? 'open' : '' }}>
    <summary class="cursor-pointer px-4 py-3 font-semibold flex justify-between items-center">
        {{ $title }}
        <svg class="w-4 h-4 transform transition-transform duration-200 group-open:rotate-180" fill="none"
            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
        </svg>
    </summary>

    <div class="px-4 pb-4">
        <label class="block mb-1 text-sm text-gray-600">{{ $title }}</label>
        <div class="bg-white border rounded px-4 py-2 space-y-2 max-h-60 overflow-y-auto">
            <label class="flex items-center justify-between text-sm text-gray-800 cursor-pointer">
                <div class="flex items-center gap-2">
                    <input type="radio" name="{{ $name }}" value="" class="accent-black"
                        {{ empty($selected) ? 'checked' : '' }} />
                    <span>All</span>
                </div>
                <span class="text-gray-400 text-xs">
                    ({{ array_sum(array_column($options, 'count')) }})
                </span>
            </label>

            @foreach ($options as $option)
                <label class="flex items-center justify-between text-sm text-gray-800 cursor-pointer">
                    <div class="flex items-center gap-2">
                        <input type="radio" name="{{ $name }}" value="{{ $option['value'] }}"
                            class="accent-black" {{ $selected == $option['value'] ? 'checked' : '' }} />
                        <span>{{ $option['label'] }}</span>
                    </div>
                    <span class="text-gray-400 text-xs">
                        ({{ $option['count'] }})
                    </span>
                </label>
            @endforeach
        </div>
    </div>
</details>
