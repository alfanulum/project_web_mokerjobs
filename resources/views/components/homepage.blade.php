<!-- Hero Section -->
<section class="px-6 py-12 grid md:grid-cols-2 gap-8 items-center bg-white">
    <!-- Left: Text Content -->
    <div data-aos="fade-right">
        <p class="uppercase text-sm text-gray-500 mb-2 tracking-widest">Cari Lowongan kerja terbaik</p>
        <h1 class="text-6xl font-bold leading-snug">
            Cari <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">Pekerjaan Impian</span> Anda di Mojokerto.
        </h1>
        <!-- Form Input -->
        <div class="flex flex-col gap-4 mt-6">
            <!-- Search Component -->
            @include('components.search')
            <div class="flex flex-col md:flex-row gap-4">
                <!-- Location Dropdown -->
                @include('components.location')
                <!-- Category Input -->
                <div class="relative w-full md:w-1/2">
                    <img src="{{ asset('images/iconkategori.png') }}" class="absolute left-4 top-2.5 w-5 h-5" alt="Category Icon">
                    <input type="text" placeholder="Kategori"
                        class="pl-12 py-2 border border-orange-500 rounded-full w-full focus:outline-none focus:ring-2 focus:ring-orange-300" />
                </div>
            </div>
        </div>

        <!-- Button -->
        <button class="mt-6 bg-orange-500 hover:bg-orange-600 text-white font-semibold px-10 py-3 rounded-full shadow-md w-fit">
            Search
        </button>
    </div>

    <!-- Right: Hero Image -->
    <div class="flex justify-center" data-aos="fade-left">
        <img src="{{ asset('images/women.png') }}" alt="Hero Image" class="rounded-xl max-h-[500px] object-contain" />
    </div>
</section>

<!-- Bottom Section -->
<section class="bg-white py-12 px-6">
    <div class="grid md:grid-cols-2 gap-6 max-w-6xl mx-auto">
        <!-- Card: For Employers -->
        <div class="bg-yellow-100 rounded-2xl p-8 flex items-center gap-8 shadow-md" data-aos="zoom-in">
            <div>
                <h3 class="font-bold text-lg text-black mb-1">Untuk Perusahaan</h3>
                <p class="text-sm text-gray-700 mb-3">Temukan pekerja profesional dari seluruh dunia dan di semua keterampilan</p>
                <a href="{{ route('post_job') }}" class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-full text-sm font-bold">Pasang Loker</a>
            </div>
            <img src="{{ asset('images/employer.png') }}" alt="Employer Image" class="w-32 h-32 object-contain">
        </div>

        <!-- Card: For Candidate -->
        <div class="bg-yellow-100 rounded-2xl p-8 flex items-center gap-8 shadow-md" data-aos="zoom-in" data-aos-delay="200">
            <div>
                <h3 class="font-bold text-lg text-black mb-1">Untuk Pelamar</h3>
                <p class="text-sm text-gray-700 mb-3">Bangun profil profesional Anda, temukan peluang kerja baru</p>
                <a href="{{ route('find_job') }}" class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-full text-sm font-bold">Cari Loker</a>
            </div>
            <img src="{{ asset('images/candidate.png') }}" alt="Candidate Image" class="w-32 h-32 object-contain">
        </div>
    </div>
</section>