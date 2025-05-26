@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#F9F9F9] py-12 px-4 sm:px-6 lg:px-8">
        <div class="mb-10 pl-10">
            <img src="{{ asset('images/LOGO.png') }}" alt="moker.jobs" class="h-9 mb-6">
        </div>


        <!-- FORM WRAPPER -->
        <div class="max-w-3xl mx-auto p-4 sm:p-6 lg:p-8">

            <!-- FORM -->
            <form id="main-form" method="POST" action="{{ route('store_step2') }}" class="space-y-10">
                @csrf

                <!-- Work Type -->
                <div class="text-center">
                    <label class="block font-bold text-xl mb-4 text-gray-700">Jenis Pekerjaan</label>
                    <div
                        class="flex justify-center bg-white rounded-full shadow-md overflow-hidden border border-orange-400 text-sm">
                        @foreach (['Remote', 'OnSite' => 'Di Kantor', 'Hybrid'] as $val => $label)
                            @php $value = is_string($val) ? $val : $label; @endphp
                            <label class="flex-1 text-center py-2 cursor-pointer hover:bg-yellow-50 transition">
                                <input type="radio" name="place_work" value="{{ $value }}" class="sr-only peer"
                                    {{ old('place_work', $step2['place_work'] ?? '') == $value ? 'checked' : '' }}>
                                <span class="peer-checked:text-orange-500 font-bold">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Gender -->
                <div class="text-center">
                    <label class="block font-bold text-xl mb-4 text-gray-700">Jenis Kelamin</label>
                    <div
                        class="flex justify-center bg-white rounded-full shadow-md overflow-hidden border border-orange-400 text-sm">
                        @foreach (['Man' => 'Laki-laki', 'Woman' => 'Perempuan', 'Man/Woman' => 'Laki-laki/Perempuan'] as $value => $label)
                            <label class="flex-1 text-center py-2 cursor-pointer hover:bg-yellow-50 transition">
                                <input type="radio" name="type_gender" value="{{ $value }}" class="sr-only peer"
                                    {{ old('type_gender', $step2['type_gender'] ?? '') == $value ? 'checked' : '' }}>
                                <span class="peer-checked:text-orange-500 font-bold">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Table-style Dropdowns -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @php
                        $selects = [
                            [
                                'label' => 'Pendidikan Minimal',
                                'name' => 'education_minimal',
                                'options' => ['SD-SMP', 'SMA/SMK', 'D1-D3', 'S1/D4', 'S2/Profesi'],
                            ],
                            [
                                'label' => 'Tingkat Pengalaman',
                                'name' => 'experience_minimal',
                                'options' => [
                                    'Tanpa Pengalaman',
                                    'Kurang dari 1 Tahun',
                                    '2 - 3 Tahun',
                                    '4 - 9 Tahun',
                                    '10+ Tahun',
                                ],
                            ],
                            [
                                'label' => 'Usia',
                                'name' => 'age',
                                'options' => [
                                    'Di bawah 18 Tahun',
                                    '18 - 30 Tahun',
                                    '18 - 35 Tahun',
                                    '41 - 60 Tahun',
                                    'Lebih dari 60 Tahun',
                                    'Semua Usia',
                                ],
                            ],
                        ];
                    @endphp

                    @foreach ($selects as $select)
                        <div class="bg-white p-4 rounded-xl shadow-md border border-orange-200">
                            <label class="block font-bold mb-2 text-gray-600">{{ $select['label'] }}</label>
                            <select name="{{ $select['name'] }}"
                                class="w-full rounded-md border border-gray-300 focus:ring-orange-400 focus:border-orange-400 text-sm px-2 py-1">
                                @foreach ($select['options'] as $opt)
                                    <option value="{{ $opt }}"
                                        {{ old($select['name'], $step2[$select['name']] ?? '') == $opt ? 'selected' : '' }}>
                                        {{ $opt }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                </div>
            </form>
        </div>

        <!-- NAVIGATION BUTTONS -->
        <div class="max-w-8x1 mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="flex justify-between">
                <a href="{{ route('form_postjob_step1') }}"
                    class="bg-yellow-400 hover:bg-yellow-300 text-black px-8 py-4 rounded-full text-sm font-semibold transition">
                    ← Sebelumnya
                </a>
                <button type="submit" form="main-form"
                    class="bg-yellow-400 hover:bg-yellow-300 text-black px-8 py-4 rounded-full text-sm font-semibold transition">
                    Selanjutnya →
                </button>
            </div>
        </div>
    </div>
@endsection
