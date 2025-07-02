@extends('layouts.admin_app')

@section('title', 'Tambah Perusahaan Baru untuk Job Fair')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white shadow-xl rounded-2xl p-8 border border-orange-200">
            <h1 class="text-3xl font-bold text-orange-600 mb-6">Tambah Perusahaan Baru</h1>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-300 text-red-600 rounded-lg">
                    <strong class="font-semibold">Oops! Ada beberapa masalah:</strong>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.jobfairs.companies.store', $jobfair) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Nama Perusahaan --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Perusahaan <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="w-full px-4 py-2 rounded-xl border border-orange-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-400 shadow-sm text-gray-800 placeholder:text-gray-400 @error('name') border-red-500 ring-red-300 @enderror"
                            required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Industri --}}
                    <div>
                        <label for="industry" class="block text-sm font-medium text-gray-700 mb-1">Industri <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="industry" id="industry" value="{{ old('industry') }}"
                            class="w-full px-4 py-2 rounded-xl border border-orange-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-400 shadow-sm text-gray-800 placeholder:text-gray-400 @error('industry') border-red-500 ring-red-300 @enderror"
                            required>
                        @error('industry')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Lokasi --}}
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Lokasi (Kota/Daerah)
                            <span class="text-red-500">*</span></label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}"
                            class="w-full px-4 py-2 rounded-xl border border-orange-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-400 shadow-sm text-gray-800 placeholder:text-gray-400 @error('location') border-red-500 ring-red-300 @enderror"
                            required>
                        @error('location')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Website --}}
                    <div>
                        <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                        <input type="url" name="website" id="website" value="{{ old('website') }}"
                            placeholder="https://example.com"
                            class="w-full px-4 py-2 rounded-xl border border-orange-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-400 shadow-sm text-gray-800 placeholder:text-gray-400 @error('website') border-red-500 ring-red-300 @enderror">
                        @error('website')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Perusahaan <span
                                class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full px-4 py-2 rounded-xl border border-orange-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-400 shadow-sm text-gray-800 placeholder:text-gray-400 @error('email') border-red-500 ring-red-300 @enderror"
                            required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- WhatsApp --}}
                    <div>
                        <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp') }}"
                            placeholder="+6281234567890"
                            class="w-full px-4 py-2 rounded-xl border border-orange-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-400 shadow-sm text-gray-800 placeholder:text-gray-400 @error('whatsapp') border-red-500 ring-red-300 @enderror"
                            required>
                        @error('whatsapp')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Perusahaan <span
                            class="text-red-500">*</span></label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-4 py-2 rounded-xl border border-orange-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-400 shadow-sm text-gray-800 placeholder:text-gray-400 @error('description') border-red-500 ring-red-300 @enderror"
                        required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Logo Upload --}}
                <div>
                    <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">Logo Perusahaan</label>
                    <input type="file" name="logo" id="logo" accept="image/*"
                        class="w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-orange-100 file:text-orange-700 hover:file:bg-orange-200 @error('logo') border-red-500 @enderror">
                    @error('logo')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Button Aksi --}}
                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.jobfairs.index') }}"
                        class="inline-flex items-center px-4 py-2 text-sm text-orange-600 font-medium hover:text-orange-800 transition duration-150 ease-in-out">
                        ← Kembali
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2 bg-orange-500 text-white text-sm font-medium rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:ring-offset-2 transition">
                        Simpan Perusahaan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Tambahkan script khusus halaman jika diperlukan --}}
@endpush
