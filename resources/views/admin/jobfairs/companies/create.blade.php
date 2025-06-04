{{-- resources/views/admin/jobfairs/companies/create.blade.php --}}

@extends('layouts.admin_app')

@section('title', 'Tambah Perusahaan Baru untuk Job Fair')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-semibold mb-6 text-gray-700">Tambah Perusahaan Baru</h1>

        @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded">
            <strong class="font-bold">Oops! Ada beberapa masalah dengan input Anda.</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.jobfairs.companies.store', $jobfair) }}" method="POST" enctype="multipart/form-data">
            @csrf


            {{-- Kolom Kiri --}}
            <div>
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Perusahaan <span class="text-red-500">*</span></label>
                    {{-- HAPUS ARGUMEN KEDUA DARI old() --}}
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('name') border-red-500 @enderror" required>
                    @error('name')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="industry" class="block text-sm font-medium text-gray-700 mb-1">Industri <span class="text-red-500">*</span></label>
                    {{-- HAPUS ARGUMEN KEDUA DARI old() --}}
                    <input type="text" name="industry" id="industry" value="{{ old('industry') }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('industry') border-red-500 @enderror" required>
                    @error('industry')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Lokasi (Kota/Daerah) <span class="text-red-500">*</span></label>
                    {{-- HAPUS ARGUMEN KEDUA DARI old() --}}
                    <input type="text" name="location" id="location" value="{{ old('location') }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('location') border-red-500 @enderror" required>
                    @error('location')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                    {{-- HAPUS ARGUMEN KEDUA DARI old() --}}
                    <input type="url" name="website" id="website" value="{{ old('website') }}" placeholder="https://example.com" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('website') border-red-500 @enderror">
                    @error('website')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-2 mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Perusahaan <span class="text-red-500">*</span></label>
                    <textarea name="description" id="description" rows="4" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('description') border-red-500 @enderror" required>{{ old('description') }}</textarea>
                    @error('description')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Perusahaan <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('email') border-red-500 @enderror" required>
                    @error('email')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp <span class="text-red-500">*</span></label>
                    <input type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp') }}" placeholder="+6281234567890" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('whatsapp') border-red-500 @enderror" required>
                    @error('whatsapp')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">Logo Perusahaan</label>
                    <input type="file" name="logo" id="logo" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('logo') border-red-500 @enderror">
                    @error('logo')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-end mt-8 border-t pt-6">
                <a href="{{ route('admin.jobfairs.index') }}" {{-- Atau route kembali yang sesuai --}}
                    class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
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