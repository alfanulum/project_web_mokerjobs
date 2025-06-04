@extends('layouts.app')

@section('content')
@include('components.navbar')

{{-- Header & Bagian Pencarian --}}
<section class="relative bg-[#fdfdfd] py-18 px-4 pb-24 overflow-visible">

    {{-- Dekorasi Lingkaran Besar --}}
    <div
        class="absolute -right-20 top-15 w-[450px] h-[225px] rounded-t-full border-[60px] border-b-0 border-gray-200 opacity-30 z-0">
    </div>

    {{-- Judul dan Garis Putus-Putus --}}
    <div class="relative z-10 max-w-5xl mx-auto mb-10 px-4">
        <div class="flex flex-col md:flex-row items-center md:items-end justify-start gap-4">
            {{-- Judul dengan underline tipis biru --}}
            <h1
                class="text-2xl md:text-3xl font-bold text-gray-900 relative after:content-[''] after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-full font-poppins">
                JOB
                <span class="bg-gradient-to-r from-orange-400 to-yellow-400 bg-clip-text text-transparent">
                    FAIR</span>
                <span class="text-black"> Anda di Sini </span>
            </h1>

            {{-- Garis putus-putus oranye tebal dan besar --}}
            <div class="hidden md:flex flex-1 items-center gap-[6px]">
                <div class="w-3 h-2 bg-orange-400 rounded-l-md"></div> {{-- Ujung kiri melengkung --}}
                @for ($i = 0; $i < 12; $i++)
                    <div class="w-5 h-2 bg-orange-400">
            </div>
            @endfor
        </div>
    </div>
    </div>

    {{-- Event List --}}
    <div class="relative z-10 max-w-5xl mx-auto px-4">
        @if ($events->isEmpty())
        <p class="text-gray-600">Belum ada event jobfair yang tersedia.</p>
        @else
        <ul class="space-y-4 mb-16">
            @foreach($events as $event)
            <li>
                <a href="{{ url('/jobfairs/' . $event->slug) }}"
                    class="flex justify-between items-start p-6 rounded-lg shadow bg-orange-500 text-white hover:bg-orange-600 transition duration-200">
                    <div class="flex-1">
                        <h2 class="text-xl font-bold mb-1">{{ $event->name }}</h2>
                        <p class="text-sm mb-2">{{ \Carbon\Carbon::parse($event->date_start)->format('d F Y') }} - {{ \Carbon\Carbon::parse($event->date_end)->format('d F Y') }}</p>
                        <p class="text-sm leading-snug text-white/90">
                            {{ Str::limit($event->description ?? 'Deskripsi belum tersedia.', 150) }}
                        </p>
                    </div>
                    <div class="ml-6 whitespace-nowrap text-sm font-medium">
                        Penyelenggara
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
        @endif
    </div>
</section>

@include('components.footer')
@endsection