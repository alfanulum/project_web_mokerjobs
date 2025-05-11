<!-- Bottom Section -->
<section class="bg-white py-12 px-6">
  <div class="grid md:grid-cols-2 gap-6 max-w-6xl mx-auto">

    <!-- Card: Untuk Perusahaan -->
    <div class="bg-yellow-100 rounded-2xl p-6 md:p-10 flex flex-col md:flex-row items-center gap-6 shadow-lg" data-aos="zoom-in">
      <div class="flex-1">
        <h3 class="font-bold text-xl text-black mb-2">Untuk Perusahaan</h3>
        <p class="text-base text-gray-700 mb-4">Temukan pekerja profesional dari seluruh dunia dan di semua keterampilan</p>
        <a href="{{ route('post_job') }}"
          class="block w-40 bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-full text-base font-bold text-center">
          Pasang Loker
        </a>
      </div>
      <img src="{{ asset('images/employer.png') }}" alt="Employer Image" class="w-32 h-32 md:w-40 md:h-40 object-contain">
    </div>

    <!-- Card: Untuk Pelamar -->
    <div class="bg-yellow-100 rounded-2xl p-6 md:p-10 flex flex-col md:flex-row items-center gap-6 shadow-lg" data-aos="zoom-in" data-aos-delay="200">
      <div class="flex-1">
        <h3 class="font-bold text-xl text-black mb-2">Untuk Pelamar</h3>
        <p class="text-base text-gray-700 mb-4">Bangun profil profesional Anda, temukan peluang kerja baru</p>
        <a href="{{ route('find_job') }}"
          class="block w-40 bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-full text-base font-bold text-center">
          Cari Loker
        </a>
      </div>
      <img src="{{ asset('images/candidate.png') }}" alt="Candidate Image" class="w-32 h-32 md:w-40 md:h-40 object-contain">
    </div>

  </div>
</section>