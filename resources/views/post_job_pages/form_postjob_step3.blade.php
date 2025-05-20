<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Step 2 Form</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> <!-- Tambahkan ini -->
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-5">

   <div class="bg-white rounded-lg shadow-md w-full max-w-10xl flex flex-col min-h-[750px]">

    <!-- Header: logo kiri, back kanan -->
    <div class="flex justify-between items-center p-5 border-b border-gray-100">
      <img src="{{ asset('images/LOGO.png') }}" alt="MokerJobs Logo" class="h-10" />
      <button onclick="goBack()" class="text-yellow-500 text-2xl font-bold hover:text-yellow-600 transition">←</button>
  
      <div class="absolute right-10 bottom-[650px] w-[450px] h-[225px] rounded-b-full border-[60px] border-t-0 border-gray-200 opacity-30 z-0"></div>
    </div>

    <form class="flex-grow px-4 py-12 overflow-auto max-w-[1000px] mx-auto">

      <!-- Job Description -->
      <div class="mb-8">
        <label class="block text-gray-700 font-semibold mb-2">Job Description</label>
        <textarea class="w-full border border-orange-400 rounded-lg px-3 py-2 h-32" placeholder="Enter job description"></textarea>
      </div>

      <!-- Job Requirements -->
      <div class="mb-8">
        <label class="block text-gray-700 font-semibold mb-2">Job Requirements</label>
        <textarea class="w-full border border-orange-400 rounded-lg px-3 py-2 h-32" placeholder="Enter job requirements"></textarea>
      </div>

      <!-- Location Dropdown with Alpine.js -->
      <div class="mb-8 relative" x-data="{
          open: false,
          selected: '',
          selectedLabel() {
              return this.selected === '' ? 'Pilih Lokasi' : this.selected;
          },
          selectLocation(value) {
              this.selected = value;
              this.open = false;
              $refs.hiddenLokasi.value = value;
          }
      }">
        <label class="block text-gray-700 font-semibold mb-2">Location</label>

        <!-- Dropdown Trigger -->
        <div @click="open = !open" class="flex items-center border border-orange-400 px-4 py-2 rounded-full cursor-pointer bg-white relative z-20">
          <img src="{{ asset('images/iconlokasi.png') }}" class="w-4 h-5 mr-2" alt="Location Icon">
          <span class="text-gray-700" x-text="selectedLabel()"></span>
          <svg class="ml-auto w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.66a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
          </svg>
        </div>

        <!-- Hidden input -->
        <input type="hidden" name="lokasi" x-ref="hiddenLokasi">

        <!-- Dropdown Content -->
        <div x-show="open" @click.outside="open = false" x-transition class="absolute mt-2 w-[350px] bg-white rounded-xl shadow-xl z-50 p-4 space-y-4 max-h-96 overflow-y-auto">

          <!-- Kota Mojokerto -->
          <div>
            <div class="bg-orange-100 px-3 py-2 rounded-t-md">
              <h3 class="text-sm font-bold text-gray-800">Kota Mojokerto</h3>
            </div>
            <div class="bg-orange-50 px-3 py-2 space-y-2">
              <label class="flex items-center text-sm">
                <input type="radio" name="lokasi_radio" value="Prajurit Kulon" class="mr-2" @click="selectLocation('Prajurit Kulon')">
                Prajurit Kulon
              </label>
              <label class="flex items-center text-sm">
                <input type="radio" name="lokasi_radio" value="Magersari" class="mr-2" @click="selectLocation('Magersari')">
                Magersari
              </label>
            </div>
          </div>

          <!-- Kabupaten Mojokerto -->
          <div>
            <div class="bg-orange-100 px-3 py-2 rounded-t-md mt-4">
              <h3 class="text-sm font-bold text-gray-800">Kabupaten Mojokerto</h3>
            </div>
            <div class="bg-orange-50 px-3 py-2 grid grid-cols-2 gap-2 text-sm">
              @php
                $kabupatenLocations = [
                  'Dawarblandong', 'Kemlagi', 'Jetis', 'Gedeg', 'Mojoanyar', 'Sooko', 'Bangsal',
                  'Puri', 'Trowulan', 'Jatirejo', 'Dlanggu', 'Mojosari', 'Pungging', 'Kutorejo',
                  'Ngoro', 'Gondang', 'Trawas', 'Pacet'
                ];
              @endphp
              @foreach($kabupatenLocations as $loc)
                <label class="flex items-center">
                  <input type="radio" name="lokasi_radio" value="{{ $loc }}" class="mr-2" @click="selectLocation('{{ $loc }}')">
                  {{ $loc }}
                </label>
              @endforeach
            </div>
          </div>

        </div>
      </div>

      <!-- Salary Range -->
      <div class="grid grid-cols-2 gap-4 mb-8">
        <div>
          <label class="block text-gray-700 font-semibold mb-1">Minimum Salary (Rp)</label>
          <input type="number" class="w-full border border-orange-400 rounded-lg px-3 py-2" placeholder="Enter minimum salary">
        </div>
        <div>
          <label class="block text-gray-700 font-semibold mb-1">Maximum Salary (Rp)</label>
          <input type="number" class="w-full border border-orange-400 rounded-lg px-3 py-2" placeholder="Enter maximum salary">
        </div>
      </div>

    </form>

    <!-- Footer -->
    <div class="flex justify-between px-10 py-5 border-t border-gray-200">
      <button onclick="goBack()" class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-2 rounded-full">
        Previous
      </button>
      <button onclick="goNext()" class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-2 rounded-full">
        Next
      </button>
    </div>

  </div>

<script>
  function goBack() {
    window.location.href = "form_postjob_step1.blade.php";
  }
  function goNext() {
    window.location.href = "form_postjob_step3.blade.php";
  }
</script>

</body>
</html>
