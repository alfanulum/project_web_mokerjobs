@extends('layouts.app')

@section('content')

<div class="min-h-screen flex flex-col items-center justify-center p-4">

    <div class="bg-white p-8 sm:p-10 rounded-xl shadow-2xl w-full max-w-lg">

        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Admin Login</h2>
            <p class="text-gray-500 mt-2">Silakan masuk untuk mengakses panel admin.</p>
        </div>

        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
            <strong class="font-bold">Oops!</strong>
            <ul class="mt-1 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif  

        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-150"
                    placeholder="nama@contoh.com">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-150"
                    placeholder="Masukkan password Anda">
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember"
                        class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded cursor-pointer">
                    <label for="remember" class="ml-2 block text-sm text-gray-700 cursor-pointer">
                        Ingat saya
                    </label>
                </div>
                <!-- <a href="#" class="text-sm text-orange-600 hover:text-orange-500 hover:underline">
                        Lupa Password?
                    </a> -->
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition duration-150 ease-in-out transform hover:scale-[1.01]">
                    Login
                </button>
            </div>
        </form>

        <!-- <p class="text-center text-sm text-gray-600 mt-8">
                Kembali ke <a href="{{ route('overview') }}" class="text-orange-600 font-semibold hover:underline">Halaman Utama</a>
            </p> -->

    </div>
</div>
@endsection