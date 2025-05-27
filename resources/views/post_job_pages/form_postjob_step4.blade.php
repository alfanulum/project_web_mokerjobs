@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#F9F9F9] py-12 px-4 sm:px-6 lg:px-8 font-poppins">
        <div class="mb-10 pl-10">
            <img src="{{ asset('images/LOGO.png') }}" alt="moker.jobs" class="h-9 mb-6">
        </div>

        <!-- FORM WRAPPER -->
        <div class="max-w-3xl mx-auto p-4 sm:p-6 lg:p-8">

            <!-- FORM -->
            <form id="main-form" action="{{ route('store_postjob_step4') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <!-- Company Name -->
                <div>
                    <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Perusahaan</label>
                    <input type="text" id="company_name" name="company_name"
                        class="w-full px-5 py-3 border-2 border-orange-500 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-orange-600 transition"
                        placeholder="Cth: PT MokerJobs/CV MokerJobs/Toko MokerJobs"
                        value="{{ old('company_name', $step4['company_name'] ?? '') }}">
                </div>

                <!-- Description -->
                <div>
                    <label for="company_description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi
                        Perusahaan</label>
                    <textarea id="company_description" name="company_description" rows="4"
                        class="w-full px-5 py-3 border-2 border-orange-500 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-orange-600 transition"
                        placeholder="Cth: MokerJobs adalah perusahaan yang bergerak di bidang...">{{ old('company_description', $step4['company_description'] ?? '') }}</textarea>
                </div>

                <!-- Address -->
                <div>
                    <label for="company_address" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                        Perusahaan</label>
                    <input type="text" id="company_address" name="company_address"
                        class="w-full px-5 py-3 border-2 border-orange-500 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-orange-600 transition"
                        placeholder="Cth: Jl. Meri, Magersari, Mojokerto/Dsn. Magersari Ds. Magersari Kec. Magersari Kab. Mojokerto"
                        value="{{ old('company_address', $step4['company_address'] ?? '') }}">
                </div>

                <!-- Industry -->
                <div>
                    <label for="company_industry" class="block text-sm font-medium text-gray-700 mb-1">Industri</label>
                    <select id="company_industry" name="company_industry"
                        class="w-full px-5 py-3 border-2 border-orange-500 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-orange-600 transition text-gray-600">
                        <option value="" disabled selected>Pilih salah satu</option>
                        @foreach (['Telekomunikasi', 'Industri Garmen atau Tekstil', 'Kesehatan & Gaya Hidup', 'Organisasi Nonprofit', 'Energi & Lingkungan', 'Hukum & Konsultasi Hukum', 'Keuangan & Perbankan', 'Acara & Hiburan', 'Agribisnis', 'Konstruksi & Properti', 'Layanan Kesehatan', 'Startup & Teknologi Informasi', 'Transportasi & Logistik', 'Ritel & E-commerce', 'Produksi Makanan & Minuman', 'Media & Kreatif', 'Pariwisata & Perhotelan', 'Restoran & Kafe', 'Pendidikan & Pelatihan'] as $industry)
                            <option value="{{ $industry }}" @if (old('company_industry', $step4['company_industry'] ?? '') == $industry) selected @endif>
                                {{ $industry }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Website -->
                <div>
                    <label for="company_website" class="block text-sm font-medium text-gray-700 mb-1">Website / Media
                        Sosial</label>
                    <input type="url" id="company_website" name="company_website"
                        class="w-full px-5 py-3 border-2 border-orange-500 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-orange-600 transition"
                        placeholder="https://instagram.com/perusahaananda"
                        value="{{ old('company_website', $step4['company_website'] ?? '') }}">
                </div>

                <!-- Logo Upload -->
                <div>
                    <label for="company_logo" class="block text-sm font-medium text-gray-800 mb-2">Logo Perusahaan /
                        Usaha</label>
                    <label
                        class="flex flex-col items-center justify-center w-32 h-32 bg-gray-200 border-2 border-dashed border-black/60 rounded-md cursor-pointer hover:border-orange-600 transition">
                        @if (isset($step4['company_logo_image']))
                            <img src="{{ asset('storage/' . $step4['company_logo_image']) }}" alt="Company Logo"
                                class="w-full h-full object-cover">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-black" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 16V4m0 0l4 4m-4-4L8 8m12 8v4a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-4" />
                            </svg>
                        @endif
                        <input type="file" id="company_logo" name="company_logo" class="hidden" accept="image/*">
                    </label>
                    <span class="block mt-2 text-sm text-gray-500" id="file-name">
                        @if (isset($step4['company_logo_image']))
                            {{ basename($step4['company_logo_image']) }}
                        @else
                            Belum ada file yang dipilih
                        @endif
                    </span>
                    <p class="mt-1 text-xs text-gray-400">Format PNG, JPG, JPEG maksimal 2MB</p>
                </div>
            </form>
        </div>

        <!-- NAVIGATION BUTTONS -->
        <div class="max-w-8x1 mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="flex justify-between">
                <a href="{{ route('form_postjob_step3') }}"
                    class="bg-yellow-400 hover:bg-yellow-300 text-black px-8 py-4 rounded-full text-sm font-semibold transition">
                    ← Sebelumnya
                </a>
                <button type="submit" form="main-form"
                    class="bg-yellow-400 hover:bg-yellow-300 text-black px-8 py-4 rounded-full text-sm font-semibold transition">
                    Selanjutnya →
                </button>
            </div>
        </div>
    </div>

    <script>
        // Tampilkan nama file yang diunggah
        document.getElementById('company_logo')?.addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'Belum ada file yang dipilih';
            document.getElementById('file-name').textContent = fileName;
        });
    </script>
@endsection
