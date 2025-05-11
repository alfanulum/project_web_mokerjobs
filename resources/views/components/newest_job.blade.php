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
            <div class="col-span-2 flex flex-col gap-6">
                <div class="space-y-4">
                    @php
                    $jobs = [
                    ['type' => 'Full Time', 'border' => 'border-orange-400', 'ring' => 'ring-blue-500', 'edu' => 'S1-S2'],
                    ['type' => 'Part Time', 'border' => 'border-red-300', 'ring' => '', 'edu' => 'D1-D3'],
                    ['type' => 'Freelance', 'border' => 'border-yellow-300', 'ring' => '', 'edu' => 'SMA/K'],
                    ];
                    @endphp

                    @foreach ($jobs as $index => $job)
                    <x-job_card :job="$job" :index="$index" />
                    @endforeach
                </div>

                <!-- Navigasi -->
                <div class="flex justify-between items-center mt-4" data-aos="fade-up" data-aos-duration="700">
                    <button class="text-yellow-500 font-semibold flex items-center gap-2">
                        <span class="text-xl">⬅</span> Sebelumnya
                    </button>
                    <button class="text-yellow-500 font-semibold flex items-center gap-2">
                        Selanjutnya <span class="text-xl">➡</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>