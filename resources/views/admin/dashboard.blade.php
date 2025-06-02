@extends('layouts.admin_app')

@section('content')
    <div class="p-6 space-y-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <x-dashboard-card title="Total Pengajuan" :value="$total" />
            <x-dashboard-card title="Diproses" :value="$diproses" color="yellow" />
            <x-dashboard-card title="Disetujui" :value="$disetujui" color="green" />
            <x-dashboard-card title="Ditolak" :value="$ditolak" color="red" />
        </div>

        <div class="bg-white rounded-xl shadow p-4">
            <h2 class="text-xl font-semibold mb-4 font-figtree ">Jumlah Ajuan ({{ now()->year }})</h2>
            <canvas id="lokerChart" height="100"></canvas>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('lokerChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                    'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
                ],
                datasets: [{
                    label: 'Jumlah Ajuan',
                    data: @json($chartData),
                    backgroundColor: 'rgba(59, 130, 246, 0.5)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
@endpush
