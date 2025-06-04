@extends('layouts.app')

@section('content')
@include('components.navbar')

<div class="w-full bg-gray-50">
    <div class="max-w-none mx-0 p-4 md:px-6 lg:px-8">
        {{-- Back Button --}}
        <div class="max-w-6xl mx-auto mb-4 md:mb-6">
            <a href="{{ url('/jobfairs') }}" class="text-sm text-blue-500 hover:underline inline-block">← Kembali ke daftar jobfair</a>
        </div>

        {{-- Event Header --}}
        <div class="max-w-6xl mx-auto bg-white rounded-lg p-4 md:p-6 mb-4 md:mb-6 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-2 sm:gap-4 mb-3 md:mb-4">
                <h1 class="text-xl md:text-2xl lg:text-3xl font-bold text-gray-900 flex-1">{{ $event->name }}</h1>
                <span class="text-orange-500 font-medium text-sm md:text-base self-start">Penyelenggara</span>
            </div>

            <p class="text-xs md:text-sm text-gray-600 mb-2 md:mb-3">
                {{ \Carbon\Carbon::parse($event->date_start)->format('d F Y') }} - {{ \Carbon\Carbon::parse($event->date_end)->format('d F Y') }}
            </p>

            <div class="text-xs md:text-sm text-gray-700 leading-relaxed 
                    {{ strlen($event->description ?? '') > 300 ? 'text-justify' : '' }}">
                {{ $event->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed massa massa, gravida ac porta cursus, vestibulum vel eros. Nunc pulvinar felis tempor orci interdum, vel tempus tortor dictum. Nunc sed leo augue. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris posuere odio non velit facilisis, a porttitor est placerat.' }}
            </div>
        </div>

        {{-- Companies Section --}}
        <div class="max-w-6xl mx-auto bg-white rounded-lg p-4 md:p-6 shadow-sm mb-8 md:mb-12">
            <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-4 md:mb-6">List Company</h2>

            @if ($companies->isEmpty())
            <p class="text-gray-600 text-sm md:text-base text-center py-8">Belum ada perusahaan yang terdaftar.</p>
            @else
            <div class="space-y-3 md:space-y-4">
                @foreach($companies as $company)
                <div class="border-l-4 border-orange-400 bg-orange-50 rounded-r-lg hover:bg-orange-100 transition-colors duration-200">
                    <a href="{{ url("/jobfairs/{$event->slug}/companies/{$company->slug}") }}" class="block p-3 md:p-4">
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-center space-x-2 md:space-x-3 flex-1 min-w-0">
                                {{-- Company Icon --}}
                                <div class="w-8 h-8 md:w-10 md:h-10 bg-orange-200 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-6a1 1 0 00-1-1H9a1 1 0 00-1 1v6a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>

                                {{-- Company Info --}}
                                <div class="min-w-0 flex-1">
                                    <h3 class="font-semibold text-gray-900 text-sm md:text-base truncate">{{ $company->name }}</h3>
                                    <div class="flex items-center text-xs md:text-sm text-gray-500 mt-1">
                                        <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="truncate">{{ $company->location ?? 'Jakarta' }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Registration Info --}}
                            <div class="text-right flex-shrink-0">
                                <div class="text-xs text-gray-500 mb-1 hidden sm:block">Last Registered: 1 year ago</div>
                                <span class="inline-block bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded max-w-20 md:max-w-none truncate">
                                    {{ $company->industry ?? 'Technology' }}
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>

@include('components.footer')
@endsection