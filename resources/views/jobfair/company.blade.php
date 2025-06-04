@extends('layouts.app')

@section('content')
@include('components.navbar')

<div class="w-full bg-gray-50">
    <div class="max-w-none mx-0 p-4 md:px-6 lg:px-8">
        {{-- Back Button --}}
        <div class="max-w-6xl mx-auto mb-4 md:mb-6">
            <a href="{{ url("/jobfairs/{$event->slug}") }}" class="text-sm text-blue-500 hover:underline inline-block">← Kembali ke {{ $event->name }}</a>
        </div>

        {{-- Company Header --}}
        <div class="max-w-6xl mx-auto bg-white rounded-lg p-4 md:p-6 mb-4 md:mb-6 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-2 sm:gap-4 mb-3 md:mb-4">
                <h1 class="text-xl md:text-2xl lg:text-3xl font-bold text-gray-900 flex-1">{{ $company->name }}</h1>
                <span class="text-orange-500 font-medium text-sm md:text-base self-start">Perusahaan</span>
            </div>

            @if($company->industry || $company->location)
            <div class="flex flex-wrap gap-4 mb-3 md:mb-4">
                @if($company->industry)
                <div class="flex items-center text-xs md:text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-6a1 1 0 00-1-1H9a1 1 0 00-1 1v6a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"></path>
                    </svg>
                    <span>{{ $company->industry }}</span>
                </div>
                @endif

                @if($company->location)
                <div class="flex items-center text-xs md:text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                    </svg>
                    <span>{{ $company->location }}</span>
                </div>
                @endif
            </div>
            @endif

            @if($company->description)
            <div class="text-xs md:text-sm text-gray-700 leading-relaxed 
                    {{ strlen($company->description ?? '') > 300 ? 'text-justify' : '' }}">
                {{ $company->description }}
            </div>
            @endif
        </div>

        {{-- Jobs Section --}}
        <div class="max-w-6xl mx-auto bg-white rounded-lg p-4 md:p-6 shadow-sm mb-8 md:mb-12">
            <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-4 md:mb-6">Lowongan Tersedia</h2>

            @forelse($jobs as $job)
            <div class="border-l-4 border-orange-400 bg-orange-50 rounded-r-lg hover:bg-orange-100 transition-colors duration-200 mb-3 md:mb-4 last:mb-0">
                <a href="{{ route('job.show', [
                    'event' => $event->slug,
                    'company' => $company->slug,
                    'job' => $job->id,
                ]) }}" class="block p-3 md:p-4">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2 md:space-x-3 flex-1 min-w-0">
                            {{-- Job Icon --}}
                            <div class="w-8 h-8 md:w-10 md:h-10 bg-orange-200 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zM4 8v8h12V8H4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>

                            {{-- Job Info --}}
                            <div class="min-w-0 flex-1">
                                <h3 class="font-semibold text-gray-900 text-sm md:text-base truncate">{{ $job->title }}</h3>
                                @if($job->salary || $job->type)
                                <div class="flex items-center gap-3 text-xs md:text-sm text-gray-500 mt-1">
                                    @if($job->salary)
                                    <div class="flex items-center">
                                        <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.340.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.340-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="truncate">{{ $job->salary ?? 'Gaji tidak disebutkan' }}</span>
                                    </div>
                                    @endif

                                    @if($job->type)
                                    <div class="flex items-center">
                                        <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="truncate">{{ $job->type }}</span>
                                    </div>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>

                        {{-- Job Status --}}
                        <div class="text-right flex-shrink-0">
                            <div class="text-xs text-gray-500 mb-1 hidden sm:block">Tersedia</div>
                            <span class="inline-block bg-green-200 text-green-700 text-xs px-2 py-1 rounded">
                                Aktif
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="text-center py-8">
                <div class="w-16 h-16 mx-auto mb-4 bg-gray-200 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zM4 8v8h12V8H4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <p class="text-gray-600 text-sm md:text-base">Tidak ada lowongan tersedia saat ini.</p>
                <p class="text-gray-500 text-xs md:text-sm mt-1">Silakan periksa kembali nanti untuk lowongan terbaru.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

@include('components.footer')
@endsection