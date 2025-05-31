    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Admin Panel') - {{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- Jika Anda menggunakan Vite (default di Laravel baru) --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- Atau jika Anda menggunakan Laravel Mix atau link CSS manual --}}
        {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
        {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

        @stack('styles') {{-- Untuk menambahkan CSS spesifik per halaman --}}
    </head>

    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen">
            <nav class="bg-white shadow-md">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <div class="flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="font-semibold text-xl text-gray-800"> {{-- Pastikan route admin.dashboard ada --}}
                                Admin Panel
                            </a>
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:bg-gray-200 hover:text-black px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                                <a href="{{ route('admin.processed') }}" class="text-gray-700 hover:bg-gray-200 hover:text-black px-3 py-2 rounded-md text-sm font-medium">Processed Jobs</a>
                                {{-- Tambahkan link navigasi admin lainnya di sini --}}
                            </div>
                        </div>
                        <div class="hidden md:block">
                            {{-- Tombol Logout (Contoh) --}}
                            @auth('admin') {{-- Sesuaikan dengan guard admin Anda --}}
                            <form method="POST" action="{{ route('admin.logout') }}"> {{-- Pastikan route admin.logout ada --}}
                                @csrf
                                <button type="submit" class="text-gray-700 hover:bg-gray-200 hover:text-black px-3 py-2 rounded-md text-sm font-medium">
                                    Logout
                                </button>
                            </form>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            @hasSection('header')
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        @yield('header')
                    </h2>
                </div>
            </header>
            @endif

            <main class="py-8">
                @yield('content')
            </main>
        </div>
        @stack('scripts') {{-- Untuk menambahkan JavaScript spesifik per halaman --}}
    </body>

    </html>