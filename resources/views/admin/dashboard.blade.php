@extends('layouts.admin_app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="bg-white shadow rounded-xl p-4">
            <h2 class="text-gray-600 text-sm">Total Pengajuan</h2>
            <p class="text-2xl font-semibold">{{ $total }}</p>
        </div>

        <div class="bg-yellow-100 shadow rounded-xl p-4">
            <h2 class="text-yellow-800 text-sm">Sedang Diproses</h2>
            <p class="text-2xl font-semibold text-yellow-900">{{ $pending }}</p>
        </div>

        <div class="bg-green-100 shadow rounded-xl p-4">
            <h2 class="text-green-800 text-sm">Disetujui</h2>
            <p class="text-2xl font-semibold text-green-900">{{ $approved }}</p>
        </div>

        <div class="bg-red-100 shadow rounded-xl p-4">
            <h2 class="text-red-800 text-sm">Ditolak</h2>
            <p class="text-2xl font-semibold text-red-900">{{ $rejected }}</p>
        </div>

    </div>
</div>
@endsection