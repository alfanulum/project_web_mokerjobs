@extends('layouts.app')

@section('content')

@include('components.navbar')

{{-- Header & Search Section --}}
<section class="relative bg-[#fdfdfd] py-18 px-4 overflow-visible">

  {{-- Dekorasi Lingkaran Besar --}}
  <div class="absolute -right-20 top-15 w-[450px] h-[225px] rounded-t-full border-[60px] border-b-0 border-gray-200 opacity-30 z-0"></div>

  {{-- Judul dan Garis Putus-Putus --}}
  <div class="relative z-10 max-w-5xl mx-auto mb-10 px-4">
    <div class="flex flex-col md:flex-row items-center md:items-end justify-start gap-4">
      {{-- Judul dengan underline tipis biru --}}
      <h1 class="text-2xl md:text-3xl font-semibold text-gray-900 relative after:content-[''] after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-full">
        Find Your <span class="text-orange-500 font-bold">Dream Job</span> Here
      </h1>

      {{-- Garis putus-putus oranye tebal dan besar --}}
      <div class="hidden md:flex flex-1 items-center gap-[6px]">
        <div class="w-3 h-2 bg-orange-400 rounded-l-md"></div> {{-- Ujung kiri melengkung --}}
        @for($i = 0; $i < 12; $i++)
          <div class="w-5 h-2 bg-orange-400">
      </div>
      @endfor
    </div>
  </div>
  </div>

  {{-- Search & Dropdown --}}
  <div class="relative z-20 flex flex-col md:flex-row items-center justify-center gap-4 mt-10 mb-6 max-w-4xl mx-auto">
    @include('components.search')
    @include('components.dropdown_location')

    <button class="w-full md:w-auto bg-orange-500 text-white px-6 py-2 rounded-full hover:bg-orange-600">
      Cari
    </button>
  </div>

</section>

{{-- Main Content --}}
<section class="px-4 py-12 bg-[#fdf5f2]">
  <div class="flex flex-col lg:flex-row gap-8">

    {{-- Filter Sidebar --}}
    <aside class="w-full lg:w-1/4">
      <h2 class="text-xl font-bold mb-4">Filter</h2>

      <div class="space-y-4">

        @include('components.filter_dropdown', [
        'title' => 'Job Type',
        'name' => 'job_type',
        'options' => $jobTypes
        ])

        @include('components.filter_dropdown', [
        'title' => 'Work Type',
        'name' => 'work_type',
        'options' => $workTypes
        ])

        @include('components.filter_dropdown', [
        'title' => 'Education',
        'name' => 'education',
        'options' => $educations
        ])

        @include('components.filter_dropdown', [
        'title' => 'Category',
        'name' => 'category',
        'options' => $categories
        ])

      </div>
    </aside>

    {{-- Job Section --}}
    <div class="w-full lg:w-3/4">
      <div class="flex justify-between items-center mb-4 flex-col sm:flex-row gap-2">
        <h2 class="text-xl font-bold text-gray-800">Daftar Lowongan</h2>
        <span class="text-sm text-gray-500">Hasil pencarian ({{ $jobs->total() }})</span>
      </div>

      {{-- Card Job --}}
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