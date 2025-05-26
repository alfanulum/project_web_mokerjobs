@extends('layouts.app')

@section('content')
    @include('components.navbar')

    <!-- Homepage -->
    <section class="bg-white py-16 px-6 mb-20">
        <div class="relative z-10 max-w-6xl mx-auto mb-20">
            <div class="grid md:grid-cols-2 gap-8 items-center md:items-start">
                <!-- Kolom Kiri: Teks & Form -->
                <div class="relative z-[50]" data-aos="fade-right">
                    <p class="uppercase text-sm text-gray-500 mb-2 tracking-widest font-poppins">Cari lowongan kerja terbaik
                    </p>
                    <h1 class="text-3xl md:text-6xl font-bold leading-snug font-poppins">
                        Cari <span
                            class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">Pekerjaan
                            Impian</span> Anda di Mojokerto.
                    </h1>

                    <!-- Form Input -->
                    <form id="search-form" action="{{ route('overview') }}#jobs" method="GET"
                        class="flex flex-col gap-4 mt-6">
                        @include('components.search')
                        <div class="flex flex-col md:flex-row gap-4">
                            @include('components.dropdown_location')
                            @include('components.dropdown_category')
                        </div>
                        <button type="submit"
                            class="mt-6 bg-orange-500 hover:bg-orange-600 text-white font-semibold px-10 py-3 rounded-full shadow-md w-full md:w-fit">
                            Cari
                        </button>
                    </form>
                </div>

                <!-- Kolom Kanan: Gambar -->
                <div class="relative z-0 flex justify-center items-center md:h-full h-64" data-aos="fade-left">
                    <img src="{{ asset('images/women.png') }}" alt="Gambar Utama"
                        class="w-full max-w-xs sm:max-w-md md:max-w-lg lg:max-w-xl object-contain md:object-cover rounded-xl" />
                </div>
            </div>

            <!-- Employer & Candidate Cards -->
            <div class="grid md:grid-cols-2 gap-x-6 gap-y-6 max-w-6xl mx-auto mt-30">
                <div class="bg-yellow-100 rounded-2xl px-6 py-8 flex items-center gap-6 shadow-lg min-h-[220px]"
                    data-aos="zoom-in">
                    <img src="{{ asset('images/employer.png') }}" alt="Gambar Perusahaan"
                        class="w-24 h-24 md:w-32 md:h-32 object-contain">
                    <div>
                        <h3 class="font-bold text-xl text-black mb-2">Untuk Perusahaan</h3>
                        <p class="text-base text-gray-700 mb-4">Temukan kandidat profesional dari berbagai bidang dan
                            keterampilan</p>
                        <a href="{{ route('post_job') }}"
                            class="inline-block bg-orange-500 hover:bg-orange-600 text-white py-2 px-6 rounded-full text-base font-bold">Pasang
                            Lowongan</a>
                    </div>
                </div>

                <div class="bg-yellow-100 rounded-2xl px-6 py-8 flex items-center gap-6 shadow-lg min-h-[220px]"
                    data-aos="zoom-in" data-aos-delay="200">
                    <img src="{{ asset('images/candidate.png') }}" alt="Gambar Pelamar"
                        class="w-24 h-24 md:w-32 md:h-32 object-contain">
                    <div>
                        <h3 class="font-bold text-xl text-black mb-2">Untuk Pelamar</h3>
                        <p class="text-base text-gray-700 mb-4">Buat profil profesional dan temukan peluang kerja terbaik
                        </p>
                        <a href="{{ route('find_job') }}"
                            class="inline-block bg-orange-500 hover:bg-orange-600 text-white py-2 px-6 rounded-full text-base font-bold">Cari
                            Lowongan</a>
                    </div>
                </div>
            </div>
    </section>

    <!-- Jobs Section -->
    <section id="jobs" class="px-4 sm:px-6 py-16 bg-gradient-to-b from-[#fdf8f3] to-[#f7eee7]">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10"
                data-aos="fade-up">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 leading-snug">Lowongan Terbaru</h2>
                    <p class="text-base text-gray-600 mt-2">Temukan pekerjaan yang direkomendasikan untuk Anda</p>
                </div>
                <a href="{{ route('find_job') }}"
                    class="inline-flex items-center gap-2 bg-yellow-400 hover:bg-yellow-500 text-black font-medium px-6 py-3 rounded-full shadow-md transition-all duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                    Lihat Semua Lowongan
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @include('components.categories_job')

                <div class="col-span-2 flex flex-col min-h-[700px] gap-6" data-aos="fade-left">
                    <div class="flex flex-col gap-6 flex-1">
                        @forelse($jobs as $job)
                            @include('components.card_job', ['job' => $job])
                        @empty
                            <p class="text-center text-gray-500">Tidak ada lowongan ditemukan.</p>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-auto">
                        @include('components.pagination', ['paginator' => $jobs])
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feedback Section -->
    <section class="px-6 py-24 bg-[#f8f8f8]">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-start justify-between gap-12">
            <div class="w-full md:w-1/2">
                <h2 class="text-orange-500 text-3xl md:text-4xl font-bold mb-4">Feedback dan Saran</h2>
                <p class="text-gray-600 mb-6">Beritahu kami pendapat Anda! Kami siap mendengarkan dan menjadikan website ini
                    lebih baik bagi Anda.</p>

                @if (session('success'))
                    <div class="mb-4 text-green-600 font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('feedback.submit') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="flex flex-col md:flex-row gap-4">
                        <input type="text" name="name" placeholder="Nama" required
                            class="w-full md:w-1/2 p-3 border-2 border-orange-400 rounded-full bg-white focus:outline-none text-sm">
                        <input type="email" name="email" placeholder="E-mail" required
                            class="w-full md:w-1/2 p-3 border-2 border-orange-400 rounded-full bg-white focus:outline-none text-sm">
                    </div>
                    <textarea name="message" rows="6" placeholder="Tuliskan feedback dan saran Anda di sini." required
                        class="w-full p-3 border-2 border-orange-400 rounded-xl bg-white focus:outline-none text-sm"></textarea>
                    <button type="submit"
                        class="mt-6 w-full bg-orange-500 text-white py-3 rounded-full hover:bg-orange-600 transition">
                        Kirim
                    </button>
                </form>
            </div>

            <div class="w-full md:w-1/2 flex justify-center items-center">
                <img src="{{ asset('images/feedbackicon.png') }}" alt="Ilustrasi"
                    class="w-full max-w-[300px] md:max-w-[440px]">
            </div>
        </div>
    </section>

    @include('components.footer')

    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (window.location.hash === '#jobs') {
                    setTimeout(() => {
                        const jobsSection = document.getElementById('jobs');
                        if (jobsSection) {
                            jobsSection.scrollIntoView({
                                behavior: 'smooth'
                            });
                        }
                    }, 100);
                }
            });
        </script>
    @endsection
@endsection
