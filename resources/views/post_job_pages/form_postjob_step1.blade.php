@extends('layouts.app')

@section('content')
<form action="{{ route('form_postjob_step1.store') }}" method="POST" class="flex flex-col lg:flex-row min-h-screen">
  @csrf

  <!-- Left: Job Name & Job Type -->
  <div class="w-full lg:w-1/2 bg-white p-10">
    <h2 class="text-xl font-bold mb-2">Job Name</h2>
    <p class="text-gray-600 mb-3">Enter the name of the job or position to be posted.</p>
    <input
      type="text"
      name="job_name"
      value="{{ old('job_name') }}"
      class="w-full border border-orange-500 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-orange-500 mb-8"
      required>
    @error('job_name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

    <h2 class="text-xl font-bold mb-2">Job Type</h2>
    <p class="text-gray-600 mb-3">Enter the type of the job or position to be posted.</p>
    <div class="relative">
      <select
        id="job_type"
        name="job_type"
        class="w-full border border-orange-500 rounded-md p-3 appearance-none focus:outline-none focus:ring-2 focus:ring-orange-500 mb-8"
        required>
        <option value="">Jobs Type</option>
        @foreach ($jobTypes as $type)
        <option value="{{ $type }}" {{ old('job_type') == $type ? 'selected' : '' }}>
          {{ $type }}
        </option>
        @endforeach
      </select>
      <div class="absolute top-5 right-4 text-gray-600 pointer-events-none">
        &#9650;
      </div>
    </div>
    @error('job_type') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
  </div>

  <!-- Right: Category -->
  <div class="w-full lg:w-1/2 bg-orange-500 text-white p-10 relative">
    <h2 class="text-xl font-bold mb-2">Category</h2>
    <p class="mb-6">Enter the category of the job or position to be posted.</p>

    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-20">
      @foreach ($categories as $category)
      <label class="cursor-pointer">
        <input
          type="radio"
          name="category"
          value="{{ $category }}"
          class="peer hidden"
          {{ old('category') == $category ? 'checked' : '' }}
          required>
        <div class="bg-white text-orange-600 peer-checked:bg-orange-100 peer-checked:font-semibold px-4 py-3 rounded-lg text-center shadow-sm hover:bg-orange-200 transition">
          {{ $category }}
        </div>
      </label>
      @endforeach
    </div>
    @error('category') <p class="text-red-200 text-sm absolute bottom-24">{{ $message }}</p> @enderror

    <div class="absolute bottom-10 right-10">
      <button
        type="submit"
        class="bg-yellow-400 text-black px-6 py-3 rounded-full font-semibold hover:bg-yellow-300 transition">
        Next
      </button>
    </div>
  </div>
</form>
@endsection
