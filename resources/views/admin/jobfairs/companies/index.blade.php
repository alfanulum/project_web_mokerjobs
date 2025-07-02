@extends('layouts.admin_app')

@section('title', 'Perusahaan di Event: ' . $jobfair->name)

@section('content')
    <div class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8">
        {{-- Header dan tombol --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-1">Perusahaan di Event Jobfair</h1>
                <p class="text-lg text-orange-600 font-semibold">{{ $jobfair->name }}</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-2">
                <a href="{{ route('admin.jobfairs.index') }}"
                    class="inline-flex items-center justify-center gap-2 bg-white text-orange-600 border border-orange-300 hover:bg-orange-50 font-semibold px-4 py-2 rounded-lg shadow-sm transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Daftar Event
                </a>
                <a href="{{ route('admin.jobfairs.companies.create', $jobfair->id) }}"
                    class="inline-flex items-center justify-center gap-2 bg-orange-500 text-white hover:bg-orange-600 px-4 py-2 rounded-lg font-semibold shadow-sm transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Tambah Perusahaan
                </a>
            </div>
        </div>

        {{-- Alert sukses --}}
        @if (session('success'))
            <div id="success-alert"
                class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow relative">
                <strong class="font-bold">Sukses!</strong>
                <span class="block">{{ session('success') }}</span>
                <button type="button" onclick="document.getElementById('success-alert').style.display='none'"
                    class="absolute top-2 right-2 text-green-700 hover:text-green-900 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        {{-- Alert error --}}
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow-sm">
                <strong class="font-semibold">Terjadi kesalahan:</strong>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Table --}}
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-orange-500">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold text-white uppercase tracking-wider">No.</th>
                            <th class="px-6 py-3 text-left font-semibold text-white uppercase tracking-wider">Nama
                                Perusahaan</th>
                            <th class="px-6 py-3 text-left font-semibold text-white uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left font-semibold text-white uppercase tracking-wider">Total Lowongan
                            </th>
                            <th class="px-6 py-3 text-center font-semibold text-white uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($companies as $company)
                            <tr class="hover:bg-orange-50 transition">
                                <td class="px-6 py-4 text-gray-800">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-medium text-gray-800">{{ $company->name }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $company->email ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $company->jobs->count() }} Lowongan</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.jobs.index', ['company' => $company->id]) }}"
                                            class="px-3 py-1 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-xs font-medium">
                                            List Lowongan
                                        </a>
                                        <form
                                            action="{{ route('admin.jobfairs.companies.destroy', ['jobfair' => $jobfair->id, 'company' => $company->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus {{ $company->name }} dari event ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1.5 bg-red-500 text-white rounded-md hover:bg-red-600 text-xs font-medium transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mb-2"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        <p class="mb-2">Belum ada perusahaan yang ditambahkan ke event ini.</p>
                                        <a href="{{ route('admin.jobfairs.companies.create', $jobfair->id) }}"
                                            class="inline-block mt-2 text-orange-600 hover:text-orange-800 font-semibold">
                                            Tambahkan Perusahaan Sekarang
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.display = 'none';
            }, 5000);
        }
    </script>
@endpush
