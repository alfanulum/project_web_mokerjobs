{{-- resources/views/admin/jobs/create.blade.php --}}
@extends('layouts.admin_app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Tambah Lowongan Kerja</h1>

<form action="{{ route('admin.jobs.store', $company) }}" method="POST"
    class="space-y-6">
    @csrf

    <div>
        <label class="block font-semibold">Judul Pekerjaan</label>
        <input type="text" name="title" class="w-full border rounded p-2" required>
    </div>

    <div>
        <label class="block font-semibold">Perusahaan</label>
        <input type="text" class="w-full border rounded p-2 bg-gray-100" value="{{ $company->name }}" readonly>
    </div>

    <div>
        <label class="block font-semibold">Event Jobfair</label>
        <select name="jobfair_event_id" class="w-full border rounded p-2" required>
            @foreach ($events as $event)
            <option value="{{ $event->id }}">{{ $event->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block font-semibold">Lokasi</label>
        <input type="text" name="location" class="w-full border rounded p-2" required>
    </div>

    <div>
        <label class="block font-semibold">Deskripsi</label>
        <textarea name="description" class="w-full border rounded p-2" rows="3" required></textarea>
    </div>

    <div>
        <label class="block font-semibold">Kualifikasi</label>
        <textarea name="requirements" class="w-full border rounded p-2" rows="3" required></textarea>
    </div>

    <div>
        <label class="block font-semibold">Tingkat Pendidikan</label>
        <input type="text" name="education_level" class="w-full border rounded p-2" required>
    </div>

    <div>
        <label class="block font-semibold">Pengalaman (tahun)</label>
        <input type="number" name="experience_years" class="w-full border rounded p-2" min="0" required>
    </div>

    <div>
        <label class="block font-semibold">Gaji</label>
        <input type="text" name="salary" class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block font-semibold">Tipe Pekerjaan</label>
        <select name="type" class="w-full border rounded p-2" required>
            <option value="fulltime">Full Time</option>
            <option value="parttime">Part Time</option>
            <option value="internship">Internship</option>
            <option value="freelance">Freelance</option>
        </select>
    </div>

    <div>
        <label class="block font-semibold">Tanggal Kadaluarsa</label>
        <input type="datetime-local" name="expired_at" class="w-full border rounded p-2" required>
    </div>

    <div>
        <label class="block font-semibold">Link Pendaftaran</label>
        <input type="url" name="apply_link" class="w-full border rounded p-2">
    </div>

    <div>
        <button type="submit" class="px-3 py-1.5 text-xs font-medium text-white bg-orange-500 rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition ease-in-out duration-150">
            Simpan
        </button>
    </div>
</form>
@endsection