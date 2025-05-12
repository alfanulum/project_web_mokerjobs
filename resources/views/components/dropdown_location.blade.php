<!-- Dropdown Lokasi -->
<div x-data="{ open: false }" class="relative w-full md:w-1/2 z-[1000]">
  <!-- Trigger -->
  <div @click="open = !open" class="flex items-center border border-orange-500 px-4 py-2 rounded-full cursor-pointer bg-white relative z-20">
    <img src="{{ asset('images/iconlokasi.png') }}" class="w-4 h-5 mr-2" alt="Location Icon">
    <span class="text-gray-500 opacity-70 font-semibold">Lokasi</span>
    <svg class="ml-auto w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.66a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
    </svg>
  </div>

  <!-- Dropdown -->
  <div x-show="open" @click.outside="open = false" class="absolute mt-2 w-[350px] bg-white rounded-xl shadow-xl z-50 p-4 space-y-4 max-h-96 overflow-y-auto">

    <!-- Kota Mojokerto -->
    <div>
      <div class="bg-orange-100 px-3 py-2 rounded-t-md">
        <h3 class="text-sm font-bold text-gray-800">Kota Mojokerto</h3>
      </div>
      <div class="bg-orange-50 px-3 py-2 space-y-2">
        <label class="flex items-center text-sm"><input type="radio" name="location" value="Prajurit Kulon" class="mr-2"> Prajurit Kulon</label>
        <label class="flex items-center text-sm"><input type="radio" name="location" value="Magersari" class="mr-2"> Magersari</label>
      </div>
    </div>

    <!-- Kabupaten Mojokerto -->
    <div>
      <div class="bg-orange-100 px-3 py-2 rounded-t-md mt-4">
        <h3 class="text-sm font-bold text-gray-800">Kabupaten Mojokerto</h3>
      </div>
      <div class="bg-orange-50 px-3 py-2 grid grid-cols-2 gap-2 text-sm">
        <label class="flex items-center"><input type="radio" name="location" value="Dawarblandong" class="mr-2"> Dawarblandong</label>
        <label class="flex items-center"><input type="radio" name="location" value="Kemlagi" class="mr-2"> Kemlagi</label>
        <label class="flex items-center"><input type="radio" name="location" value="Jetis" class="mr-2"> Jetis</label>
        <label class="flex items-center"><input type="radio" name="location" value="Gedeg" class="mr-2"> Gedeg</label>
        <label class="flex items-center"><input type="radio" name="location" value="Mojoanyar" class="mr-2"> Mojoanyar</label>
        <label class="flex items-center"><input type="radio" name="location" value="Sooko" class="mr-2"> Sooko</label>
        <label class="flex items-center"><input type="radio" name="location" value="Bangsal" class="mr-2"> Bangsal</label>
        <label class="flex items-center"><input type="radio" name="location" value="Puri" class="mr-2"> Puri</label>
        <label class="flex items-center"><input type="radio" name="location" value="Trowulan" class="mr-2"> Trowulan</label>
        <label class="flex items-center"><input type="radio" name="location" value="Jatirejo" class="mr-2"> Jatirejo</label>
        <label class="flex items-center"><input type="radio" name="location" value="Dlanggu" class="mr-2"> Dlanggu</label>
        <label class="flex items-center"><input type="radio" name="location" value="Mojosari" class="mr-2"> Mojosari</label>
        <label class="flex items-center"><input type="radio" name="location" value="Pungging" class="mr-2"> Pungging</label>
        <label class="flex items-center"><input type="radio" name="location" value="Kutorejo" class="mr-2"> Kutorejo</label>
        <label class="flex items-center"><input type="radio" name="location" value="Ngoro" class="mr-2"> Ngoro</label>
        <label class="flex items-center"><input type="radio" name="location" value="Gondang" class="mr-2"> Gondang</label>
        <label class="flex items-center"><input type="radio" name="location" value="Trawas" class="mr-2"> Trawas</label>
        <label class="flex items-center"><input type="radio" name="location" value="Pacet" class="mr-2"> Pacet</label>
      </div>
    </div>
  </div>
</div>