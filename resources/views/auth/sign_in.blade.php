@extends('layouts.app')

@section('content')
<div class="min-h-screen w-full flex items-center justify-center bg-white m-0 p-0">
  <div class="flex w-full h-screen">

    <!-- KIRI: Gambar atau Branding -->
    <div class="w-3/5 bg-orange-500 flex flex-col justify-center items-center text-white relative">

      <!-- LINGKARAN HIASAN DI BELAKANG GAMBAR (PEPET KIRI, UKURAN LEBIH BESAR) -->
      <div class="absolute left-[-100px] bottom-0 w-[400px] h-[220px] rounded-t-full border-[75px] border-b-0 border-white opacity-20 z-0"></div>

      <!-- GAMBAR -->
      <img src="{{ asset('images/sign_image.png') }}" alt="Job Search" class="w-145 mb-6 relative z-10">
    </div>

    <!-- KANAN: Form Login -->
    <div class="w-2/5 flex justify-center items-center bg-white">
      <div class="w-full max-w-md py-12 px-8 bg-white shadow-lg rounded-lg h-[80%] flex flex-col justify-center">

        <h2 class="text-2xl font-bold text-gray-800 text-center mb-2">Sign in to Mokerjobs</h2>
        <p class="text-center text-gray-500 text-sm mb-6">Find Your Dream Job</p>

        <!-- Login Sosial -->
        <div class="flex justify-center space-x-4 mb-6">
          <a href="#" class="flex items-center px-4 py-2 border rounded-lg shadow-sm hover:bg-gray-100 text-sm">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5 mr-2">
            Google
          </a>
          <a href="#" class="flex items-center px-4 py-2 border rounded-lg shadow-sm hover:bg-gray-100 text-sm">
            <img src="https://www.svgrepo.com/show/157818/facebook.svg" alt="Facebook" class="w-5 h-5 mr-2">
            Facebook
          </a>
          <a href="#" class="flex items-center px-4 py-2 border rounded-lg shadow-sm hover:bg-gray-100 text-sm">
            <img src="https://www.svgrepo.com/show/138936/linkedin.svg" alt="LinkedIn" class="w-5 h-5 mr-2">
            LinkedIn
          </a>
        </div>

        <div class="relative mb-4 text-center">
          <span class="absolute inset-x-0 top-1/2 border-t border-gray-300 transform -translate-y-1/2"></span>
          <span class="relative px-3 bg-white text-sm text-gray-500">Or with Email</span>
        </div>

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