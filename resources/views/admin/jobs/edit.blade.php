@extends('layouts.admin_app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Lowongan Pekerjaan</h1>

@if ($errors->any())
<div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
    <ul>
        @foreach ($errors->all() as $error)
        <li>- {{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.jobs.update', $job) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label class="block font-semibold mb-1" for="title">Judul Pekerjaan</label>
        <input type="text" name="title" id="title" value="{{ old('title', $job->title) }}" class="w-full border rounded p-2" required>
    </div>

    <div>
        <label class="block font-semibold mb-1" for="location">Lokasi</label>
        <input type="text" name="location" id="location" value="{{ old('location', $job->location) }}" class="w-full border rounded p-2" required>
    </div>

    <div>
        <label class="block font-semibold mb-1" for="description">Deskripsi</label>
        <textarea name="description" id="description" class="w-full border rounded p-2" rows="4" required>{{ old('description', $job->description) }}</textarea>
    </div>

    <div>
        <label class="block font-semibold mb-1" for="requirements">Persyaratan</label>
        <textarea name="requirements" id="requirements" class="w-full border rounded p-2" rows="3" required>{{ old('requirements', $job->requirements) }}</textarea>
    </div>

    <div>
        <label class="block font-semibold mb-1" for="education_level">Pendidikan</label>
        <input type="text" name="education_level" id="education_level" value="{{ old('education_level', $job->education_level) }}" class="w-full border rounded p-2" required>
    </div>

    <div>
        <label class="block font-semibold mb-1" for="experience_years">Pengalaman (tahun)</label>
        <input type="number" name="experience_years" id="experience_years" value="{{ old('experience_years', $job->experience_years) }}" class="w-full border rounded p-2" min="0" required>
    </div>

    <div>
        <label class="block font-semibold mb-1" for="salary">Gaji</label>
        <input type="text" name="salary" id="salary" value="{{ old('salary', $job->salary) }}" class="w-full border rounded p-2" required>
    </div>

    <div>
        <label class="block font-semibold mb-1" for="type">Tipe Pekerjaan</label>
        <select name="type" id="type" class="w-full border rounded p-2" required>
            <option value="fulltime" {{ old('type', $job->type) == 'fulltime' ? 'selected' : '' }}>Fulltime</option>
            <option value="parttime" {{ old('type', $job->type) == 'parttime' ? 'selected' : '' }}>Parttime</option>
            <option value="contract" {{ old('type', $job->type) == 'contract' ? 'selected' : '' }}>Contract</option>
            <option value="internship" {{ old('type', $job->type) == 'internship' ? 'selected' : '' }}>Internship</option>
        </select>
    </div>

    <div>
        <label class="block font-semibold mb-1" for="posted_at">Tanggal Posting</label>
        <input type="datetime-local" name="posted_at" id="posted_at" value="{{ old('posted_at', \Carbon\Carbon::parse($job->posted_at)->format('Y-m-d\TH:i')) }}" class="w-full border rounded p-2" required>
    </div>

    <div>
        <label class="block font-semibold mb-1" for="expired_at">Tanggal Kadaluarsa</label>
        <input type="datetime-local" name="expired_at" id="expired_at" value="{{ old('expired_at', \Carbon\Carbon::parse($job->expired_at)->format('Y-m-d\TH:i')) }}" class="w-full border rounded p-2" required>
    </div>

    <div>
        <label class="block font-semibold mb-1" for="apply_link">Link Apply</label>
        <input type="url" name="apply_link" id="apply_link" value="{{ old('apply_link', $job->apply_link) }}" class="w-full border rounded p-2" required>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Simpan Perubahan
    </button>
</form>
@endsection