@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#F9F9F9] py-12 px-4 sm:px-6 lg:px-8 font-poppins relative overflow-hidden">
        <div
            class="absolute top-[-100px] right-[-100px] w-[300px] h-[300px] rounded-full border-55 border-gray-300 opacity-25 pointer-events-none z-0">
        </div>
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
                        value="{{ old('company_name', $step4['company_name'] ?? '') }}" required>
                </div>

                <!-- Description -->
                <div>
                    <label for="company_description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi
                        Perusahaan</label>
                    <textarea id="company_description" name="company_description" rows="4"
                        class="w-full px-5 py-3 border-2 border-orange-500 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-orange-600 transition"
                        placeholder="Cth: MokerJobs adalah perusahaan yang bergerak di bidang..." required>{{ old('company_description', $step4['company_description'] ?? '') }}</textarea>
                </div>

                <!-- Address -->
                <div>
                    <label for="company_address" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                        Perusahaan</label>
                    <input type="text" id="company_address" name="company_address"
                        class="w-full px-5 py-3 border-2 border-orange-500 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-orange-600 transition"
                        placeholder="Cth: Jl. Meri, Magersari, Mojokerto/Dsn. Magersari Ds. Magersari Kec. Magersari Kab. Mojokerto"
                        value="{{ old('company_address', $step4['company_address'] ?? '') }}" required>
                </div>

                <!-- Industry -->
                <div>
                    <label for="company_industry" class="block text-sm font-medium text-gray-700 mb-1">Industri</label>
                    <select id="company_industry" name="company_industry"
                        class="w-full px-5 py-3 border-2 border-orange-500 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-orange-600 transition text-gray-600"
                        required>
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
                    <label class="block text-sm font-medium text-gray-800 mb-2">Logo Perusahaan / Usaha</label>

                    <!-- Preview Container -->
                    <div id="logo-preview-container" class="mb-4 {{ isset($step4['company_logo_image']) ? '' : 'hidden' }}">
                        <div
                            class="relative w-full h-full border-2 border-gray-300 rounded-md overflow-hidden bg-gray-100 flex items-center justify-center">
                            @if (isset($step4['company_logo_image']))
                                <img src="{{ asset('storage/' . $step4['company_logo_image']) }}" alt="Company Logo Preview"
                                    id="logo-preview-image" class="w-full h-full object-contain">
                            @else
                                <img src="" alt="Company Logo Preview" id="logo-preview-image"
                                    class="w-full h-full object-contain hidden">
                            @endif
                            <button type="button" id="remove-logo-btn"
                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Klik tombol X untuk menghapus logo</p>
                    </div>

                    <!-- Upload Button -->
                    <label id="upload-label"
                        class="flex flex-col items-center justify-center w-48 p-8 bg-gray-100 border-2 border-dashed border-gray-400 rounded-md cursor-pointer hover:border-orange-600 transition text-center {{ isset($step4['company_logo_image']) ? 'hidden' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="mt-1 text-sm text-gray-600">Unggah Logo</span>
                        <span class="text-xs text-gray-500">PNG, JPG, JPEG (max 2MB)</span>
                        <input type="file" id="company_logo" name="company_logo" class="hidden" accept="image/*">
                    </label>

                    <!-- Hidden field to track if logo was removed -->
                    <input type="hidden" id="logo_removed" name="logo_removed" value="0">
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
        document.addEventListener('DOMContentLoaded', function() {
            const logoInput = document.getElementById('company_logo');
            const logoPreviewContainer = document.getElementById('logo-preview-container');
            const logoPreviewImage = document.getElementById('logo-preview-image');
            const uploadLabel = document.getElementById('upload-label');
            const removeLogoBtn = document.getElementById('remove-logo-btn');
            const logoRemovedInput = document.getElementById('logo_removed');

            // Handle new image selection
            logoInput?.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    const file = e.target.files[0];

                    // Validate file size (2MB max)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran file terlalu besar. Maksimal 2MB.');
                        return;
                    }

                    // Validate file type
                    const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                    if (!validTypes.includes(file.type)) {
                        alert('Format file tidak didukung. Harap unggah gambar JPG, JPEG, atau PNG.');
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(event) {
                        logoPreviewImage.src = event.target.result;
                        logoPreviewImage.classList.remove('hidden');
                        logoPreviewContainer.classList.remove('hidden');
                        uploadLabel.classList.add('hidden');
                        logoRemovedInput.value = '0';
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Handle logo removal
            removeLogoBtn?.addEventListener('click', function() {
                // Clear the file input
                if (logoInput) {
                    logoInput.value = '';
                }

                // Hide preview and show upload button
                logoPreviewContainer.classList.add('hidden');
                uploadLabel.classList.remove('hidden');

                // Set flag that logo was removed
                logoRemovedInput.value = '1';

                // Remove the preview image
                logoPreviewImage.src = '';
                logoPreviewImage.classList.add('hidden');
            });

            // Initialize the preview if there's an existing image
            @if (isset($step4['company_logo_image']))
                logoPreviewContainer.classList.remove('hidden');
                uploadLabel.classList.add('hidden');
                logoRemovedInput.value = '0';
            @endif
        });
    </script>
@endsection
