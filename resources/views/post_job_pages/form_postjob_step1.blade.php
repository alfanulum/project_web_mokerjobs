@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row">
        <form action="{{ route('store_step1') }}" method="POST" class="w-full flex flex-col md:flex-row">
            @csrf

            <!-- Left Panel -->
            <div class="w-full md:w-1/2 bg-white px-8 py-12">
                <div class="max-w-md mx-auto">
                    <div class="mb-10">
                        <img src="{{ asset('images/LOGO.png') }}" alt="moker.jobs" class="h-8 mb-6">
                    </div>

                    <!-- Job Name -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-black mb-2">Job Name</h2>
                        <p class="text-sm text-gray-600 mb-3">Enter the name of the job or position to be posted.</p>
                        <input type="text" name="job_name" id="job_name"
                            class="w-full px-4 py-3 border-2 border-orange-400 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                            placeholder="Job Name" required>
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
                    </div>
                </div>
            </div>

            <!-- Right Panel -->
            <div class="w-full md:w-1/2 bg-orange-500 px-8 py-12 text-white relative">
                <!-- Back Button -->
                <a href="{{ route('post_job') }}"
                    class="absolute top-6 right-6 text-white hover:text-yellow-300 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>

                <div class="max-w-3xl mx-auto">
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
                    <!-- Inside your right panel (no other changes needed) -->
                    <div class="text-right mt-6">
                        <!-- Replace the submit button with a styled link -->
                        <a href="{{ route('form_postjob_step2') }}"
                            class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-8 py-3 rounded-full transition duration-200 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                            Next
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection