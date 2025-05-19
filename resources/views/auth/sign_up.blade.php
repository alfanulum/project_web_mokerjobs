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

    <!-- KANAN: Form Sign Up -->
    <div class="w-2/5 flex justify-center items-center bg-[#f7f7f7]">
      <div class="w-full max-w-md py-12 px-8 shadow-lg rounded-lg h-[80%] flex flex-col justify-center bg-white">

        <h2 class="text-2xl font-bold text-gray-800 text-center mb-">Sign up to Mokerjobs</h2>
        <p class="text-center text-gray-500 text-sm mb-6">Find Your Dream Job</p>

        <!-- Tab Line -->
        <div class="relative mb-6 text-center">
          <span class="absolute inset-x-0 top-1/2 border-t border-gray-300 transform -translate-y-1/2"></span>
          <span class="relative px-4 bg-white text-sm text-gray-500">Sign up now</span>
        </div>

        <form method="POST" action="{{ route('sign_up') }}" class="space-y-4">
          @csrf

          <div class="flex items-center border px-4 py-2 rounded-lg">
            <span class="mr-2 text-gray-400">
              <i class="fas fa-user"></i>
            </span>
            <input type="text" name="name" placeholder="Name" required class="w-full focus:outline-none" />
          </div>

          <div class="flex items-center border px-4 py-2 rounded-lg">
            <span class="mr-2 text-gray-400">
              <i class="fas fa-envelope"></i>
            </span>
            <input type="email" name="email" placeholder="E-mail" required class="w-full focus:outline-none" />
          </div>

          <div class="flex items-center border px-4 py-2 rounded-lg">
            <span class="mr-2 text-gray-400">
              <i class="fas fa-lock"></i>
            </span>
            <input type="password" name="password" placeholder="Password" required class="w-full focus:outline-none" />
          </div>

          <div class="flex items-center border px-4 py-2 rounded-lg">
            <span class="mr-2 text-gray-400">
              <i class="fas fa-lock"></i>
            </span>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="w-full focus:outline-none" />
          </div>

          <button type="submit"
            class="w-full bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg font-semibold transition duration-200">
            Sign Up
          </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
          Already have an account?
          <a href="{{ route('sign_in') }}" class="text-orange-500 font-semibold hover:underline">Sign In</a>
        </p>
      </div>
    </div>

  </div>
</div>
@endsection