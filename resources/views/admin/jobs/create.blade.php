{{-- resources/views/admin/jobs/create.blade.php --}}
@extends('layouts.admin_app')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Tambah Lowongan Kerja</h1>

    <form action="{{ route('admin.jobs.store', $company) }}" method="POST"
        class="space-y-6 bg-white p-8 rounded-xl shadow-md">
        @csrf

        {{-- Judul --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Pekerjaan</label>
            <input type="text" name="title"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition"
                required>
        </div>

        {{-- Nama Perusahaan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Perusahaan</label>
            <input type="text" class="w-full rounded-lg border bg-gray-100 px-4 py-2 text-gray-700 cursor-not-allowed"
                value="{{ $company->name }}" readonly>
        </div>

        {{-- Event Jobfair --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Event Jobfair</label>
            <select name="jobfair_event_id"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition"
                required>
                @foreach ($events as $event)
                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Lokasi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
            <input type="text" name="location"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition"
                required>
        </div>

        {{-- Deskripsi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="description" rows="4"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition resize-none"
                required></textarea>
        </div>

        {{-- Kualifikasi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kualifikasi</label>
            <textarea name="requirements" rows="4"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition resize-none"
                required></textarea>
        </div>

        {{-- Tingkat Pendidikan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tingkat Pendidikan</label>
            <input type="text" name="education_level"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition"
                required>
        </div>

        {{-- Pengalaman --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Pengalaman (tahun)</label>
            <input type="number" name="experience_years" min="0"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition"
                required>
        </div>

        {{-- Gaji --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Gaji</label>
            <input type="number" name="salary" min="0" step="1000"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition"
                required>
        </div>

        {{-- Tipe Pekerjaan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Pekerjaan</label>
            <select name="type"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition"
                required>
                <option value="fulltime">Full Time</option>
                <option value="parttime">Part Time</option>
                <option value="internship">Internship</option>
                <option value="freelance">Freelance</option>
            </select>
        </div>

        {{-- Tanggal Kadaluarsa --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kadaluarsa</label>
            <input type="datetime-local" name="expired_at"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition"
                required>
        </div>

        {{-- Link Pendaftaran --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Link Pendaftaran</label>
            <input type="url" name="apply_link"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
        </div>

        {{-- Tombol Simpan --}}
        <div class="flex justify-end">
            <button type="submit"
                class="inline-flex items-center px-5 py-2 text-sm font-semibold text-white bg-orange-500 rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition">
                Simpan
            </button>
        </div>
    </form>

    <script>
        document.querySelector('input[name="salary"]').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
@endsection
