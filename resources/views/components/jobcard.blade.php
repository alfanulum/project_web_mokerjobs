@props(['job', 'index' => 0])

@php
$border = $job['border'] ?? 'border-gray-200';
$ring = $job['ring'] ?? '';
@endphp

<div class="border-l-8 {{ $border }} bg-white p-5 rounded-2xl shadow-md {{ $ring ? 'ring-2 '.$ring : '' }}" data-aos="zoom-in-up" data-aos-delay="{{ $index * 150 }}" data-aos-duration="700">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
        <div>
            <p class="text-xs font-medium text-gray-500">Tipe: {{ $job['type'] }}</p>
            <h3 class="text-xl font-bold text-gray-800">Title Job #{{ $index + 1 }}</h3>
            <p class="text-sm text-gray-500">Rp 000.000.000.000/Bulan</p>
        </div>
        <div class="text-right text-sm text-gray-500">
            <p>Terakhir Upload: 1 bulan lalu</p>
            <div class="mt-1 flex justify-end gap-2">
                <span class="bg-gray-100 text-gray-600 rounded-full px-3 py-0.5 text-xs">On-site</span>
                <span class="bg-gray-100 text-gray-600 rounded-full px-3 py-0.5 text-xs">{{ $job['edu'] }}</span>
            </div>
        </div>
    </div>
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mt-4 text-sm text-gray-600 gap-2">
        <div class="flex items-center gap-2">
            <span>📍 Jetis</span>
            <span>|</span>
            <span>Jetis Company</span>
        </div>
        <a href="#" class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-xl text-sm font-medium">Daftar</a>
    </div>
</div>