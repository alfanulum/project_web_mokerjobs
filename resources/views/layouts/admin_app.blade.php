<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') - {{ config('app.name', 'moker.jobs') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script> {{-- Pastikan Tailwind CSS dimuat --}}

    {{-- Jika Anda menggunakan Vite (default di Laravel baru) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Atau jika Anda menggunakan Laravel Mix atau link CSS manual --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <style>
        /* ... CSS kustom Anda ... */
    </style>
    @stack('styles') {{-- Untuk menambahkan CSS spesifik per halaman --}}
</head>

<body class="font-sans antialiased bg-slate-50"> {{-- Latar belakang utama seperti di gambar --}}
    <div class="flex min-h-screen">
        <aside class="w-64 bg-orange-500 text-white p-5 shadow-xl fixed top-0 left-0 h-full overflow-y-auto custom-scrollbar flex flex-col sidebar-animate z-40">
            {{-- ... Konten sidebar Anda ... --}}
        </aside>

        <div class="flex-1 ml-64"> {{-- ml-64 untuk memberi ruang bagi sidebar --}}
            <main class="py-8 px-4 sm:px-6 lg:px-8">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Tambahkan ini untuk memuat skrip yang di-push dari child view --}}
    @stack('scripts')

</body>

</html>

<body class="font-sans antialiased bg-slate-50"> {{-- Latar belakang utama seperti di gambar --}}
    <div class="flex min-h-screen">
        <aside class="w-64 bg-orange-500 text-white p-5 shadow-xl fixed top-0 left-0 h-full overflow-y-auto custom-scrollbar flex flex-col sidebar-animate z-40">
            <div class="mb-8 text-center pt-2">
                <a href="{{ route('admin.dashboard') }}" class="text-white text-2xl font-bold hover:opacity-80 transition-opacity duration-200 inline-block">
                    moker.jobs
                </a>
                <div class="w-20 h-0.5 bg-white opacity-70 mx-auto mt-2 rounded-full"></div>
            </div>

            <nav class="flex-grow space-y-2.5">
                <a href="{{ route('admin.dashboard') }}" id="nav-home"
                    class="nav-item group flex items-center space-x-3 px-4 py-2.5 rounded-lg text-sm font-medium text-orange-100 hover:bg-white hover:text-orange-500 hover:shadow-md transition-all duration-200 transform hover:scale-[1.02]">
                    <svg class="w-5 h-5 text-orange-200 group-hover:text-orange-500 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    <span>Home</span>
                </a>
                <a href="{{ route('admin.processed') }}" id="nav-processed"
                    class="nav-item group flex items-center space-x-3 px-4 py-2.5 rounded-lg text-sm font-medium text-orange-100 hover:bg-white hover:text-orange-500 hover:shadow-md transition-all duration-200 transform hover:scale-[1.02]">
                    <svg class="w-5 h-5 text-orange-200 group-hover:text-orange-500 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span>Processed</span>
                </a>
                <a href="{{ route('admin.approved') }}" id="nav-approved" 
                    class="nav-item group flex items-center space-x-3 px-4 py-2.5 rounded-lg text-sm font-medium text-orange-100 hover:bg-white hover:text-orange-500 hover:shadow-md transition-all duration-200 transform hover:scale-[1.02]">
                    <svg class="w-5 h-5 text-orange-200 group-hover:text-orange-500 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span>Approved</span>
                </a>
                <a href="{{ route('admin.rejected') }}" id="nav-rejected" 
                    class="nav-item group flex items-center space-x-3 px-4 py-2.5 rounded-lg text-sm font-medium text-orange-100 hover:bg-white hover:text-orange-500 hover:shadow-md transition-all duration-200 transform hover:scale-[1.02]">
                    <svg class="w-5 h-5 text-orange-200 group-hover:text-orange-500 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    <span>Rejected</span>
                </a>
                {{-- Tambahkan link navigasi admin lainnya di sini --}}
            </nav>

            @auth('admin') {{-- Sesuaikan dengan guard admin Anda --}}
            <div class="mt-4 border-t border-orange-400 border-opacity-50 pt-4">
                <form method="POST" action="{{ route('admin.logout') }}"> {{-- Pastikan route admin.logout ada --}}
                    @csrf
                    <button type="submit" class="group w-full flex items-center space-x-3 px-4 py-2.5 rounded-lg text-sm font-medium text-orange-100 hover:bg-white hover:text-orange-500 hover:shadow-md transition-all duration-200">
                        <svg class="w-5 h-5 text-orange-200 group-hover:text-orange-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
            @endauth
        </aside>

        <div class="flex-1 ml-64"> {{-- ml-64 untuk memberi ruang bagi sidebar --}}
            <main class="py-8 px-4 sm:px-6 lg:px-8">
                @yield('content')
            </main>
        </div>
    </div>

    
   
</body>

</html>