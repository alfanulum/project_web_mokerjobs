<!-- Location Dropdown Component -->
<div x-data="{ open: false }" class="relative w-full md:w-1/2 z-50">
  <!-- Location Trigger -->
  <div @click="open = !open" class="flex items-center border border-orange-500 px-4 py-2 rounded-full cursor-pointer bg-white relative z-20">
    <img src="{{ asset('images/iconlokasi.png') }}" class="w-4 h-5 mr-2" alt="Location Icon">
    <span class="text-gray-500 opacity-70 font-semibold">Location</span>
    <svg class="ml-auto w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.66a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
    </svg>
  </div>

  <!-- Dropdown -->
  <div x-show="open" @click.outside="open = false" class="absolute mt-2 w-[350px] bg-white rounded-xl shadow-xl z-50 p-4 space-y-4 max-h-96 overflow-y-auto">
    <!-- Kota Mojokerto -->
    <div class="bg-orange-100 p-2 rounded-t-lg">
      <h3 class="text-sm font-bold text-gray-700">Kota Mojokerto</h3>
    </div>
    <div class="p-2 space-y-2">
      <label class="flex items-center"><input type="radio" name="location" class="mr-2"> Prajurit Kulon</label>
      <label class="flex items-center"><input type="radio" name="location" class="mr-2"> Magersari</label>
    </div>

    <!-- Kabupaten Mojokerto -->
    <div class="bg-orange-100 mt-4 p-2 rounded-t-lg">
      <h3 class="text-sm font-bold text-gray-700">Kabupaten Mojokerto</h3>
    </div>
    <div class="p-2 grid grid-cols-2 gap-2">
      <label class="flex items-center"><input type="radio" name="location" class="mr-2"> Prajurit Kulon</label>
      <label class="flex items-center"><input type="radio" name="location" class="mr-2"> Magersari</label>
      <label class="flex items-center"><input type="radio" name="location" class="mr-2"> Prajurit Kulon</label>
      <label class="flex items-center"><input type="radio" name="location" class="mr-2"> Magersari</label>
    </div>
  </div>
</div>