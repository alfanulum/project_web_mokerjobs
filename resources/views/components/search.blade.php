<div class="relative w-full">
  <img src="{{ asset('images/iconsearch.png') }}" class="absolute left-4 top-2.5 w-5 h-5" alt="Search Icon">
  <input
    type="text"
    name="search"
    placeholder="Search"
    value="{{ request('search') }}"
    class="pl-12 py-2 border border-orange-500 rounded-full w-full
          focus:outline-none focus:ring-2 focus:ring-orange-300
          bg-white text-gray-500 font-semibold placeholder-gray-500 placeholder-opacity-70 placeholder-font-semibold" />
</div>