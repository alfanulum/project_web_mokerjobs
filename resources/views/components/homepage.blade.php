<section class="px-6 py-12 grid md:grid-cols-2 gap-8 items-center bg-white">
    <!-- Kiri: Konten Teks -->
    <div data-aos="fade-right">
        <p class="uppercase text-sm text-gray-500 mb-2 tracking-widest">Cari Lowongan kerja terbaik</p>
        <h1 class="text-6xl font-bold leading-snug">
            Cari <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">Pekerjaan Impian</span> Anda di Mojokerto.
        </h1>

        <!-- Form Input -->
        <div class="flex flex-col gap-4 mt-6">
            <!-- Search Input -->
            <div class="relative w-full">
                <img src="{{ asset('images/iconsearch.png') }}" class="absolute left-4 top-2.5 w-5 h-5" alt="Search Icon">
                <input type="text" placeholder="Search"
                    class="pl-12 py-2 border border-orange-500 rounded-full w-full focus:outline-none focus:ring-2 focus:ring-orange-300" />
            </div>

            <!-- Location & Category -->
            <div class="flex flex-col md:flex-row gap-4">
                <!-- Location -->
                <div x-data="{ open: false }" class="relative w-full md:w-1/2">
                    <div @click="open = !open"
                        class="flex items-center border border-orange-500 px-4 py-2 rounded-full cursor-pointer bg-white relative">
                        <img src="{{ asset('images/iconlokasi.png') }}" class="w-4 h-5 mr-2" alt="Location Icon">
                        <span class="text-gray-700">Lokasi</span>
                        <svg class="ml-auto w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.66a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>

                    <!-- Dropdown -->
                    <div x-show="open" @click.outside="open = false"
                        class="absolute mt-2 w-[350px] bg-white rounded-xl shadow-xl z-50 p-4 space-y-4">
                        <div>
                            <h3 class="text-sm font-bold text-orange-500 border-b pb-1 mb-2">Kota Mojokerto</h3>
                            <div class="flex flex-col gap-2">
                                <label class="flex items-center"><input type="radio" name="location" class="mr-2"> Prajurit Kulon</label>
                                <label class="flex items-center"><input type="radio" name="location" class="mr-2"> Magersari</label>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-orange-500 border-b pb-1 mb-2">Kabupaten Mojokerto</h3>
                            <div class="grid grid-cols-2 gap-2">
                                <label class="flex items-center"><input type="radio" name="location" class="mr-2"> Bangsal</label>
                                <label class="flex items-center"><input type="radio" name="location" class="mr-2"> Dlanggu</label>
                                <label class="flex items-center"><input type="radio" name="location" class="mr-2"> Gondang</label>
                                <label class="flex items-center"><input type="radio" name="location" class="mr-2"> Jetis</label>
                                <label class="flex items-center"><input type="radio" name="location" class="mr-2"> Mojoanyar</label>
                                <label class="flex items-center"><input type="radio" name="location" class="mr-2"> Puri</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category -->
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

    <!-- Kanan: Gambar Hero -->
    <div class="flex justify-center" data-aos="fade-left">
        <img src="{{ asset('images/women.png') }}" alt="Hero Image" class="rounded-xl max-h-[500px] object-contain" />
    </div>
</section>

<!-- Section Bawah -->
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