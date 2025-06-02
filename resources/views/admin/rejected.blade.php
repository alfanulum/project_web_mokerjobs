@extends('layouts.admin_app') {{-- Sesuaikan dengan layout admin utama Anda --}}

@section('title', 'Pengelolaan Ajuan Lowongan')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold mb-6 text-gray-700">Daftar Ajuan Lowongan (Rejected)</h1>

    {{-- Menampilkan pesan sukses atau error dari session --}}
    @if(session('success'))
    <div class="bg-green-500 text-white p-4 rounded mb-4 shadow-md" role="alert">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-500 text-white p-4 rounded mb-4 shadow-md" role="alert">
        {{ session('error') }}
    </div>
    @endif

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No.</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Pekerjaan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Perusahaan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Status Saat Ini</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi Ubah Status</th>

                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Detail</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($lowonganList as $lowongan)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">{{ $lowongan->job_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $lowongan->company_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $lowongan->category_job ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($lowongan->status == 'accept') bg-green-200 text-green-800
                                    @elseif($lowongan->status == 'decline') bg-red-200 text-red-800
                                    @elseif($lowongan->status == 'pending') bg-yellow-200 text-yellow-800
                                    @else bg-gray-200 text-gray-800 @endif">
                                {{ ucfirst($lowongan->status ?? 'N/A') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center space-x-2">
                            {{-- Form untuk Approve --}}
                            @if($lowongan->status != 'accept')
                            <form action="{{ route('admin.processed.update_status', $lowongan->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="accept">
                                <button type="submit" class="px-3 py-1.5 text-xs font-medium text-white bg-green-500 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                    Approve
                                </button>
                            </form>
                            @endif

                            {{-- Form untuk Reject --}}
                            @if($lowongan->status != 'decline')
                            <form action="{{ route('admin.processed.update_status', $lowongan->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="decline">
                                <button type="submit" class="px-3 py-1.5 text-xs font-medium text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                    Reject
                                </button>
                            </form>
                            @endif
                            {{-- Anda bisa menambahkan tombol untuk status lain, misalnya 'Set as Pending' --}}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                            @if(Route::has('detail_job'))
                            <a href="{{ route('detail_job', $lowongan->id) }}" class="px-3 py-1.5 text-xs font-medium text-white bg-orange-500 rounded-md hover:bg-orange-600">
                                Detail
                            </a>
                            @endif
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 whitespace-nowrap text-sm text-gray-500 text-center"> {{-- Sesuaikan colspan --}}
                            Tidak ada data ajuan lowongan yang perlu diproses atau ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Untuk pagination jika Anda menggunakannya di controller: $lowonganList->links() --}}
    {{-- <div class="mt-6">
        {{-- $lowonganList->links() -- }}
</div> --}}
</div>
@endsection

@push('styles')
{{-- Styling tambahan jika perlu (misalnya jika tidak menggunakan Tailwind CSS secara penuh dari layout) --}}
@endpush