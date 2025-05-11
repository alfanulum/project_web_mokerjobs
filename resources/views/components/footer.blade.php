<footer class="relative bg-[#FF7300] rounded-t-3xl overflow-hidden min-h-[300px]">
    <div class="max-w-6xl mx-auto px-6 py-16 flex flex-col md:flex-row justify-between items-center text-white gap-6">
        <!-- Text Content -->
        <div>
            <h2 class="text-4xl font-bold uppercase leading-tight">START YOUR<br>NEW JOB!</h2>
            <p class="mt-4 max-w-md text-sm">
                MokerJobs is here as a digital solution that aims to improve the job search system and recruitment process in Mojokerto City.
            </p>
        </div>

        <!-- Logo + Button Circle with Smooth Motion -->
        <div class="flex flex-col items-center space-y-6">
            <img src="{{ asset('images/LOGO1.png') }}" alt="moker.jobs logo" class="w-75 h-auto">

            <!-- Smooth Animated Up Arrow Button -->
            <a href="#top" class="mt-4 bg-yellow-400 rounded-full p-3 shadow-lg transform transition duration-300 ease-in-out hover:scale-110 hover:bg-yellow-300">
                <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                </svg>
            </a>

            <!-- Rounded Bottom Decoration -->
            <div class="bg-orange-200 h-6 w-full rounded-t-[30px] absolute bottom-0 left-0"></div>
        </div>
    </div>
</footer>