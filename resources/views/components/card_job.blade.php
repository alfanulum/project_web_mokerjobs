@props(['job'])

@php
    // Define color schemes for each job type
    $typeColors = [
        'Full Time' => [
            'border' => 'border-orange-400',
            'bg' => 'bg-orange-100',
            'text' => 'text-orange-700',
            'soft_bg' => 'bg-orange-100',
            'button' => 'bg-orange-500 hover:bg-orange-600',
        ],
        'Fulltime' => [
            // Alternative without space
            'border' => 'border-orange-400',
            'bg' => 'bg-orange-100',
            'text' => 'text-orange-700',
            'soft_bg' => 'bg-orange-100',
            'button' => 'bg-orange-500 hover:bg-orange-600',
        ],
        'Part Time' => [
            'border' => 'border-green-400',
            'bg' => 'bg-green-100',
            'text' => 'text-green-700',
            'soft_bg' => 'bg-green-100',
            'button' => 'bg-green-500 hover:bg-green-600',
        ],
        'Parttime' => [
            // Alternative without space
            'border' => 'border-green-400',
            'bg' => 'bg-green-100',
            'text' => 'text-green-700',
            'soft_bg' => 'bg-green-100',
            'button' => 'bg-green-500 hover:bg-green-600',
        ],

        'Freelance' => [
            'border' => 'border-purple-400',
            'bg' => 'bg-purple-100',
            'text' => 'text-purple-700',
            'soft_bg' => 'bg-purple-100',
            'button' => 'bg-purple-500 hover:bg-purple-600',
        ],
    ];

    // Normalize the job type (handle both 'Fulltime' and 'Full Time' formats)
    $type = $job['type'];
    if ($type === 'Fulltime') {
        $type = 'Full Time';
    }
    if ($type === 'Parttime') {
        $type = 'Part Time';
    }

    // Get the color scheme, default to Full Time if not found
    $color = $typeColors[$type] ?? $typeColors['Full Time'];
@endphp

<div
    class="transition-transform duration-300 hover:scale-[1.015] hover:shadow-xl border-l-4 rounded-2xl overflow-hidden mb-4 {{ $color['border'] }}">
    {{-- Card Header --}}
    <div class="bg-white shadow-inner px-6 pt-6 pb-4 ring-1 ring-gray-100">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-5">
            <div class="flex items-start gap-4">
                <img src="{{ asset($job['image'] ?? 'images/placeholder.png') }}" alt="Company Logo"
                    class="w-16 h-16 object-cover rounded-xl shadow-sm border border-gray-200 bg-gray-50">

                <div class="space-y-1">
                    <p class="text-xs font-semibold {{ $color['text'] }}">Type: {{ $type }}</p>
                    <h3 class="text-xl font-bold text-gray-800 leading-snug font-poppins">{{ $job['title'] }}</h3>
                    <p class="text-sm text-gray-600">💰 Rp
                        {{ number_format((int) str_replace('.', '', $job['salary'])) }} / Month</p>
                </div>
            </div>

            <div class="text-sm text-gray-500 text-right">
                <p class="mb-1">🕒 {{ $job['posted'] }}</p>
                <div class="flex justify-end flex-wrap gap-2">
                    <span class="{{ $color['bg'] }} {{ $color['text'] }} px-3 py-1 rounded-full text-xs font-medium">
                        {{ $job['work_type'] }}
                    </span>
                    <span class="{{ $color['bg'] }} {{ $color['text'] }} px-3 py-1 rounded-full text-xs font-medium">
                        {{ $job['edu'] }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Card Footer --}}
    <div
        class="{{ $color['soft_bg'] }} px-6 py-4 flex flex-col md:flex-row md:justify-between md:items-center text-sm text-gray-700 border-t">
        <div class="flex items-center gap-2 flex-wrap">
            <span>📍 {{ $job['location'] }}</span>
            <span class="hidden md:inline">|</span>
            <span class="font-semibold">{{ $job['company'] }}</span>
        </div>
        <a href="{{ route('detail_job', ['id' => $job['id']]) }}"
            class="{{ $color['button'] }} text-white px-5 py-2 rounded-full font-semibold text-sm transition duration-200 mt-3 md:mt-0">
            Info Detail
        </a>
    </div>
</div>
