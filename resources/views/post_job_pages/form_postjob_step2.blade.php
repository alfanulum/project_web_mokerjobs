@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md w-full max-w-7xl flex flex-col min-h-[750px] mx-auto mt-10">

    <!-- Header: logo kiri, back kanan -->
    <div class="flex justify-between items-center p-5 border-b border-gray-100 relative">
      <img src="{{ asset('images/LOGO.png') }}" alt="MokerJobs Logo" class="h-10" />
      <button onclick="goBack()" class="text-yellow-500 text-2xl font-bold hover:text-yellow-600 transition">←</button>
  
      <div class="absolute right-10 bottom-[650px] w-[450px] h-[225px] rounded-b-full border-[60px] border-t-0 border-gray-200 opacity-30 z-0"></div>
    </div>

    <form class="flex-grow px-4 py-12 overflow-auto max-w-[1000px] mx-auto">

       <!-- Work type -->
      <div class="mb-6">
        <label class="block text-gray-700 font-semibold mb-2 text-center">Work type</label>
        <div class="flex justify-center items-center border border-orange-400 rounded-full overflow-hidden">
          <label class="flex items-center justify-center gap-2 flex-1 py-2 cursor-pointer relative">
            <input type="radio" name="workType" value="Remote" class="accent-orange-400 peer sr-only" />
            <span class="peer-checked:text-yellow-500 font-semibold">Remote</span>
            <span class="hidden md:block absolute right-0 top-1/4 h-1/2 border-r border-orange-400"></span>
          </label>

          <label class="flex items-center justify-center gap-2 flex-1 py-2 cursor-pointer relative">
            <input type="radio" name="workType" value="OnSite" class="accent-orange-400 peer sr-only" />
            <span class="peer-checked:text-yellow-500 font-semibold">On Site</span>
            <span class="hidden md:block absolute right-0 top-1/4 h-1/2 border-r border-orange-400"></span>
          </label>

          <label class="flex items-center justify-center gap-2 flex-1 py-2 cursor-pointer">
            <input type="radio" name="workType" value="Hybrid" class="accent-orange-400 peer sr-only" />
            <span class="peer-checked:text-yellow-500 font-semibold">Hybrid</span>
          </label>
        </div>
      </div>

      <!-- Gender -->
      <div class="mb-6">
        <label class="block text-gray-700 font-semibold mb-2 text-center">Gender</label>
        <div class="flex justify-center items-center border border-orange-400 rounded-full overflow-hidden">
          <label class="flex items-center justify-center gap-2 flex-1 py-2 cursor-pointer relative">
            <input type="radio" name="gender" value="Man" class="accent-orange-400 peer sr-only" />
            <span class="peer-checked:text-yellow-500 font-semibold">Man</span>
            <span class="hidden md:block absolute right-0 top-1/4 h-1/2 border-r border-orange-400"></span>
          </label>

          <label class="flex items-center justify-center gap-2 flex-1 py-2 cursor-pointer relative">
            <input type="radio" name="gender" value="Woman" class="accent-orange-400 peer sr-only" />
            <span class="peer-checked:text-yellow-500 font-semibold">Woman</span>
            <span class="hidden md:block absolute right-0 top-1/4 h-1/2 border-r border-orange-400"></span>
          </label>

          <label class="flex items-center justify-center gap-2 flex-1 py-2 cursor-pointer">
            <input type="radio" name="gender" value="ManWoman" class="accent-orange-400 peer sr-only" />
            <span class="peer-checked:text-yellow-500 font-semibold">Man/Woman</span>
          </label>
        </div>
      </div>

      <!-- Dropdowns -->
      <div class="grid grid-cols-3 gap-4 border border-orange-400 rounded-lg p-4 mb-8">
        <div>
          <label class="block text-gray-700 font-semibold mb-1">Minimum education</label>
          <select class="w-full border border-gray-300 rounded px-3 py-2">
            <option>High School</option>
            <option>Diploma</option>
            <option>Bachelor's</option>
            <option>Master's</option>
            <option>Doctorate</option>
          </select>
        </div>
        <div>
          <label class="block text-gray-700 font-semibold mb-1">Experience Level</label>
          <select class="w-full border border-gray-300 rounded px-3 py-2">
            <option>0-1 Years</option>
            <option>2-3 Years</option>
            <option>4-5 Years</option>
            <option>5+ Years</option>
          </select>
        </div>
        <div>
          <label class="block text-gray-700 font-semibold mb-1">Age</label>
          <select class="w-full border border-gray-300 rounded px-3 py-2">
            <option>18-25</option>
            <option>26-35</option>
            <option>36-45</option>
            <option>46+</option>
          </select>
        </div>
      </div>

    </form>

    <!-- Footer: tombol Previous & Next -->
    <!-- Footer: tombol Previous & Next -->
<div class="flex justify-between px-10 py-5 border-t border-gray-200">
  <button onclick="goBack()" class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-2 rounded-full">
    Previous
  </button>
  <button onclick="goNext()" class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-2 rounded-full">
    Next
  </button>
</div>

<script>
  function goBack() {
    window.location.href = "{{ route('form_postjob_step1') }}";
  }
  function goNext() {
    window.location.href = "{{ route('form_postjob_step3') }}";
  }
</script>
@endsection
