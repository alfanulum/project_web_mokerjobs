@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#FAFAFA] py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-sm text-gray-800 font-semibold">
                {{ $jobData['step4']['company_name'] ?? 'Nama Perusahaan' }}
            </h2>
        </div>

        <!-- Card Wrapper -->
        <div class="bg-white mt-6 rounded-2xl shadow-md border border-gray-200 max-w-4xl mx-auto p-6">
            <!-- Header Logo & Job Info -->
            <div class="flex items-start gap-4">
                {{-- LOGO PERUSAHAAN --}}
                <div class="bg-[#E5F3FF] p-2 rounded-xl flex items-center justify-center w-16 h-16">
                    @if (!empty($jobData['step4']['company_logo_image']))
                        <img src="{{ asset('storage/' . ($jobData['step4']['company_logo_image'] ?? 'default-logo.png')) }}"
                            alt="Logo {{ $jobData['step4']['company_name'] ?? 'Perusahaan' }}"
                            class="object-cover rounded-md w-full h-full">
                    @else
                        <div class="text-sm font-bold text-blue-600 text-center">Logo</div>
                    @endif
                </div>


                <div class="text-left">
                    <h3 class="text-xl font-semibold text-gray-900">{{ $jobData['step1']['job_name'] ?? 'Job Name' }}</h3>
                    <p class="text-sm text-orange-500 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $jobData['step3']['location'] ?? 'Magersari' }}
                    </p>
                    <p class="text-sm text-gray-600 mt-2">
                        {{ $jobData['step4']['company_description'] ?? 'company description...' }}
                    </p>
                </div>
            </div>

            <!-- Badges -->
            <div class="flex justify-center gap-4 mt-6">
                <div class="bg-orange-500 text-white px-6 py-2 rounded-xl font-semibold">
                    {{ $jobData['step1']['job_type'] ?? 'Freelance' }}</div>
                <div class="bg-orange-500 text-white px-6 py-2 rounded-xl font-semibold">
                    {{ $jobData['step2']['place_work'] ?? 'Remote' }}</div>
                <div class="bg-orange-500 text-white px-6 py-2 rounded-xl font-semibold">
                    {{ $jobData['step2']['education_minimal'] ?? 'S1/D4' }}</div>
            </div>

            <!-- Salary -->
            <div class="text-center mt-4 text-gray-900 font-bold">
                Rp. {{ number_format($jobData['step3']['salary_minimal'] ?? 0, 0, ',', '.') }} - Rp.
                {{ number_format($jobData['step3']['maximum_salary'] ?? 0, 0, ',', '.') }}
            </div>

            <!-- Job Description -->
            <div class="mt-8">
                <h4 class="text-lg font-bold text-gray-800 mb-2">Job Description</h4>
                <p class="text-sm text-gray-700">{{ $jobData['step3']['job_description'] ?? 'Job description details...' }}
                </p>
            </div>

            <!-- Job Requirements -->
            <div class="mt-6">
                <h4 class="text-lg font-bold text-gray-800 mb-2">Job Requirements</h4>
                <p class="text-sm text-gray-700">
                    {{ $jobData['step3']['job_requirements'] ?? 'Job requirements details...' }}</p>
            </div>

            <!-- Company Info Table -->
            <div class="bg-yellow-50 p-4 rounded-xl mt-6">
                <table class="w-full text-sm text-left text-gray-700">
                    <tbody>
                        <tr>
                            <td class="font-semibold w-1/3">Experience Level</td>
                            <td>: {{ $jobData['step2']['experience_min'] ?? 'Less Than 1 Year' }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold">Age</td>
                            <td>: {{ $jobData['step2']['age'] ?? '18 - 30 Years' }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold">Category</td>
                            <td>: {{ $jobData['step1']['category_job'] ?? 'Design & Creative' }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold">Company Industry</td>
                            <td>: {{ $jobData['step4']['company_industry'] ?? 'Telecommunications' }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold">Address</td>
                            <td>: {{ $jobData['step4']['company_address'] ?? 'Mojokerto Street' }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold">Email</td>
                            <td>: {{ $jobData['step5']['email_company'] ?? 'mokerjobs@mail.com' }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold">Online Form</td>
                            <td>: {{ $jobData['step5']['social_media_company'] ?? 'https://forms.gle/abc1234EFGH5678' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-semibold">WhatsApp</td>
                            <td>: {{ $jobData['step5']['no_wa_company'] ?? '+6281234567890' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex justify-between items-center mt-8">
                <a href="{{ route('form_postjob_step5') }}"
                    class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-8 py-3 rounded-full">Previous</a>
                <form action="{{ route('submit_job') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-8 py-3 rounded-full">
                        Next
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
