@extends('layouts.admin_app')

@section('content')
    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mb-6">
            <a href="{{ route('admin.jobfairs.index') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-orange-600 bg-orange-50 border border-orange-200 hover:bg-orange-100 hover:text-orange-700 transition px-4 py-2 rounded-lg shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Event
            </a>
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-6 tracking-tight">Tambah Event Jobfair Baru</h1>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow">
                <strong class="font-semibold">Terjadi kesalahan:</strong>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow-lg rounded-xl p-8">
            <form action="{{ route('admin.jobfairs.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Nama Event --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-800 mb-1">Nama Event <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Slug --}}
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-800 mb-1">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition"
                        placeholder="Kosongkan agar digenerate otomatis dari nama">
                    <p class="text-xs text-gray-500 mt-1">Jika dikosongkan, slug akan dibuat otomatis berdasarkan nama
                        event.</p>
                    @error('slug')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal Mulai & Selesai --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="date_start" class="block text-sm font-medium text-gray-800 mb-1">Tanggal Mulai <span
                                class="text-red-500">*</span></label>
                        <input type="date" name="date_start" id="date_start" value="{{ old('date_start') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                        @error('date_start')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="date_end" class="block text-sm font-medium text-gray-800 mb-1">Tanggal Selesai <span
                                class="text-red-500">*</span></label>
                        <input type="date" name="date_end" id="date_end" value="{{ old('date_end') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                        @error('date_end')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Lokasi --}}
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-800 mb-1">Lokasi <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="location" id="location" value="{{ old('location') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                    @error('location')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-800 mb-1">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex justify-end items-center pt-6 border-t border-gray-200 gap-3">
                    <a href="{{ route('admin.jobfairs.index') }}"
                        class="inline-block px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-block px-4 py-2 text-sm font-medium text-white bg-orange-500 border border-transparent rounded-lg hover:bg-orange-600 transition">
                        Simpan Event
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        // Script untuk auto-generate slug dari nama event jika field slug kosong
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');

        if (nameInput && slugInput) {
            nameInput.addEventListener('keyup', function() {
                // Hanya generate slug jika field slug saat ini kosong
                // atau jika pengguna belum secara manual mengubah slug
                if (slugInput.value === '' || slugInput.dataset.manualEdit !== 'true') {
                    slugInput.value = generateSlug(this.value);
                }
            });

            slugInput.addEventListener('input', function() {
                // Tandai bahwa slug telah diedit secara manual
                // sehingga tidak lagi otomatis ter-update dari nama
                this.dataset.manualEdit = 'true';
            });
        }

        function generateSlug(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-') // Ganti spasi dengan -
                .replace(/[^\w\-]+/g, '') // Hapus semua karakter non-word
                .replace(/\-\-+/g, '-') // Ganti multiple - dengan single -
                .replace(/^-+/, '') // Trim - dari awal teks
                .replace(/-+$/, ''); // Trim - dari akhir teks
        }
    </script>
@endpush
