@php
    use App\Http\Controllers\JobController;
    use App\Models\Lowongan;
    $categories = Lowongan::select('category_job')->distinct()->get();
    $currentCategory = request('kategori');
@endphp

<aside class="col-span-1 bg-white rounded-2xl p-5 shadow-md max-h-screen overflow-hidden" data-aos="fade-right"
    data-aos-duration="800">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Kategori Loker</h2>

    <div class="overflow-y-auto pr-1" style="max-height: calc(100vh - 160px);">
        <ul class="space-y-4">
            <li>
                <a href="{{ route('overview') }}"
                    class="flex items-center justify-between w-full px-4 py-3 rounded-xl border border-gray-200 shadow-sm transition-all duration-200 text-left
                        {{ !$currentCategory ? 'bg-yellow-100 border-orange-300' : 'bg-[#fdfcfb] hover:bg-yellow-50' }}">
                    <div class="flex items-center gap-3 min-w-0 overflow-hidden">
                        <div
                            class="w-8 h-8 {{ !$currentCategory ? 'bg-orange-200 text-orange-600' : 'bg-yellow-100 text-orange-500' }} rounded-full flex items-center justify-center text-sm shrink-0">
                            <i class="fas fa-list"></i>
                        </div>
                        <span class="text-gray-800 text-sm font-medium truncate max-w-[140px] block">
                            Semua Kategori
                        </span>
                    </div>
                    <span class="text-xs text-gray-400 font-semibold shrink-0">
                        {{ Lowongan::count() }} Opening
                    </span>
                </a>
            </li>
            @foreach ($categories as $category)
                <li>
                    <a href="{{ route('overview', ['kategori' => $category->category_job]) }}"
                        class="flex items-center justify-between w-full px-4 py-3 rounded-xl border border-gray-200 shadow-sm transition-all duration-200 text-left
                          {{ strtolower($currentCategory) === strtolower($category->category_job) ? 'bg-yellow-100 border-orange-300' : 'bg-[#fdfcfb] hover:bg-yellow-50' }}">
                        <div class="flex items-center gap-3 min-w-0 overflow-hidden">
                            <div
                                class="w-8 h-8 {{ strtolower($currentCategory) === strtolower($category->category_job) ? 'bg-orange-200 text-orange-600' : 'bg-yellow-100 text-orange-500' }} rounded-full flex items-center justify-center text-sm shrink-0">
                                <i class="{{ JobController::getCategoryIcon($category->category_job) }}"></i>
                            </div>
                            <span class="text-gray-800 text-sm font-medium truncate max-w-[140px] block">
                                {{ $category->category_job }}
                            </span>
                        </div>
                        <span class="text-xs text-gray-400 font-semibold shrink-0">
                            {{ Lowongan::where('category_job', $category->category_job)->count() }} Opening
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>
