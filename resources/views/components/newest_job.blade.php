@php
$jobs = include resource_path('views/data/jobs.blade.php');
@endphp

<section class="px-6 py-12 bg-[#f7eee7]">
    <div class="container mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8" data-aos="fade-up" data-aos-duration="700">
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
                x-init="$watch('page', () => { window.scrollTo({ top: $el.offsetTop - 100, behavior: 'smooth' }); })" data-aos="fade-left" data-aos-duration="700">

                <template x-for="(job, index) in paginatedJobs" :key="index">
                    <div x-html="`@include('components.jobcard')`"></div>
                </template>

                <!-- Navigasi -->
                <div class="flex justify-between items-center mt-4">
                    <button class="text-yellow-500 font-semibold flex items-center gap-2"
                        :disabled="page <= 1"
                        :class="{ 'opacity-50 cursor-not-allowed': page <= 1 }"
                        @click="page = Math.max(page - 1, 1)">
                        <span class="text-xl">⬅</span> Sebelumnya
                    </button>
                    <span class="text-sm text-gray-600">Halaman <span x-text="page"></span> / <span x-text="totalPages"></span></span>
                    <button class="text-yellow-500 font-semibold flex items-center gap-2"
                        :disabled="page >= totalPages"
                        :class="{ 'opacity-50 cursor-not-allowed': page >= totalPages }"
                        @click="page++">
                        Selanjutnya <span class="text-xl">➡</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>