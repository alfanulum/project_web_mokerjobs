<div class="flex justify-center items-center mt-8 gap-6">
  <!-- Tombol Sebelumnya -->
  <a href="{{ $previousPageUrl ?? '#' }}"
    class="flex items-center gap-2 px-4 py-2 rounded-full border border-gray-300 shadow-sm hover:shadow-md bg-white text-gray-700 font-medium transition-all duration-200 {{ !$previousPageUrl ? 'opacity-40 pointer-events-none' : '' }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
    </svg>
    <span>Sebelumnya</span>
  </a>

  <!-- Info Halaman -->
  <span class="text-sm text-gray-600">Halaman {{ $currentPage }} / {{ $lastPage }}</span>

  <!-- Tombol Selanjutnya -->
  <a href="{{ $nextPageUrl ?? '#' }}"
    class="flex items-center gap-2 px-4 py-2 rounded-full border border-gray-300 shadow-sm hover:shadow-md bg-white text-gray-700 font-medium transition-all duration-200 {{ !$nextPageUrl ? 'opacity-40 pointer-events-none' : '' }}">
    <span>Selanjutnya</span>
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
    </svg>
  </a>
</div>