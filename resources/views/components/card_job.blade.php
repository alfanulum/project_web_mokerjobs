@php
$typeColors = [
'Full Time' => ['border' => 'border-orange-400', 'bg' => 'bg-orange-100', 'text' => 'text-orange-700'],
'Part Time' => ['border' => 'border-rose-400', 'bg' => 'bg-rose-100', 'text' => 'text-rose-700'],
'Freelance' => ['border' => 'border-yellow-400', 'bg' => 'bg-yellow-100', 'text' => 'text-yellow-700'],
];
$type = $job['type'] ?? 'Full Time';
$color = $typeColors[$type] ?? ['border' => 'border-gray-300', 'bg' => 'bg-gray-100', 'text' => 'text-gray-700'];
@endphp

<div class="transition-transform duration-300 hover:scale-[1.015] hover:shadow-xl border-l-4 rounded-2xl overflow-hidden {{ $color['border'] }}">
    <div class="bg-white shadow-inner p-6 rounded-2xl relative ring-1 ring-gray-100">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-5">
            <div class="flex items-start gap-4">
                <img src="{{ asset($job['image'] ?? 'images/placeholder.png') }}" alt="Logo Perusahaan"
                    class="w-16 h-16 object-cover rounded-xl shadow-sm border border-gray-200 bg-gray-50">

                <div class="space-y-1">
                    <p class="text-xs font-semibold {{ $color['text'] }}">Tipe: {{ $type }}</p>
                    <h3 class="text-xl font-bold text-gray-800 leading-snug">{{ $job['title'] }}</h3>
                    <p class="text-sm text-gray-600">💰 Rp {{ number_format((int) str_replace('.', '', $job['salary'])) }} / Bulan</p>
                </div>
            </div>

            <div class="text-sm text-gray-500 text-right">
                <p class="mb-1">🕒 {{ $job['posted'] }}</p>
                <div class="flex justify-end flex-wrap gap-2">
                    <span class="{{ $color['bg'] }} {{ $color['text'] }} px-3 py-1 rounded-full text-xs font-medium">
                        {{ $job['work_type'] }}
                    </span>
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">
                        {{ $job['edu'] }}
                    </span>
                </div>
            </div>
        </div>

        <div class="mt-5 flex flex-col md:flex-row md:justify-between md:items-center gap-2 pt-4 border-t text-sm text-gray-700">
            <div class="flex items-center gap-2">
                <span>📍 {{ $job['location'] }}</span>
                <span class="hidden md:inline">|</span>
                <span class="font-semibold">{{ $job['company'] }}</span>
            </div>
            <a href="{{ $job['apply_url'] }}"
                class="bg-yellow-400 hover:bg-yellow-500 text-white px-5 py-2 rounded-full font-semibold text-sm transition duration-200">
                {{ $job['apply_label'] ?? 'Lamar Sekarang' }}
            </a>
        </div>
    </div>
</div>