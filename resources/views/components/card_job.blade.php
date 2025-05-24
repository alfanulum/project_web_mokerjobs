<!-- In your job card component (file-card-job.blade.php) -->
@props(['job'])

@php
    $typeColors = [
        'Full Time' => [
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
        'Internship' => [
            'border' => 'border-red-400',
            'bg' => 'bg-red-100',
            'text' => 'text-red-700',
            'soft_bg' => 'bg-red-100',
            'button' => 'bg-red-500 hover:bg-red-600',
        ],
        'Freelance' => [
            'border' => 'border-purple-400',
            'bg' => 'bg-purple-100',
            'text' => 'text-purple-700',
            'soft_bg' => 'bg-purple-100',
            'button' => 'bg-purple-500 hover:bg-purple-600',
        ],
    ];

    $type = $job['type'] ?? 'Full Time';
    $color = $typeColors[$type] ?? $typeColors['Full Time'];
@endphp

<div
    class="transition-transform duration-300 hover:scale-[1.015] hover:shadow-xl border-l-4 rounded-2xl overflow-hidden mb-4 {{ $color['border'] }}">
    {{-- Atas Card --}}
    <div class="bg-white shadow-inner px-6 pt-6 pb-4 ring-1 ring-gray-100">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-5">
            <div class="flex items-start gap-4">
                <img src="{{ asset($job['image'] ?? 'images/placeholder.png') }}" alt="Logo Perusahaan"
                    class="w-16 h-16 object-cover rounded-xl shadow-sm border border-gray-200 bg-gray-50">

                <div class="space-y-1">
                    <p class="text-xs font-semibold {{ $color['text'] }}">Tipe: {{ $type }}</p>
                    <h3 class="text-xl font-bold text-gray-800 leading-snug">{{ $job['title'] }}</h3>
                    <p class="text-sm text-gray-600">💰 Rp
                        {{ number_format((int) str_replace('.', '', $job['salary'])) }} / Bulan</p>
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

    {{-- Bawah Card --}}
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


<!-- Apply Now Modal -->
<div x-cloak x-show="showApplyModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
    role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="showApplyModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div x-show="showApplyModal" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <div>
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                    <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-5">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        Apply for {{ $job['title'] }}
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            Contact the company directly using one of these methods:
                        </p>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-6 space-y-4">
                <a href="mailto:{{ $job['email'] }}"
                    class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                    Email: {{ $job['email'] }}
                </a>
                <a href="https://wa.me/{{ $job['whatsapp'] }}"
                    class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd" />
                    </svg>
                    WhatsApp: {{ $job['whatsapp'] }}
                </a>
            </div>
            <div class="mt-5 sm:mt-6">
                <button @click="showApplyModal = false" type="button"
                    class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
