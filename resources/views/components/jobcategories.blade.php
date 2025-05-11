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

<aside class="col-span-1 bg-white rounded-2xl p-5 shadow-md" data-aos="fade-right" data-aos-duration="800">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Kategori Loker</h2>
    <div class="max-h-[500px] overflow-y-auto pr-1">
        <ul class="space-y-4">
            @foreach ($categories as $category)
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