@extends('layouts.app')

@section('content')
<div class="min-h-screen w-full flex items-center justify-center bg-white m-0 p-0">
  <div class="flex w-full h-screen">

    <!-- KIRI: Gambar atau Branding -->
    <div class="w-3/5 bg-orange-500 flex flex-col justify-center items-center text-white relative">

      <!-- LINGKARAN HIASAN DI BELAKANG GAMBAR (PEPET KIRI, UKURAN LEBIH BESAR) -->
      <div class="absolute left-[-100px] bottom-0 w-[400px] h-[220px] rounded-t-full border-[75px] border-b-0 border-white opacity-20 z-0"></div>

      <!-- GAMBAR -->
      <img src="{{ asset('images/sign_image.svg') }}" alt="Job Search" class="w-145 mb-6 relative z-10">
    </div>

<!-- KANAN: Form Login -->
<div class="w-2/5 flex justify-center items-center bg-white">
  <div class="w-full max-w-md py-12 px-8 bg-white shadow-lg rounded-lg h-[80%] flex flex-col justify-center relative">

    <!-- TANDA PANAH BACK -->
    <a href="{{ route('overview') }}"
      class="absolute top-4 left-4 text-orange-500 hover:text-orange-600 transition duration-200 transform hover:scale-105">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M15 19l-7-7 7-7" />
      </svg>
    </a>

    <h2 class="text-2xl font-bold text-gray-800 text-center mb-2">Sign in to Mokerjobs</h2>
    <p class="text-center text-gray-500 text-sm mb-6">Find Your Dream Job</p>

    <form method="POST" action="{{ route('sign_in') }}" class="space-y-4">
      @csrf

      <input type="email" name="email" placeholder="E-mail" required autofocus
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400" />

      <input type="password" name="password" placeholder="Password" required
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400" />

      <div class="flex justify-between items-center">
        <div class="flex items-center">
          <input type="checkbox" name="remember" id="remember" class="mr-2">
          <label for="remember" class="text-sm text-gray-600">Remember me</label>
        </div>
        <a href="#" class="text-sm text-orange-500 hover:underline">Forgot Password?</a>
      </div>

      <button type="submit"
        class="w-full bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg font-semibold transition duration-200">
        Sign In
      </button>
    </form>

    <p class="text-center text-sm text-gray-600 mt-4">
      Don’t have an account?
      <a href="{{ route('sign_up') }}" class="text-orange-500 font-semibold hover:underline">Sign Up</a>
    </p>
  </div>
</div>


  </div>
</div>
@endsection