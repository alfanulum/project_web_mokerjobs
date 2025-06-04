@extends('layouts.admin_app') {{-- Sesuaikan dengan nama layout admin Anda --}}

@section('title', 'Perusahaan di Event: ' . $jobfair->name)

@section('content')
<div class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Perusahaan di Event Jobfair</h1>
            <p class="text-lg text-orange-600 font-semibold">{{ $jobfair->name }}</p>
        </div>
        <a href="{{ route('admin.jobfairs.companies.create', $jobfair->id) }}"
            class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:ring-opacity-50 transition ease-in-out duration-150 inline-flex items-center mt-4 sm:mt-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Tambah Perusahaan ke Event Ini
        </a>
    </div>

    @if(session('success'))
    <div id="success-alert" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm relative" role="alert">
        <strong class="font-bold">Sukses!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <button type="button" onclick="document.getElementById('success-alert').style.display='none'" class="absolute top-0 bottom-0 right-0 px-4 py-3 text-green-700 hover:text-green-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
        <strong class="font-bold">Error!</strong>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-orange-500">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Nama Perusahaan
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Email Perusahaan
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Total Lowongan (Global)
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($companies as $company)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                            {{ $company->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $company->email ?? 'N/A' }} {{-- Asumsi model Company memiliki atribut email --}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $company->jobs->count() }} Lowongan
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.jobs.index', ['company' => $company->id]) }}"
                                    class="inline-block px-4 py-1 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700">
                                    List Lowongan
                                </a>

                                <form action="{{ route('admin.jobfairs.companies.destroy', ['jobfair' => $jobfair->id, 'company' => $company->id]) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus perusahaan {{ $company->name }} dari event {{ $jobfair->name }}?');"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1.5 text-xs font-medium text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Hapus dari Event
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 whitespace-nowrap text-sm text-gray-500 text-center">
                            <div class="flex flex-col items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Belum ada perusahaan yang ditambahkan ke event ini.
                                <a href="{{ route('admin.jobfairs.companies.create', $jobfair->id) }}" class="mt-4 text-orange-600 hover:text-orange-800 font-semibold">
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

    {{--
    Jika Anda mengimplementasikan paginasi untuk $companies di controller, uncomment ini.
    Saat ini, $companies diambil dengan ->get(), jadi tidak ada paginasi.
    @if ($companies->hasPages())
    <div class="mt-8 p-4 bg-white shadow-md rounded-lg">
        {{ $companies->links() }}
</div>
@endif
--}}
</div>
@endsection

@push('scripts')
<script>
    // Auto-hide success alert
    const successAlert = document.getElementById('success-alert');
    if (successAlert) {
        setTimeout(() => {
            if (successAlert) { // Check again in case it was removed by other means
                successAlert.style.display = 'none';
            }
        }, 5000); // 5 detik
    }

    // Anda bisa menambahkan JavaScript lain di sini jika diperlukan
</script>
@endpush