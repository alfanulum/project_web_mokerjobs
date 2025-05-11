<!-- Homepage Section -->
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
                <!-- Include Category Dropdown Component -->
                @include('components.category-dropdown')
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