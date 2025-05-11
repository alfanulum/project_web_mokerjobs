<div class="border-l-8 transition-all duration-300 hover:scale-[1.015] hover:shadow-lg"
    :class="job.border ?? 'border-yellow-400'">
    <div class="bg-white/70 backdrop-blur-lg p-6 rounded-3xl shadow-md relative"
        :class="job.ring ? 'ring-2 ' + job.ring : ''">

        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-5">
            <div class="flex items-start gap-4">
                <img :src="'/' + job.image" alt="Logo Perusahaan"
                    class="w-16 h-16 object-cover rounded-xl shadow-md border border-gray-200">

                <div>
                    <p class="text-xs font-semibold text-yellow-600">Tipe: <span x-text="job.type"></span></p>
                    <h3 class="text-xl font-bold text-gray-900" x-text="job.title"></h3>
                    <p class="text-sm text-gray-600">💰 Rp <span x-text="job.salary"></span> / Bulan</p>
                </div>
            </div>

            <div class="text-right text-sm text-gray-500">
                <p>🕒 <span x-text="job.posted"></span></p>
                <div class="mt-2 flex justify-end flex-wrap gap-2">
                    <span class="bg-yellow-100 text-yellow-800 rounded-full px-3 py-1 text-xs font-medium"
                        x-text="job.work_type"></span>
                    <span class="bg-yellow-100 text-yellow-800 rounded-full px-3 py-1 text-xs font-medium"
                        x-text="job.edu"></span>
                </div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:justify-between md:items-center mt-5 text-sm text-gray-700 gap-2 border-t pt-4">
            <div class="flex items-center gap-2">
                <span>📍 <span x-text="job.location"></span></span>
                <span>|</span>
                <span class="font-semibold" x-text="job.company"></span>
            </div>
            <a :href="job.apply_url"
                class="bg-yellow-400 hover:bg-yellow-500 text-white px-5 py-2 rounded-full text-sm font-semibold transition duration-200"
                x-text="job.apply_label">
            </a>
        </div>

        <!-- Icon bookmark opsional -->
        <button class="absolute top-4 right-4 text-gray-300 hover:text-yellow-400 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current" viewBox="0 0 20 20">
                <path d="M5 2a2 2 0 00-2 2v14l7-5 7 5V4a2 2 0 00-2-2H5z" />
            </svg>
        </button>
    </div>
</div>