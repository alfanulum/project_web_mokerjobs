@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-lg font-medium text-gray-900">Company Information</h2>
                    <span class="text-sm text-gray-500">Step 4 of 4</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 100%"></div>
                </div>
            </div>

            <!-- Form Container -->
            <div class="bg-white shadow rounded-lg p-6 sm:p-8">
                <form action="{{ route('store_postjob_step4') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Company Name -->
                    <div class="mb-6">
                        <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Company/Business
                            Name</label>
                        <input type="text" id="company_name" name="company_name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                            placeholder="e.g. MokerJobs Company"
                            value="{{ old('company_name', session('job_step4.company_name') ?? '') }}">
                        @error('company_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Company Description -->
                    <div class="mb-6">
                        <label for="company_description"
                            class="block text-sm font-medium text-gray-700 mb-1">Company/Business Description</label>
                        <textarea id="company_description" name="company_description" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                            placeholder="e.g. MokerJobs is a industry...">{{ old('company_description', session('job_step4.company_description') ?? '') }}</textarea>
                        @error('company_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Company Address -->
                    <div class="mb-6">
                        <label for="company_address" class="block text-sm font-medium text-gray-700 mb-1">Company/Business
                            Address</label>
                        <input type="text" id="company_address" name="company_address"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                            placeholder="e.g. 123 Meri Street, Meri, Magersari District, Mojokerto City, East Java 613..."
                            value="{{ old('company_address', session('job_step4.company_address') ?? '') }}">
                        @error('company_address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Company Industry Dropdown -->
                    <div class="mb-6">
                        <label for="company_industry" class="block text-sm font-medium text-gray-700 mb-1">Company/Business
                            Industry</label>
                        <select id="company_industry" name="company_industry"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            <option value="" disabled selected>Choose one</option>
                            @foreach (['Telecommunications', 'Garment or Textile Manufacturing', 'Fitness & Lifestyle', 'Nonprofit Organizations', 'Energy & Environment', 'Law & Legal Consulting', 'Finance & Banking', 'Events & Entertainment', 'Agribusiness', 'Construction & Property', 'Healthcare', 'Startups & Information Technology', 'Transportation & Logistics', 'Retail & E-commerce', 'Food & Beverage Production', 'Media & Creative', 'Tourism & Hospitality', 'Restaurants & Cafes', 'Education & Training'] as $industry)
                                <option value="{{ $industry }}" @if (old('company_industry', session('job_step4.company_industry') ?? '') == $industry) selected @endif>
                                    {{ $industry }}
                                </option>
                            @endforeach
                        </select>
                        @error('company_industry')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Website/Social Media -->
                    <div class="mb-6">
                        <label for="company_website" class="block text-sm font-medium text-gray-700 mb-1">Website/Social
                            Media</label>
                        <input type="url" id="company_website" name="company_website"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                            placeholder="e.g. https://www.instagram.com/Mokerjobs/"
                            value="{{ old('company_website', session('job_step4.company_website') ?? '') }}">
                        @error('company_website')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Company Logo Upload -->
                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Company/Business logo</label>
                        <div class="mt-1 flex items-center">
                            <div class="relative">
                                <input type="file" id="company_logo" name="company_logo"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                                <label for="company_logo"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Upload Logo
                                </label>
                            </div>
                            <span class="ml-3 text-sm text-gray-500" id="file-name">
                                @if (session('job_step4.company_logo'))
                                    {{ session('job_step4.company_logo') }}
                                @else
                                    No file chosen
                                @endif
                            </span>
                        </div>
                        @error('company_logo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">PNG, JPG, JPEG up to 2MB</p>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-8">
                        <a href="{{ route('form_postjob_step3') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Previous
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Next
                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Display the selected file name
        document.getElementById('company_logo').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'No file chosen';
            document.getElementById('file-name').textContent = fileName;
        });
    </script>
@endsection
    