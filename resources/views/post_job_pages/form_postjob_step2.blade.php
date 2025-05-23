@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-lg shadow-md w-full max-w-7xl flex flex-col min-h-[750px] mx-auto mt-10">
        <!-- Header: logo kiri, back kanan -->
        <div class="flex justify-between items-center p-5 border-b border-gray-100 relative">
            <img src="{{ asset('images/LOGO.png') }}" alt="MokerJobs Logo" class="h-10" />
            <button type="button" onclick="goBack()"
                class="text-yellow-500 text-2xl font-bold hover:text-yellow-600 transition">←</button>

            <div
                class="absolute right-10 bottom-[650px] w-[450px] h-[225px] rounded-b-full border-[60px] border-t-0 border-gray-200 opacity-30 z-0">
            </div>
        </div>

        <form class="flex-grow px-4 py-12 overflow-auto max-w-[1000px] mx-auto" method="POST"
            action="{{ route('store_step2') }}">
            @csrf

            <!-- Work type -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2 text-center">Work type</label>
                <div class="flex justify-center items-center border border-orange-400 rounded-full overflow-hidden">
                    <label class="flex items-center justify-center gap-2 flex-1 py-2 cursor-pointer relative">
                        <input type="radio" name="place_work" value="Remote" class="accent-orange-400 peer sr-only"
                            {{ old('place_work', $step2['place_work'] ?? '') == 'Remote' ? 'checked' : '' }} />
                        <span class="peer-checked:text-yellow-500 font-semibold">Remote</span>
                        <span class="hidden md:block absolute right-0 top-1/4 h-1/2 border-r border-orange-400"></span>
                    </label>

                    <label class="flex items-center justify-center gap-2 flex-1 py-2 cursor-pointer relative">
                        <input type="radio" name="place_work" value="OnSite" class="accent-orange-400 peer sr-only"
                            {{ old('place_work', $step2['place_work'] ?? '') == 'OnSite' ? 'checked' : '' }} />
                        <span class="peer-checked:text-yellow-500 font-semibold">On Site</span>
                        <span class="hidden md:block absolute right-0 top-1/4 h-1/2 border-r border-orange-400"></span>
                    </label>

                    <label class="flex items-center justify-center gap-2 flex-1 py-2 cursor-pointer">
                        <input type="radio" name="place_work" value="Hybrid" class="accent-orange-400 peer sr-only"
                            {{ old('place_work', $step2['place_work'] ?? '') == 'Hybrid' ? 'checked' : '' }} />
                        <span class="peer-checked:text-yellow-500 font-semibold">Hybrid</span>
                    </label>
                </div>
            </div>

            <!-- Gender -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2 text-center">Gender</label>
                <div class="flex justify-center items-center border border-orange-400 rounded-full overflow-hidden">
                    <label class="flex items-center justify-center gap-2 flex-1 py-2 cursor-pointer relative">
                        <input type="radio" name="type_gender" value="Man" class="accent-orange-400 peer sr-only"
                            {{ old('type_gender', $step2['type_gender'] ?? '') == 'Man' ? 'checked' : '' }} />
                        <span class="peer-checked:text-yellow-500 font-semibold">Man</span>
                        <span class="hidden md:block absolute right-0 top-1/4 h-1/2 border-r border-orange-400"></span>
                    </label>

                    <label class="flex items-center justify-center gap-2 flex-1 py-2 cursor-pointer relative">
                        <input type="radio" name="type_gender" value="Woman" class="accent-orange-400 peer sr-only"
                            {{ old('type_gender', $step2['type_gender'] ?? '') == 'Woman' ? 'checked' : '' }} />
                        <span class="peer-checked:text-yellow-500 font-semibold">Woman</span>
                        <span class="hidden md:block absolute right-0 top-1/4 h-1/2 border-r border-orange-400"></span>
                    </label>

                    <label class="flex items-center justify-center gap-2 flex-1 py-2 cursor-pointer">
                        <input type="radio" name="type_gender" value="Man/Woman" class="accent-orange-400 peer sr-only"
                            {{ old('type_gender', $step2['type_gender'] ?? '') == 'Man/Woman' ? 'checked' : '' }} />
                        <span class="peer-checked:text-yellow-500 font-semibold">Man/Woman</span>
                    </label>
                </div>
            </div>

            <!-- Dropdowns -->
            <div class="grid grid-cols-3 gap-4 border border-orange-400 rounded-lg p-4 mb-8">
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Minimum education</label>
                    <select name="education_minimal" class="w-full border border-gray-300 rounded px-3 py-2">
                        <option value="High School"
                            {{ old('education_minimal', $step2['education_minimal'] ?? '') == 'High School' ? 'selected' : '' }}>
                            High School</option>
                        <option value="Diploma"
                            {{ old('education_minimal', $step2['education_minimal'] ?? '') == 'Diploma' ? 'selected' : '' }}>
                            Diploma</option>
                        <option value="Bachelor's"
                            {{ old('education_minimal', $step2['education_minimal'] ?? '') == "Bachelor's" ? 'selected' : '' }}>
                            Bachelor's</option>
                        <option value="Master's"
                            {{ old('education_minimal', $step2['education_minimal'] ?? '') == "Master's" ? 'selected' : '' }}>
                            Master's</option>
                        <option value="Doctorate"
                            {{ old('education_minimal', $step2['education_minimal'] ?? '') == 'Doctorate' ? 'selected' : '' }}>
                            Doctorate</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Experience Level</label>
                    <select name="experience_min" class="w-full border border-gray-300 rounded px-3 py-2">
                        <option value="0-1 Years"
                            {{ old('experience_min', $step2['experience_min'] ?? '') == '0-1 Years' ? 'selected' : '' }}>
                            0-1 Years</option>
                        <option value="2-3 Years"
                            {{ old('experience_min', $step2['experience_min'] ?? '') == '2-3 Years' ? 'selected' : '' }}>
                            2-3 Years</option>
                        <option value="4-5 Years"
                            {{ old('experience_min', $step2['experience_min'] ?? '') == '4-5 Years' ? 'selected' : '' }}>
                            4-5 Years</option>
                        <option value="5+ Years"
                            {{ old('experience_min', $step2['experience_min'] ?? '') == '5+ Years' ? 'selected' : '' }}>
                            5+ Years</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Age</label>
                    <select name="age" class="w-full border border-gray-300 rounded px-3 py-2">
                        <option value="18-25" {{ old('age', $step2['age'] ?? '') == '18-25' ? 'selected' : '' }}>18-25
                        </option>
                        <option value="26-35" {{ old('age', $step2['age'] ?? '') == '26-35' ? 'selected' : '' }}>26-35
                        </option>
                        <option value="36-45" {{ old('age', $step2['age'] ?? '') == '36-45' ? 'selected' : '' }}>36-45
                        </option>
                        <option value="46+" {{ old('age', $step2['age'] ?? '') == '46+' ? 'selected' : '' }}>46+
                        </option>
                    </select>
                </div>
            </div>

            <div class="flex justify-between px-4 py-5 border-t border-gray-200 mt-8">
                <button type="button" onclick="goBack()"
                    class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-2 rounded-full">
                    Previous
                </button>
                <button type="submit"
                    class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-2 rounded-full">
                    Next
                </button>
            </div>
        </form>
    </div>

    <script>
        function goBack() {
            window.location.href = "{{ route('form_postjob_step1') }}";
        }
    </script>
@endsection
