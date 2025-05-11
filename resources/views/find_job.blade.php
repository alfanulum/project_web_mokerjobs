@extends('layouts.app')

@section('title', 'Find Jobs - MokerJobs')

@section('content')
@include('components.search_jobs') <!-- bagian pencarian -->

<div class="flex flex-col md:flex-row gap-6 px-4 py-8 max-w-7xl mx-auto">
  @include('components.job_filters') <!-- sidebar filter -->
  @include('components.job_listings') <!-- daftar pekerjaan -->
</div>

@include('components.pagination') <!-- navigasi halaman -->
@include('components.call_to_action') <!-- banner CTA di bawah -->
@endsection