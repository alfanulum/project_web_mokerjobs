@php
$navLinks = [
    ['name' => 'Overview', 'route' => 'overview'],
    ['name' => 'Cari Loker', 'route' => 'find_job'],
    ['name' => 'Pasang Loker', 'route' => 'post_job'],
];
@endphp

<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white shadow-sm transition-all duration-300 px-4 md:px-6 py-5">
    <div class="relative max-w-7xl mx-auto flex items-center justify-between">
        <!-- Logo - Kiri -->
        <a href="{{ route('overview') }}" class="flex items-center space-x-2 z-20">
            <img src="{{ asset('images/LOGO.png') }}" alt="MokerJobs Logo"
                class="h-10 w-auto transition-transform duration-200 hover:scale-105">
        </a>

        <!-- Nav di tengah halaman -->
        <div class="absolute left-1/2 transform -translate-x-1/2 hidden md:flex space-x-6 text-sm font-medium">
            @foreach ($navLinks as $link)
                <a href="{{ route($link['route']) }}"
                    class="relative transition duration-300 pb-1
                        {{ request()->routeIs($link['route']) 
                            ? 'text-black after:scale-x-100' 
                            : 'text-gray-600 hover:text-black hover:after:scale-x-100' }}
                        after:absolute after:left-0 after:-bottom-0.5 after:h-0.5 after:bg-black after:w-full after:transform after:scale-x-0 after:transition-transform after:duration-300 after:origin-left">
                    {{ $link['name'] }}
                </a>
            @endforeach
        </div>

        <!-- Mobile Hamburger - Kanan -->
        <button @click="open = !open"
            class="md:hidden p-2 rounded-md text-gray-700 focus:outline-none z-20 transition-transform duration-200 hover:bg-gray-100">
            <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="open" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        x-cloak
        class="md:hidden px-4 pt-4 pb-2 space-y-2 text-sm bg-white shadow-sm border-t">
        @foreach ($navLinks as $link)
        <a href="{{ route($link['route']) }}"
            class="block px-3 py-2 rounded-md transition {{ request()->routeIs($link['route']) 
                ? 'text-black font-semibold bg-gray-100' 
                : 'text-gray-700 hover:bg-gray-100 hover:font-medium' }}">
            {{ $link['name'] }}
        </a>
        @endforeach
    </div>
</nav>
