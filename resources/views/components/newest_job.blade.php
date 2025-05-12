@php
$jobs = include resource_path('views/data/jobs.blade.php');
@endphp

<section class=" px-6 py-12 bg-[#f7eee7]">
    <div class="container mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 mt-8" data-aos="fade-up" data-aos-duration="700">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Loker Terbaru</h2>
                <p class="text-sm text-gray-600">Temukan lowongan pekerjaan yang disarankan</p>
            </div>
            <a href="#" class="mt-4 md:mt-0 bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-2 rounded-full">Selengkapnya</a>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <!-- Sidebar -->
            @include('components.jobcategories')

            <!-- Job Cards -->
            <div class="col-span-2 flex flex-col gap-6"
                x-data="{
                    page: 1,
                    perPage: 3,
                    total: {{ count($jobs) }},
                    get totalPages() {
                        return Math.ceil(this.total / this.perPage);
                    },
                    get paginatedJobs() {
                        return {{ Js::from($jobs) }}.slice((this.page - 1) * this.perPage, this.page * this.perPage);
                    }
                }"
                x-init="$watch('page', () => { window.scrollTo({ top: $el.offsetTop - 100, behavior: 'smooth' }); })"
                data-aos="fade-left" data-aos-duration="700">

                <template x-for="(job, index) in paginatedJobs" :key="index">
                    <div x-html="`@include('components.jobcard')`"></div>
                </template>

                <!-- Navigasi modern -->
                <div class="flex justify-center items-center mt-8 gap-6">
                    <!-- Tombol Sebelumnya -->
                    <button
                        class="flex items-center gap-2 px-4 py-2 rounded-full border border-gray-300 shadow-sm hover:shadow-md bg-white text-gray-700 font-medium transition-all duration-200 disabled:opacity-40 disabled:cursor-not-allowed"
                        :disabled="page <= 1"
                        @click="page = Math.max(page - 1, 1)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Sebelumnya</span>
                    </button>

                    <!-- Info Halaman -->
                    <span class="text-sm text-gray-600">Halaman <span x-text="page"></span> / <span x-text="totalPages"></span></span>

                    <!-- Tombol Selanjutnya -->
                    <button
                        class="flex items-center gap-2 px-4 py-2 rounded-full border border-gray-300 shadow-sm hover:shadow-md bg-white text-gray-700 font-medium transition-all duration-200 disabled:opacity-40 disabled:cursor-not-allowed"
                        :disabled="page >= totalPages"
                        @click="page++">
                        <span>Selanjutnya</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>