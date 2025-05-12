@php
use App\Models\Category;
$categories = Category::all();
@endphp

<aside class="col-span-1 bg-white rounded-2xl p-5 shadow-md max-h-screen overflow-hidden" data-aos="fade-right" data-aos-duration="800">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Kategori Loker</h2>

    <div class="overflow-y-auto pr-1" style="max-height: calc(100vh - 160px);">
        <ul class="space-y-4">
            @foreach ($categories as $category)
            <li>
                <button class="flex items-center justify-between w-full px-4 py-3 bg-[#fdfcfb] rounded-xl border border-gray-200 shadow-sm hover:bg-yellow-50 transition-all duration-200 text-left">
                    <div class="flex items-center gap-3 min-w-0 overflow-hidden">
                        <div class="w-8 h-8 bg-yellow-100 text-orange-500 rounded-full flex items-center justify-center text-sm shrink-0">
                            <i class="fas {{ $category->icon }}"></i>
                        </div>
                        <span class="text-gray-800 text-sm font-medium truncate max-w-[140px] block">
                            {{ $category->name }}
                        </span>
                    </div>
                    <span class="text-xs text-gray-400 font-semibold shrink-0">000 Opening</span>
                </button>
            </li>
            @endforeach
        </ul>
    </div>
</aside>