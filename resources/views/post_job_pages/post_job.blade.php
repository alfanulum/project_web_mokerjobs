@extends('layouts.app')

@section('title', 'Pasang Lowongan Pekerjaan')

@section('content')
    @include('components.navbar')

    <section class="bg-gray-50 min-h-screen px-4 md:px-10 py-16 flex items-center justify-center">
        <div class="max-w-7xl w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

            <!-- Konten Kiri -->
            <div class="space-y-6">
                <h1 class="text-5xl md:text-5x2 font-bold leading-tight text-black">
                    <span class="text-black">Pasang Lowongan Pekerjaan</span> <br>
                    <span class="bg-gradient-to-r from-orange-400 to-yellow-400 bg-clip-text text-transparent">Dengan
                        Cepat</span>
                    <span class="text-black"> dan </span>
                    <span class="bg-gradient-to-r from-orange-400 to-yellow-400 bg-clip-text text-transparent">Mudah</span>
                </h1>


                <p class="text-gray-700 text-lg leading-relaxed">
                    Terhubung dengan puluhan ribu talenta di Mojokerto melalui platform kerja modern dan mudah digunakan
                    yang mempercepat proses perekrutan dan pencarian kerja.
                </p>

                <a href="{{ route('form_postjob_step1') }}"
                    class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold px-8 py-3 rounded-full text-lg shadow transition-transform duration-200 hover:scale-105">
                    Pasang Loker
                </a>
            </div>

            <!-- Gambar Kanan -->
            <div class="flex justify-center">
                <img src="{{ asset('images/iconpostjob.png') }}" alt="Ilustrasi Pasang Lowongan"
                    class="max-w-md w-full h-auto">
            </div>

        </div>
    </section>
@endsection
