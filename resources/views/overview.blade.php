@extends('layouts.app')

@section('content')

<!-- Homepage -->
<section class="bg-white py-16 px-6 mb-20">
  <div class="relative z-10 max-w-6xl mx-auto mb-20">
    <div class="grid md:grid-cols-2 gap-8 items-center md:items-start">
      <!-- Kolom Kiri: Teks & Form -->
      <div class="relative z-[50]" data-aos="fade-right">
        <p class="uppercase text-sm text-gray-500 mb-2 tracking-widest">Cari Lowongan kerja terbaik</p>
        <h1 class="text-3xl md:text-6xl font-bold leading-snug">
          Cari <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">Pekerjaan Impian</span> Anda di Mojokerto.
        </h1>

        <!-- Form Input -->
        <div class="flex flex-col gap-4 mt-6">
          @include('components.search')
          <div class="flex flex-col md:flex-row gap-4">
            @include('components.dropdown_location')
            @include('components.dropdown_category')
          </div>
        </div>

        <!-- Tombol search -->
        <button class="mt-6 bg-orange-500 hover:bg-orange-600 text-white font-semibold px-10 py-3 rounded-full shadow-md w-full md:w-fit">
          Search
        </button>
      </div>

      <!-- Kolom Kanan: Gambar -->
      <div class="relative z-0 flex justify-center items-center md:h-full h-64" data-aos="fade-left">
        <img
          src="{{ asset('images/women.png') }}"
          alt="Hero Image"
          class="w-full max-w-xs sm:max-w-md md:max-w-lg lg:max-w-xl object-contain md:object-cover rounded-xl" />
      </div>
    </div>
  </div>

  <!-- Employer & Candidate Cards -->
  <div class="grid md:grid-cols-2 gap-x-6 gap-y-6 max-w-6xl mx-auto mt-12">
    <div class="bg-yellow-100 rounded-2xl px-6 py-8 flex items-center gap-6 shadow-lg min-h-[220px]" data-aos="zoom-in">
      <img src="{{ asset('images/employer.png') }}" alt="Employer Image" class="w-24 h-24 md:w-32 md:h-32 object-contain">
      <div>
        <h3 class="font-bold text-xl text-black mb-2">Untuk Perusahaan</h3>
        <p class="text-base text-gray-700 mb-4">Temukan pekerja profesional dari seluruh dunia dan di semua keterampilan</p>
        <a href="{{ route('post_job') }}" class="inline-block bg-orange-500 hover:bg-orange-600 text-white py-2 px-6 rounded-full text-base font-bold">Pasang Loker</a>
      </div>
    </div>

    <div class="bg-yellow-100 rounded-2xl px-6 py-8 flex items-center gap-6 shadow-lg min-h-[220px]" data-aos="zoom-in" data-aos-delay="200">
      <img src="{{ asset('images/candidate.png') }}" alt="Candidate Image" class="w-24 h-24 md:w-32 md:h-32 object-contain">
      <div>
        <h3 class="font-bold text-xl text-black mb-2">Untuk Pelamar</h3>
        <p class="text-base text-gray-700 mb-4">Bangun profil profesional Anda, temukan peluang kerja baru</p>
        <a href="{{ route('find_job') }}" class="inline-block bg-orange-500 hover:bg-orange-600 text-white py-2 px-6 rounded-full text-base font-bold">Cari Loker</a>
      </div>
    </div>
  </div>
</section>


<!-- Jobs Section -->
<section id="jobs" class="px-4 sm:px-6 py-12 bg-[#f7eee7]">
  <div class="max-w-6xl mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 mt-8" data-aos="fade-up" data-aos-duration="700">
      <div>
        <h2 class="text-2xl font-bold text-gray-800">Loker Terbaru</h2>
        <p class="text-sm text-gray-600">Temukan lowongan pekerjaan yang disarankan</p>
      </div>
      <a href="#" class="mt-4 md:mt-0 bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-2 rounded-full">Selengkapnya</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      @include('components.categories_job')

      <div class="col-span-2 flex flex-col min-h-[700px] gap-6" data-aos="fade-left" data-aos-duration="700">
        <div class="flex flex-col gap-6 flex-1">
          @foreach($jobs as $job)
          @include('components.card_job', ['job' => $job])
          @endforeach
        </div>

        <!-- Pagination dengan desain custom -->
        <div class="mt-auto">
          <div class="flex justify-center items-center mt-8 gap-6">
            {{-- Tombol Sebelumnya --}}
            <a href="{{ $jobs->previousPageUrl() ? $jobs->previousPageUrl() . '#jobs' : '#' }}"
              class="flex items-center gap-2 px-4 py-2 rounded-full border border-gray-300 shadow-sm hover:shadow-md bg-white text-gray-700 font-medium transition-all duration-200 {{ $jobs->onFirstPage() ? 'opacity-40 cursor-not-allowed pointer-events-none' : '' }}">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
              </svg>
              <span>Sebelumnya</span>
            </a>

            {{-- Info Halaman --}}
            <span class="text-sm text-gray-600">Halaman {{ $jobs->currentPage() }} / {{ $jobs->lastPage() }}</span>

            {{-- Tombol Selanjutnya --}}
            <a href="{{ $jobs->nextPageUrl() ? $jobs->nextPageUrl() . '#jobs' : '#' }}"
              class="flex items-center gap-2 px-4 py-2 rounded-full border border-gray-300 shadow-sm hover:shadow-md bg-white text-gray-700 font-medium transition-all duration-200 {{ $jobs->hasMorePages() ? '' : 'opacity-40 cursor-not-allowed pointer-events-none' }}">
              <span>Selanjutnya</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </a>
          </div>
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
      <p class="text-gray-600 mb-6">Beritahu kami pendapat Anda! Kami siap mendengarkan dan menjadikan website ini lebih baik bagi Anda.</p>

      @if(session('success'))
      <div class="mb-4 text-green-600 font-semibold">
        {{ session('success') }}
      </div>
      @endif

      <form action="{{ route('feedback.submit') }}" method="POST" class="space-y-4">
        @csrf
        <div class="flex flex-col md:flex-row gap-4">
          <input type="text" name="name" placeholder="Nama" required class="w-full md:w-1/2 p-3 border-2 border-orange-400 rounded-full bg-white focus:outline-none text-sm">
          <input type="email" name="email" placeholder="E-mail" required class="w-full md:w-1/2 p-3 border-2 border-orange-400 rounded-full bg-white focus:outline-none text-sm">
        </div>
        <textarea name="message" rows="6" placeholder="Tuliskan feedback dan saran anda disini." required class="w-full p-3 border-2 border-orange-400 rounded-xl bg-white focus:outline-none text-sm"></textarea>
        <button type="submit" class="mt-6 w-full bg-orange-500 text-white py-3 rounded-full hover:bg-orange-600 transition">
          Kirim
        </button>
      </form>
    </div>

    <div class="w-full md:w-1/2 flex justify-center items-center">
      <img src="{{ asset('images/feedbackicon.png') }}" alt="Illustration" class="w-full max-w-[300px] md:max-w-[440px]">
    </div>
  </div>
</section>


@include('components.footer')

@endsection