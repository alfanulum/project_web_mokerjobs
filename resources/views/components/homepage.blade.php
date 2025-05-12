<!-- Homepage + Card Section -->
<section class="bg-white py-16 px-6 mb-12">
  <!-- Hero Section -->
  <div class="relative z-10 max-w-6xl mx-auto mb-30">
    <div class="grid md:grid-cols-2 gap-8 items-center relative">
      <!-- Left: Text Content -->
      <div class="relative z-[50]" data-aos="fade-right">
        <p class="uppercase text-sm text-gray-500 mb-2 tracking-widest">Cari Lowongan kerja terbaik</p>
        <h1 class="text-6xl font-bold leading-snug">
          Cari <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">Pekerjaan Impian</span> Anda di Mojokerto.
        </h1>
        <!-- Form Input -->
        <div class="flex flex-col gap-4 mt-6">
          @include('components.search')
          <div class="flex flex-col md:flex-row gap-4">
            @include('components.location')
            @include('components.categories_dropdown')
          </div>
        </div>
        <button class="mt-6 bg-orange-500 hover:bg-orange-600 text-white font-semibold px-10 py-3 rounded-full shadow-md w-fit">
          Search
        </button>
      </div>

      <!-- Right: Hero Image -->
      <div class="relative z-0 flex justify-center" data-aos="fade-left">
        <img src="{{ asset('images/women.png') }}" alt="Hero Image" class="rounded-xl max-h-[500px] object-contain" />
      </div>
    </div>
  </div>


  <!-- Company & Applicant Cards -->
  <div class="grid md:grid-cols-2 gap-x-6 max-w-6xl mx-auto mt-12">
    <!-- Card: Untuk Perusahaan -->
    <div class="bg-yellow-100 rounded-2xl px-6 py-8 flex items-center gap-6 shadow-lg min-h-[220px]" data-aos="zoom-in">
      <img src="{{ asset('images/employer.png') }}" alt="Employer Image" class="w-24 h-24 md:w-32 md:h-32 object-contain">
      <div>
        <h3 class="font-bold text-xl text-black mb-2">Untuk Perusahaan</h3>
        <p class="text-base text-gray-700 mb-4">Temukan pekerja profesional dari seluruh dunia dan di semua keterampilan</p>
        <a href="{{ route('post_job') }}"
          class="inline-block bg-orange-500 hover:bg-orange-600 text-white py-2 px-6 rounded-full text-base font-bold">
          Pasang Loker
        </a>
      </div>
    </div>

    <!-- Card: Untuk Pelamar -->
    <div class="bg-yellow-100 rounded-2xl px-6 py-8 flex items-center gap-6 shadow-lg min-h-[220px]" data-aos="zoom-in" data-aos-delay="200">
      <img src="{{ asset('images/candidate.png') }}" alt="Candidate Image" class="w-24 h-24 md:w-32 md:h-32 object-contain">
      <div>
        <h3 class="font-bold text-xl text-black mb-2">Untuk Pelamar</h3>
        <p class="text-base text-gray-700 mb-4">Bangun profil profesional Anda, temukan peluang kerja baru</p>
        <a href="{{ route('find_job') }}"
          class="inline-block bg-orange-500 hover:bg-orange-600 text-white py-2 px-6 rounded-full text-base font-bold">
          Cari Loker
        </a>
      </div>
    </div>
  </div>
</section>