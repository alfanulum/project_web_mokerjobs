@extends('layouts.app')

@section('content')
<form action="{{ route('form_postjob_step1.store') }}" method="POST" class="flex flex-col lg:flex-row min-h-screen">
  @csrf

  <!-- Left: Form Inputs -->
  <div class="w-full lg:w-1/2 bg-white p-8">
    <!-- Job Name -->
    <h2 class="text-2xl font-bold mb-4">Job Name</h2>
    <p class="text-gray-600 mb-2">Enter the name of the job or position to be posted.</p>
    <input type="text" name="job_name" value="{{ old('job_name') }}"
      class="w-full border border-orange-500 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-orange-500 mb-8"
      required>
    @error('job_name') <p class="text-red-600">{{ $message }}</p> @enderror

    <!-- Job Type -->
    <h2 class="text-2xl font-bold mb-4">Job Type</h2>
    <p class="text-gray-600 mb-2">Enter the type of the job or position to be posted.</p>
    <select id="job_type" name="job_type"
      class="w-full border border-orange-500 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-orange-500 mb-8"
      required>
      <option value="">-- Select Job Type --</option>
      @foreach ($jobTypes as $type)
      <option value="{{ $type }}" {{ old('job_type') == $type ? 'selected' : '' }}>
        {{ $type }}
      </option>
      @endforeach
    </select>
    @error('job_type') <p class="text-red-600">{{ $message }}</p> @enderror
  </div>

  <!-- Right: Category Selection -->
  <div class="w-full lg:w-1/2 bg-orange-500 text-white p-8">
    <h2 class="text-2xl font-bold mb-2">Category</h2>
    <p class="text-white mb-6">Enter the category of the job or position to be posted.</p>

    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-8">
      @foreach ($categories as $category)
      <label
        class="cursor-pointer bg-white text-orange-600 px-4 py-2 rounded-lg font-medium hover:bg-orange-100 block text-center">
        <input type="radio" name="category" value="{{ $category }}" class="hidden"
          {{ old('category') == $category ? 'checked' : '' }} required>
        {{ $category }}
      </label>
      @endforeach
    </div>
    @error('category') <p class="text-red-600">{{ $message }}</p> @enderror

    <!-- Only One Form: Submit -->
    <div class="text-right">
      <button type="submit"
        class="bg-yellow-400 text-black px-6 py-3 rounded-full font-semibold hover:bg-yellow-300">
        Next
      </button>
    </div>
  </div>
</form>
@endsection
