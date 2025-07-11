@extends('layouts.admin_app')

@section('content')
<div class="p-6 space-y-6">

    <!-- Ringkasan Pengajuan Lowongan -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <x-dashboard-card title="Total Pengajuan" :value="$total" />
        <x-dashboard-card title="Diproses" :value="$diproses" color="yellow" />
        <x-dashboard-card title="Disetujui" :value="$disetujui" color="green" />
        <x-dashboard-card title="Ditolak" :value="$ditolak" color="red" />
    </div>

    <!-- Grafik Chart Lowongan -->
    <div class="bg-white rounded-xl shadow p-4">
        <h2 class="text-xl font-semibold mb-4 font-figtree">Jumlah Ajuan ({{ now()->year }})</h2>
        <canvas id="lokerChart" height="100"></canvas>
        <button id="backBtn"
            class="hidden mt-4 px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded"
            onclick="backToMain()">← Kembali</button>
    </div>

    <!-- Upcoming Jobfair Table -->
    <div class="bg-white rounded-xl shadow p-4 mt-8">
        <h2 class="text-xl font-semibold mb-4 font-figtree">Upcoming Jobfair</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">#</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Nama Event</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Lokasi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($upcomingEvents as $index => $event)
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $event->name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($event->date_starts)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($event->date_end)->format('d M Y') }}
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $event->location }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">
                            Tidak ada event jobfair yang akan datang.
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const drilldownData = @json($chartDrilldown);
    const mainLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    const mainValues = @json($chartData);

    let currentLevel = 'main';
    const ctx = document.getElementById('lokerChart').getContext('2d');

    const chartConfig = {
        type: 'bar',
        data: {
            labels: mainLabels,
            datasets: [{
                label: 'Jumlah Ajuan',
                data: mainValues,
                backgroundColor: 'rgba(59, 130, 246, 0.5)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            onClick: function(e, elements) {
                if (elements.length === 0 || currentLevel !== 'main') return;

                const index = elements[0].index;
                const month = mainLabels[index];
                const data = drilldownData[month];
                if (!data) return;

                showDrilldown(month, data);
            }
        }
    };

    const chart = new Chart(ctx, chartConfig);

    function showDrilldown(month, data) {
        const labels = Object.keys(data);
        const values = Object.values(data);
        const colors = {
            'Diproses': 'rgba(234, 179, 8, 0.7)',
            'Disetujui': 'rgba(34, 197, 94, 0.7)',
            'Ditolak': 'rgba(239, 68, 68, 0.7)',
        };
        const borderColors = {
            'Diproses': 'rgba(202, 138, 4, 1)',
            'Disetujui': 'rgba(22, 163, 74, 1)',
            'Ditolak': 'rgba(220, 38, 38, 1)',
        };

        chart.data = {
            labels: labels,
            datasets: [{
                label: `Detail Ajuan - ${month}`,
                data: values,
                backgroundColor: labels.map(l => colors[l] || 'gray'),
                borderColor: labels.map(l => borderColors[l] || 'black'),
                borderWidth: 1
            }]
        };

        chart.options.plugins.title.text = `Detail Ajuan Bulan ${month}`;
        chart.options.plugins.title.display = true;
        chart.update();

        document.getElementById('backBtn').classList.remove('hidden');
        currentLevel = 'drilldown';
    }

    function backToMain() {
        chart.data = {
            labels: mainLabels,
            datasets: [{
                label: 'Jumlah Ajuan',
                data: mainValues,
                backgroundColor: 'rgba(59, 130, 246, 0.5)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1
            }]
        };
        chart.options.plugins.title.display = false;
        chart.update();

        document.getElementById('backBtn').classList.add('hidden');
        currentLevel = 'main';
    }
</script>
@endpush