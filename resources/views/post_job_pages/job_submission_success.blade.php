@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#FAFAFA] py-10 px-4 sm:px-8 lg:px-12 font-poppins flex items-center justify-center">
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 max-w-2xl mx-auto p-8 sm:p-10 text-center">
            <div class="mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-500 mx-auto" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Lowongan Berhasil Diposting!</h2>
            <p class="text-gray-600 mb-6">Terima kasih telah memposting lowongan pekerjaan di platform kami. Lowongan Anda
                sekarang dapat dilihat oleh pencari kerja.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('post_job') }}"
                    class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-full transition">
                    Buat Lowongan Baru
                </a>
                <a href="{{ route('overview') }}"
                    class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-full transition">
                    Lihat Lowongan
                </a>
            </div>
        </div>
    </div>
@endsection
