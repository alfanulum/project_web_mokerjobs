@extends('layouts.app')

@section('title', 'Post a Job')

@section('content')
@include('components.navbar')

<section class="bg-gray-50 min-h-screen px-4 md:px-10 py-16 flex items-center justify-center">
  <div class="max-w-7xl w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

    <!-- Left Content -->
    <div class="space-y-6">
      <h1 class="text-4xl md:text-5xl font-bold leading-tight text-black">
        Post job vacancies <br>
        <span class="text-orange-500">quickly and easily</span>
      </h1>

      <p class="text-gray-700 text-lg leading-relaxed">
        Connect with tens of thousands of talents in Mojokerto through a modern, easy to use job platform making hiring and job searching faster than ever.
      </p>

      <a href="{{ route('form_postjob_1') }}"
        class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold px-8 py-3 rounded-full text-lg shadow transition-transform duration-200 hover:scale-105">
        Post a job
      </a>
    </div>

    <!-- Right Image -->
    <div class="flex justify-center">
      <img src="{{ asset('images/iconpostjob.png') }}" alt="Post Job Illustration"
        class="max-w-md w-full h-auto">
    </div>

  </div>
</section>
@endsection