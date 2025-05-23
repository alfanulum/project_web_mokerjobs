@extends('layouts.app')

@section('content')
    @include('components.navbar')

    {{-- Header & Bagian Pencarian --}}
    <section class="relative bg-[#fdfdfd] py-18 px-4 overflow-visible">

        {{-- Dekorasi Lingkaran Besar --}}
        <div
            class="absolute -right-20 top-15 w-[450px] h-[225px] rounded-t-full border-[60px] border-b-0 border-gray-200 opacity-30 z-0">
        </div>

        {{-- Judul dan Garis Putus-Putus --}}
        <div class="relative z-10 max-w-5xl mx-auto mb-10 px-4">
            <div class="flex flex-col md:flex-row items-center md:items-end justify-start gap-4">
                {{-- Judul dengan underline tipis biru --}}
                <h1
                    class="text-2xl md:text-3xl font-semibold text-gray-900 relative after:content-[''] after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-full">
                    Temukan <span class="text-orange-500 font-bold">Pekerjaan Impian</span> Anda di Sini
                </h1>

                {{-- Garis putus-putus oranye tebal dan besar --}}
                <div class="hidden md:flex flex-1 items-center gap-[6px]">
                    <div class="w-3 h-2 bg-orange-400 rounded-l-md"></div> {{-- Ujung kiri melengkung --}}
                    @for ($i = 0; $i < 12; $i++)
                        <div class="w-5 h-2 bg-orange-400"></div>
                    @endfor
                </div>
            </div>
        </div>

        {{-- Pencarian & Dropdown --}}
        <form action="{{ route('find_job') }}" method="GET"
            class="relative z-10 w-full flex flex-col md:flex-row items-center justify-center gap-4 mt-10 mb-6 max-w-4xl mx-auto">
            @include('components.search') {{-- Komponen input pencarian --}}
            @include('components.dropdown_location') {{-- Komponen dropdown lokasi --}}

            <button type="submit"
                class="w-full md:w-auto bg-orange-500 hover:bg-orange-600 focus-visible:bg-orange-600 active:bg-orange-700 text-white px-6 py-2 rounded-full transition duration-300">
                Cari
            </button>
        </form>

    </section>

    {{-- Konten Utama --}}
    <section class="px-4 py-12 bg-[#fdf5f2]">
        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Sidebar Filter --}}
            <aside class="w-full lg:w-1/4">
                <form id="filterForm" action="{{ route('find_job') }}" method="GET">
                    <h2 class="text-xl font-bold mb-4">Filter</h2>
                    <div class="space-y-4">
                        @include('components.filter_dropdown', [
                            'title' => 'Tipe Pekerjaan',
                            'name' => 'job_type',
                            'options' => $jobTypes,
                            'selected' => request('job_type'),
                        ])

                        @include('components.filter_dropdown', [
                            'title' => 'Jenis Kerja',
                            'name' => 'place_work',
                            'options' => $workTypes,
                            'selected' => request('place_work'),
                        ])

                        @include('components.filter_dropdown', [
                            'title' => 'Pendidikan Minimal',
                            'name' => 'education_minimal',
                            'options' => $educations,
                            'selected' => request('education_minimal'),
                        ])

                        @include('components.filter_dropdown', [
                            'title' => 'Kategori',
                            'name' => 'kategori', // Sesuaikan dengan controller
                            'options' => $categories,
                            'selected' => request('kategori'),
                        ])

                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="lokasi" value="{{ request('lokasi') }}">

                        <button type="submit" class="w-full bg-orange-500 text-white py-2 rounded-md">
                            Terapkan Filter
                        </button>

                        @if (request()->has('job_type') ||
                                request()->has('place_work') ||
                                request()->has('education_minimal') ||
                                request()->has('kategori'))
                            <a href="{{ route('find_job') }}" class="block w-full text-center text-orange-500 py-2">
                                Hapus Filter
                            </a>
                        @endif
                    </div>
                </form>
            </aside>

            {{-- Bagian Daftar Lowongan --}}
            <div class="w-full lg:w-3/4">
                <div class="flex justify-between items-center mb-4 flex-col sm:flex-row gap-2">
                    <h2 class="text-xl font-bold text-gray-800">Daftar Lowongan</h2>
                    <span class="text-sm text-gray-500">Hasil pencarian ({{ $jobs->total() }})</span>
                </div>

                {{-- Kartu Lowongan --}}
                <div class="flex flex-col gap-6 min-h-[400px]">
                    @forelse($jobs as $job)
                        @include('components.card_job', ['job' => $job])
                    @empty
                        <p class="text-center text-gray-500">Tidak ada lowongan ditemukan.</p>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div class="mt-8">
                    @include('components.pagination', ['paginator' => $jobs])
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    @include('components.footer')
@endsection
