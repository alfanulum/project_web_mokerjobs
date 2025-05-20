@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row">
        <!-- Left Panel -->
        <div class="w-full md:w-1/2 bg-white px-8 py-12">
            <div class="max-w-md mx-auto">
                <div class="mb-10">
                    <img src="{{ asset('images/LOGO.png') }}" alt="moker.jobs" class="h-8 mb-6">
                </div>

<<<<<<< HEAD
                <!-- Job Name -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-black mb-2">Job Name</h2>
                    <p class="text-sm text-gray-600 mb-3">Enter the name of the job or position to be posted.</p>
                    <input type="text" name="job_name" id="job_name"
                        class="w-full px-4 py-3 border-2 border-orange-400 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                        placeholder="Job Name">
                </div>

                <!-- Job Type -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-black mb-2">Job Type</h2>
                    <p class="text-sm text-gray-600 mb-3">Enter the type of the job or position to be posted.</p>
                    <details class="bg-white rounded-md shadow-sm">
                        <summary
                            class="cursor-pointer px-4 py-3 font-semibold flex justify-between items-center border border-gray-300 rounded-md text-sm">
                            Select Job Type
                            <svg class="w-4 h-4 transform transition-transform duration-200 group-open:rotate-180"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </summary>
=======
  <!-- Left: Form Inputs -->
  <div class="w-full lg:w-1/2 bg-white p-8">
    <!-- Job Name -->
    <h2 class="text-2xl font-bold mb-4">Job Name</h2>
    <p class="text-gray-600 mb-2">Enter the name of the job or position to be posted.</p>
    <input type="text" name="job_name" value="{{ old('job_name') }}"
      class="w-full border border-orange-500 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-orange-500 mb-8"
      required>
    @error('job_name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

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
>>>>>>> 475308579cf23e2db3abb790f65f7933827663a3

                        <div class="px-4 pb-4 pt-2">
                            <div class="bg-white border rounded px-4 py-2 space-y-2 max-h-60 overflow-y-auto text-sm">
                                @foreach ($jobTypes as $type)
                                    <label class="flex items-center gap-2 text-gray-800 cursor-pointer">
                                        <input type="radio" name="job_type" value="{{ $type }}"
                                            class="accent-orange-500" required />
                                        <span>{{ $type }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </details>

<<<<<<< HEAD
                </div>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="w-full md:w-1/2 bg-orange-500 px-8 py-12 text-white relative">
            <!-- Back Button -->
            <a href="{{ route('post_job') }}" class="absolute top-6 right-6 text-white hover:text-yellow-300 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>

            <form action="{{ route('store_step1') }}" method="POST" class="max-w-3xl mx-auto">
                @csrf

                <!-- Category -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold mb-2">Category</h2>
                    <p class="text-sm mb-4 text-white">Enter the category of the job or position to be posted.</p>

                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($categories as $category)
                            @php
                                $icon = \App\Http\Controllers\JobController::getCategoryIcon($category);
                            @endphp
                            <div>
                                <input type="radio" name="category" id="category_{{ Str::slug($category) }}"
                                    value="{{ $category }}" class="hidden peer" required>
                                <label for="category_{{ Str::slug($category) }}"
                                    class="flex flex-col items-center justify-center w-full h-24 px-4 py-3 bg-white text-black 
                                        border border-gray-300 rounded-xl text-sm font-semibold text-center 
                                        cursor-pointer peer-checked:bg-orange-200 peer-checked:text-white 
                                        hover:bg-orange-100 transition duration-200 space-y-2">
                                    <i
                                        class="{{ $icon }} text-orange-500 peer-checked:text-white transition text-xl"></i>
                                    <span>{{ $category }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    @error('category')
                        <p class="text-sm text-red-200 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Next Button -->
                <div class="text-right mt-6">
                    <button type="submit"
                        class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-8 py-3 rounded-full transition duration-200 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                        Next
                    </button>
                </div>
            </form>
        </div>
=======
    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-20">
      @foreach ($categories as $category)
      <label
        class="cursor-pointer bg-white text-orange-600 px-4 py-2 rounded-lg font-medium hover:bg-orange-100 block text-center">
        <input type="radio" name="category" value="{{ $category }}" class="hidden"
          {{ old('category') == $category ? 'checked' : '' }} required>
        {{ $category }}
      </label>
      @endforeach
    </div>
    @error('category') <p class="text-red-200 text-sm absolute bottom-24">{{ $message }}</p> @enderror

    <!-- Only One Form: Submit -->
    <div class="text-right">
      <button type="submit"
        class="bg-yellow-400 text-black px-6 py-3 rounded-full font-semibold hover:bg-yellow-300">
        Next
      </button>
>>>>>>> 475308579cf23e2db3abb790f65f7933827663a3
    </div>
@endsection
