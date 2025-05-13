@props(['title' => 'Filter', 'name' => 'filter', 'options' => []])

<details class="bg-white p-4 rounded shadow">
  <summary class="cursor-pointer font-semibold mb-2">{{ $title }}</summary>

  <div class="mt-2">
    <label class="block mb-1 text-sm text-gray-600">{{ $title }}</label>
    <div class="bg-gray-50 border rounded px-4 py-2 space-y-2 max-h-60 overflow-y-auto">
      @foreach ($options as $option)
      <label class="flex items-center justify-between text-sm text-gray-700 cursor-pointer">
        <div class="flex items-center gap-2">
          <input type="radio" name="{{ $name }}" value="{{ $option['value'] }}" class="accent-orange-500" />
          <span>{{ $option['label'] }}</span>
        </div>
        <span class="text-gray-400 text-xs">( {{ $option['count'] ?? 0 }} )</span>
      </label>
      @endforeach
    </div>
  </div>
</details>