@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#F9F9F9] py-6 px-4 sm:px-6 lg:px-8">
        <div class="mb-10 pl-10">
            <img src="{{ asset('images/LOGO.png') }}" alt="moker.jobs" class="h-9 mb-6">
        </div>

        
        <div class="max-w-3xl mx-auto p-6">

            <!-- Header Card -->
            <div
                class="bg-gradient-to-r from-orange-500 to-yellow-400 text-white rounded-2xl p-6 mb-8 shadow-md flex items-start justify-between">
                <div class="flex-1">
                    <h2 class="text-2xl font-semibold">Verifikasi Perusahaan Anda</h2>
                    <p class="text-sm mt-2">Pastikan bisnis Anda telah diverifikasi untuk membangun kepercayaan, membuka
                        fitur tambahan, dan meningkatkan kredibilitas di berbagai platform.</p>
                </div>
                <div class="flex-shrink-0">
                    <img src="{{ asset('images/checkmark.png') }}" alt="Terverifikasi"
                        class="w-16 h-16 sm:w-20 sm:h-20 object-contain">
                </div>
            </div>

            <!-- Formulir -->
            <form id="jobForm" method="POST" action="{{ route('store_postjob_step5') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email_company" class="block text-sm font-semibold text-gray-800 mb-2">Email
                        Perusahaan</label>
                    <input type="email" name="email_company" id="email_company" placeholder="contoh: mokerjobs@mail.com"
                        class="w-full px-5 py-3 border-2 border-orange-400 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500"
                        value="{{ old('email_company', $step5['email_company'] ?? '') }}">
                    <p class="text-xs text-gray-500 mt-1">Gunakan email perusahaan untuk mendapatkan tanda verifikasi.</p>
                    @error('email_company')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label for="no_wa_company" class="block text-sm font-semibold text-gray-800 mb-2">Nomor WhatsApp /
                        Telepon Perusahaan</label>
                    <input type="tel" name="no_wa_company" id="no_wa_company" placeholder="contoh: +6281234567890"
                        class="w-full px-5 py-3 border-2 border-orange-400 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500"
                        value="{{ old('no_wa_company', $step5['no_wa_company'] ?? '') }}">
                    @error('no_wa_company')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Online -->
                <div>
                    <label for="social_media_company" class="block text-sm font-semibold text-gray-800 mb-2">Formulir
                        Online</label>
                    <input type="url" name="social_media_company" id="social_media_company"
                        placeholder="contoh: https://forms.gle/abcd1234EFGH5678"
                        class="w-full px-5 py-3 border-2 border-orange-400 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500"
                        value="{{ old('social_media_company', $step5['social_media_company'] ?? '') }}">
                    @error('social_media_company')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tenggat Waktu -->
                <div>
                    <label for="delivery_limit" class="block text-sm font-semibold text-gray-800 mb-2">Tenggat Waktu
                        Lamaran</label>
                    <input type="date" name="delivery_limit" id="delivery_limit"
                        class="w-full px-5 py-3 border-2 border-orange-400 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500"
                        value="{{ old('delivery_limit', $step5['delivery_limit'] ?? '') }}">
                    @error('delivery_limit')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </form>
        </div>

        <!-- Tombol Navigasi -->
        <div class="max-w-8x1 mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="flex justify-between">
                <a href="{{ route('form_postjob_step4') }}"
                    class="bg-yellow-400 hover:bg-yellow-300 text-black px-8 py-4 rounded-full text-sm font-semibold transition">
                    ← Sebelumnya
                </a>
                <button type="submit" form="jobForm"
                    class="bg-yellow-400 hover:bg-yellow-300 text-black px-8 py-4 rounded-full text-sm font-semibold transition">
                    Selanjutnya →
                </button>
            </div>
        </div>
    </div>
@endsection
