<!-- Categories Dropdown Component -->
<div x-data="{ open: false }" class="relative w-full md:w-1/2 z-[999]">
  <!-- Trigger -->
  <div @click="open = !open" class="flex items-center border border-orange-500 px-4 py-2 rounded-full cursor-pointer bg-white relative z-20">
    <img src="{{ asset('images/iconkategori.png') }}" class="w-5 h-5 mr-2" alt="Category Icon">
    <span class="text-gray-500 opacity-70 font-semibold">Kategori</span>
    <svg class="ml-auto w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.66a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
    </svg>
  </div>

  <!-- Dropdown Menu -->
  <div
    x-show="open"
    @click.outside="open = false"
    x-transition
    class="absolute mt-2 w-[700px] bg-[#fdf4ed] rounded-2xl shadow-2xl z-[999] p-6 max-h-[450px] overflow-y-auto">
    <div class="grid grid-cols-2 gap-x-10 gap-y-2">
      @foreach ($categories as $category)
      <label class="flex justify-between items-center space-x-2 text-sm text-gray-800 hover:bg-orange-100 px-3 py-2 rounded cursor-pointer transition">
        <div class="flex items-center gap-2">
          <input type="radio" name="job_category" class="form-radio text-orange-500 focus:ring-0" />
          <span>{{ $category->name }}</span>
        </div>
        <span class="text-gray-400 text-xs">(000)</span>
      </label>
      @endforeach
    </div>
  </div>
</div>