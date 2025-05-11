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
            <aside class="col-span-1 bg-white rounded-2xl p-5 shadow-md" data-aos="fade-right" data-aos-duration="800">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Kategori Loker</h2>
                <div class="max-h-[500px] overflow-y-auto pr-1">
                    <ul class="space-y-4">
                        @php
                        $categories = [
                        ['name' => 'Admin & Operations', 'icon' => 'fa-briefcase'],
                        ['name' => 'Business Dev & Sales', 'icon' => 'fa-chart-line'],
                        ['name' => 'CS & Hospitality', 'icon' => 'fa-headset'],
                        ['name' => 'Data & Product', 'icon' => 'fa-database'],
                        ['name' => 'Design & Creative', 'icon' => 'fa-paint-brush'],
                        ['name' => 'Education & Training', 'icon' => 'fa-book-open'],
                        ['name' => 'Finance & Accounting', 'icon' => 'fa-calculator'],
                        ['name' => 'Food & Beverage', 'icon' => 'fa-utensils'],
                        ['name' => 'HR & Recruiting', 'icon' => 'fa-user-friends'],
                        ['name' => 'Health & Science', 'icon' => 'fa-heartbeat'],
                        ['name' => 'IT & Engineering', 'icon' => 'fa-code'],
                        ['name' => 'Marketing & Socmed', 'icon' => 'fa-bullhorn'],
                        ['name' => 'Pekerjaan Rumah', 'icon' => 'fa-home'],
                        ['name' => 'Pekerjaan Teknis', 'icon' => 'fa-cogs'],
                        ['name' => 'Retail & Merchandising', 'icon' => 'fa-store'],
                        ['name' => 'Transportation & Logistic', 'icon' => 'fa-truck'],
                        ];
                        @endphp

                        @foreach ($categories as $index => $category)
                        <li>
                            <button class="flex items-center justify-between w-full px-4 py-3 bg-[#fdfcfb] rounded-xl border border-gray-200 shadow-sm hover:bg-yellow-50 transition-all duration-200">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-yellow-100 text-orange-500 rounded-full flex items-center justify-center text-sm">
                                        <i class="fas {{ $category['icon'] }}"></i>
                                    </div>
                                    <span class="text-gray-800 text-sm font-medium">{{ $category['name'] }}</span>
                                </div>
                                <span class="text-xs text-gray-400 font-semibold">000 Opening</span>
                            </button>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

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
                    <div class="border-l-8 {{ $job['border'] }} bg-white p-5 rounded-2xl shadow-md {{ $job['ring'] ? 'ring-2 '.$job['ring'] : '' }}" data-aos="zoom-in-up" data-aos-delay="{{ $index * 150 }}" data-aos-duration="700">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                            <div>
                                <p class="text-xs font-medium text-gray-500">Tipe: {{ $job['type'] }}</p>
                                <h3 class="text-xl font-bold text-gray-800">Title Job #1</h3>
                                <p class="text-sm text-gray-500">Rp 000.000.000.000/Bulan</p>
                            </div>
                            <div class="text-right text-sm text-gray-500">
                                <p>Terakhir Upload: 1 bulan lalu</p>
                                <div class="mt-1 flex justify-end gap-2">
                                    <span class="bg-gray-100 text-gray-600 rounded-full px-3 py-0.5 text-xs">On-site</span>
                                    <span class="bg-gray-100 text-gray-600 rounded-full px-3 py-0.5 text-xs">{{ $job['edu'] }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row md:justify-between md:items-center mt-4 text-sm text-gray-600 gap-2">
                            <div class="flex items-center gap-2">
                                <span>📍 Jetis</span>
                                <span>|</span>
                                <span>Jetis Company</span>
                            </div>
                            <a href="#" class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-xl text-sm font-medium">Daftar</a>
                        </div>
                    </div>
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