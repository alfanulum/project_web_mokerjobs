<footer class="relative bg-[#FF7300] rounded-t-3xl overflow-hidden min-h-[300px]">
    <div class="max-w-6xl mx-auto px-6 py-16 flex flex-col md:flex-row justify-between items-center text-white gap-6">
        <!-- Konten Teks -->
        <div>
            <h2 class="text-4xl font-bold uppercase leading-tight">MULAI PEKERJAAN<br>BARU ANDA!</h2>
            <p class="mt-4 max-w-md text-sm">
                MokerJobs hadir sebagai solusi digital yang bertujuan untuk meningkatkan sistem pencarian kerja dan
                proses rekrutmen di Kota Mojokerto.
            </p>
        </div>

        <!-- Logo + Tombol Lingkaran dengan Animasi Halus -->
        <div class="flex flex-col items-center space-y-6">
            <img src="{{ asset('images/LOGO1.png') }}" alt="logo moker.jobs" class="w-75 h-auto">

            <!-- Tombol Panah Atas dengan Animasi Halus -->
            <a href="#top"
                class="mt-4 bg-yellow-400 rounded-full p-3 shadow-lg transform transition duration-300 ease-in-out hover:scale-110 hover:bg-yellow-300"
                aria-label="Kembali ke atas halaman">
                <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                </svg>
            </a>

            <!-- Dekorasi Bundar Bawah -->
            <div class="bg-orange-200 h-6 w-full rounded-t-[30px] absolute bottom-0 left-0"></div>
        </div>
    </div>
</footer>
