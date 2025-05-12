<div class="transition-transform duration-300 hover:scale-[1.015] hover:shadow-xl border-l-4 rounded-2xl overflow-hidden"
    :class="job.border ?? 'border-yellow-400'">
    <div class="bg-white shadow-inner p-6 rounded-2xl relative ring-1 ring-gray-100"
        :class="job.ring ? 'ring-2 ' + job.ring : ''">

        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-5">
            <div class="flex items-start gap-4">
                <img :src="'/' + job.image" alt="Logo Perusahaan"
                    class="w-16 h-16 object-cover rounded-xl shadow-sm border border-gray-200 bg-gray-50">

                <div class="space-y-1">
                    <p class="text-xs font-semibold text-yellow-600">Tipe: <span x-text="job.type"></span></p>
                    <h3 class="text-xl font-bold text-gray-800 leading-snug" x-text="job.title"></h3>
                    <p class="text-sm text-gray-600">💰 Rp <span x-text="job.salary"></span> / Bulan</p>
                </div>
            </div>

            <div class="text-sm text-gray-500 text-right">
                <p class="mb-1">🕒 <span x-text="job.posted"></span></p>
                <div class="flex justify-end flex-wrap gap-2">
                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-medium"
                        x-text="job.work_type"></span>
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium"
                        x-text="job.edu"></span>
                </div>
            </div>
        </div>

        <div class="mt-5 flex flex-col md:flex-row md:justify-between md:items-center gap-2 pt-4 border-t text-sm text-gray-700">
            <div class="flex items-center gap-2">
                <span>📍 <span x-text="job.location"></span></span>
                <span class="hidden md:inline">|</span>
                <span class="font-semibold" x-text="job.company"></span>
            </div>
            <a :href="job.apply_url"
                class="bg-yellow-400 hover:bg-yellow-500 text-white px-5 py-2 rounded-full font-semibold text-sm transition duration-200">
                <span x-text="job.apply_label"></span>
            </a>
        </div>
    </div>
</div>