@if ($paginator->hasPages())
<div class="flex justify-center mt-6">
  <div class="flex items-center space-x-2 text-sm font-semibold">

    {{-- Previous Page --}}
    @if ($paginator->onFirstPage())
    <span class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 text-gray-400 cursor-not-allowed shadow-inner">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
    </span>
    @else
    <a href="{{ $paginator->previousPageUrl() }}#jobs"
      class="w-9 h-9 flex items-center justify-center rounded-full bg-white text-yellow-500 hover:bg-yellow-100 shadow hover:scale-105 transform transition duration-200">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
    </a>
    @endif

    {{-- Page Numbers --}}
    @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
    @if ($page == $paginator->currentPage())
    <span
      class="px-4 py-2 rounded-full bg-yellow-400 text-white shadow-lg transform scale-105 ring-2 ring-yellow-300 transition">
      {{ $page }}
    </span>
    @else
    <a href="{{ $url }}#jobs"
      class="px-4 py-2 rounded-full bg-white text-gray-700 hover:bg-yellow-100 hover:text-yellow-600 transition hover:scale-105 shadow-sm">
      {{ $page }}
    </a>
    @endif
    @endforeach

    {{-- Next Page --}}
    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}#jobs"
      class="w-9 h-9 flex items-center justify-center rounded-full bg-white text-yellow-500 hover:bg-yellow-100 shadow hover:scale-105 transform transition duration-200">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
      </svg>
    </a>
    @else
    <span class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 text-gray-400 cursor-not-allowed shadow-inner">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
      </svg>
    </span>
    @endif

  </div>
</div>
@endif