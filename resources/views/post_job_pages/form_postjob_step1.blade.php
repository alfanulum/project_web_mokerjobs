@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row min-h-screen w-full font-poppins">
        <form action="{{ route('store_step1') }}" method="POST" class="w-full flex flex-col md:flex-row">
            @csrf

            <!-- Left Panel -->
            <div class="w-full md:w-1/2 bg-white px-8 py-12 flex flex-col justify-between">
                <div class="max-w-md mx-auto">
                    <div class="mb-10">
                        <img src="{{ asset('images/LOGO.png') }}" alt="moker.jobs" class="h-8 mb-6">
                    </div>

                    <!-- Job Name -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-black mb-2">Nama Pekerjaan</h2>
                        <p class="text-sm text-gray-600 mb-3">Masukkan judul pekerjaan yang akan anda posting.</p>
                        <input type="text" name="job_name" id="job_name"
                            class="w-full px-4 py-3 border-2 border-orange-400 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                            value="{{ old('job_name', $oldData['job_name'] ?? '') }}" placeholder="Nama Pekerjaan" required>
                        @error('job_name')
                            <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Job Type -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-black mb-2">Tipe Pekerjaan</h2>
                        <p class="text-sm text-gray-600 mb-3">Pilih tipe pekerjaan yang akan anda posting.</p>

                        <details class="bg-white rounded-md shadow-sm" id="jobTypeDetails">
                            <summary id="jobTypeSummary"
                                class="cursor-pointer px-4 py-3 font-semibold flex justify-between items-center border border-gray-300 rounded-md text-sm">
                                <span id="jobTypeLabel">Pilih Tipe Pekerjaan</span>
                                <svg class="w-4 h-4 transform transition-transform duration-200" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </summary>

                            <div class="px-4 pb-4 pt-2">
                                <div class="bg-white border rounded px-4 py-2 space-y-2 max-h-60 overflow-y-auto text-sm">
                                    @foreach ($jobTypes as $type)
                                        @php
                                            // Ensure consistent formatting for display
                                            $displayType = $type;
                                            if ($type === 'Fulltime') {
                                                $displayType = 'Full Time';
                                            }
                                            if ($type === 'Parttime') {
                                                $displayType = 'Part Time';
                                            }
                                        @endphp
                                        <label class="flex items-center gap-2 text-gray-800 cursor-pointer">
                                            <input type="radio" name="job_type" value="{{ $type }}"
                                                class="accent-orange-500 job-type-radio"
                                                {{ old('job_type', $oldData['job_type'] ?? '') == $type ? 'checked' : '' }}
                                                required />
                                            <span>{{ $displayType }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </details>

                        @error('job_type')
                            <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Back Button -->
                <div class="text-left mt-6">
                    <a href="{{ route('post_job') }}"
                        class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-8 py-3 rounded-full transition duration-200 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                        ← Back
                    </a>
                </div>
            </div>

            <!-- Right Panel -->
            <div class="w-full md:w-1/2 bg-orange-500 px-8 py-12 text-white flex flex-col justify-between relative">
                <div class="max-w-3xl mx-auto">
                    <!-- Category -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold mb-2">Kategori</h2>
                        <p class="text-sm mb-4 text-white">Pilih kategori pekerjaan yang akan anda posting.</p>

                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($categories as $category)
                                @php
                                    $icon = \App\Http\Controllers\JobController::getCategoryIcon($category);
                                @endphp
                                <div>
                                    <input type="radio" name="category_job" id="category_{{ Str::slug($category) }}"
                                        value="{{ $category }}" class="hidden peer"
                                        {{ old('category_job', $oldData['category_job'] ?? '') == $category ? 'checked' : '' }}
                                        required>
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

                        @error('category_job')
                            <p class="text-sm text-red-200 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Next Button -->
                <div class="text-right mt-6">
                    <button type="submit"
                        class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-8 py-3 rounded-full transition duration-200 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                        Next →
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Script: Update job type label -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radios = document.querySelectorAll('.job-type-radio');
            const labelSpan = document.getElementById('jobTypeLabel');

            radios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.checked) {
                        // Format the display text consistently
                        let displayText = this.value;
                        if (displayText === 'Fulltime') displayText = 'Full Time';
                        if (displayText === 'Parttime') displayText = 'Part Time';
                        labelSpan.textContent = displayText;
                    }
                });

                if (radio.checked) {
                    let displayText = radio.value;
                    if (displayText === 'Fulltime') displayText = 'Full Time';
                    if (displayText === 'Parttime') displayText = 'Part Time';
                    labelSpan.textContent = displayText;
                }
            });
        });
    </script>
@endsection
