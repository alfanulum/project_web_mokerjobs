@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen flex items-center justify-center p-5">
        <div class="bg-white rounded-lg shadow-md w-full max-w-4xl flex flex-col min-h-[750px]">
            <!-- Header -->
            <div class="flex justify-between items-center p-5 border-b border-gray-100">
                <img src="{{ asset('images/LOGO.png') }}" alt="MokerJobs Logo" class="h-10" />
            </div>

            <form method="POST" action="{{ route('store_step3') }}"
                class="flex-grow px-4 py-12 overflow-auto max-w-[1000px] mx-auto" x-data="{
                    open: false,
                    selected: '{{ old('location', $step3['location'] ?? '') }}',
                    selectedLabel() {
                        return this.selected === '' ? 'Pilih Lokasi' : this.selected;
                    },
                    selectLocation(value) {
                        this.selected = value;
                        this.open = false;
                        $refs.hiddenLokasi.value = value;
                    }
                }" novalidate>
                @csrf

                <!-- Job Description -->
                <div class="mb-8">
                    <label for="job_description" class="block text-gray-700 font-semibold mb-2">Job Description</label>
                    <textarea id="job_description" name="job_description" class="w-full border border-orange-400 rounded-lg px-3 py-2 h-32"
                        placeholder="Enter job description" required>{{ old('job_description', $step3['job_description'] ?? '') }}</textarea>
                    @error('job_description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Job Requirements -->
                <div class="mb-8">
                    <label for="job_requirements" class="block text-gray-700 font-semibold mb-2">Job Requirements</label>
                    <textarea id="job_requirements" name="job_requirements"
                        class="w-full border border-orange-400 rounded-lg px-3 py-2 h-32" placeholder="Enter job requirements" required>{{ old('job_requirements', $step3['job_requirements'] ?? '') }}</textarea>
                    @error('job_requirements')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location Dropdown -->
                <div class="mb-8 relative">
                    <label class="block text-gray-700 font-semibold mb-2">Location</label>
                    <div @click="open = !open"
                        class="flex items-center border border-orange-400 px-4 py-2 rounded-full cursor-pointer bg-white relative z-20">
                        <img src="{{ asset('images/iconlokasi.png') }}" class="w-4 h-5 mr-2" alt="Location Icon">
                        <span class="text-gray-700" x-text="selectedLabel()"></span>
                        <svg class="ml-auto w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.66a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>

                    <input type="hidden" name="location" x-ref="hiddenLokasi" :value="selected" required>

                    @error('location')
                        <p class="text-red-600 text-sm mt-1">Location must be selected.</p>
                    @enderror

                    <!-- Dropdown Content -->
                    <div x-show="open" @click.outside="open = false" x-transition
                        class="absolute mt-2 w-[350px] bg-white rounded-xl shadow-xl z-50 p-4 space-y-4 max-h-96 overflow-y-auto">
                        <!-- Kota Mojokerto -->
                        <div>
                            <div class="bg-orange-100 px-3 py-2 rounded-t-md">
                                <h3 class="text-sm font-bold text-gray-800">Kota Mojokerto</h3>
                            </div>
                            <div class="bg-orange-50 px-3 py-2 space-y-2">
                                <label class="flex items-center text-sm cursor-pointer">
                                    <input type="radio" name="lokasi_radio" value="Prajurit Kulon" class="mr-2"
                                        @click="selectLocation('Prajurit Kulon')"
                                        {{ old('location', $step3['location'] ?? '') == 'Prajurit Kulon' ? 'checked' : '' }}>
                                    Prajurit Kulon
                                </label>
                                <label class="flex items-center text-sm cursor-pointer">
                                    <input type="radio" name="lokasi_radio" value="Magersari" class="mr-2"
                                        @click="selectLocation('Magersari')"
                                        {{ old('location', $step3['location'] ?? '') == 'Magersari' ? 'checked' : '' }}>
                                    Magersari
                                </label>
                            </div>
                        </div>

                        <!-- Kabupaten Mojokerto -->
                        <div>
                            <div class="bg-orange-100 px-3 py-2 rounded-t-md mt-4">
                                <h3 class="text-sm font-bold text-gray-800">Kabupaten Mojokerto</h3>
                            </div>
                            <div class="bg-orange-50 px-3 py-2 grid grid-cols-2 gap-2 text-sm">
                                @php
                                    $kabupatenLocations = [
                                        'Dawarblandong',
                                        'Kemlagi',
                                        'Jetis',
                                        'Gedeg',
                                        'Mojoanyar',
                                        'Sooko',
                                        'Bangsal',
                                        'Puri',
                                        'Trowulan',
                                        'Jatirejo',
                                        'Dlanggu',
                                        'Mojosari',
                                        'Pungging',
                                        'Kutorejo',
                                        'Ngoro',
                                        'Gondang',
                                        'Trawas',
                                        'Pacet',
                                    ];
                                @endphp
                                @foreach ($kabupatenLocations as $loc)
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="lokasi_radio" value="{{ $loc }}"
                                            class="mr-2" @click="selectLocation('{{ $loc }}')"
                                            {{ old('location', $step3['location'] ?? '') == $loc ? 'checked' : '' }}>
                                        {{ $loc }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Salary Range -->
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div>
                        <label for="salary_minimal" class="block text-gray-700 font-semibold mb-1">Minimum Salary
                            (Rp)</label>
                        <input id="salary_minimal" type="number" name="salary_minimal"
                            class="w-full border border-orange-400 rounded-lg px-3 py-2" placeholder="Enter minimum salary"
                            value="{{ old('salary_minimal', $step3['salary_minimal'] ?? '') }}">
                        @error('salary_minimal')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="maximum_salary" class="block text-gray-700 font-semibold mb-1">Maximum Salary
                            (Rp)</label>
                        <input id="maximum_salary" type="number" name="maximum_salary"
                            class="w-full border border-orange-400 rounded-lg px-3 py-2" placeholder="Enter maximum salary"
                            value="{{ old('maximum_salary', $step3['maximum_salary'] ?? '') }}">
                        @error('maximum_salary')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Footer: tombol Previous & Next -->
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
    </div>

    <script>
        function goBack() {
            window.location.href = "{{ route('form_postjob_step2') }}";
        }
    </script>
@endsection
