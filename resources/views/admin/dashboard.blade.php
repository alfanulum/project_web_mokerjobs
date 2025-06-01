@extends('layouts.admin_app') {{-- Pastikan ini adalah nama file layout Anda --}}

@section('title', 'Admin Dashboard')

@push('styles')
<style>
    /* Animasi dan style spesifik untuk dashboard ini */
    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes fadeInUp {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    @keyframes pulse-custom { /* Ubah nama agar tidak konflik jika ada 'pulse' lain */
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.03); } /* Sedikit lebih halus */
    }
    @keyframes countUp {
        from { opacity: 0; transform: scale(0.8); } /* Mulai dari skala lebih besar */
        to { opacity: 1; transform: scale(1); }
    }

    .animate-slide-right { animation: slideInRight 0.5s ease-out forwards; }
    .animate-fade-up { animation: fadeInUp 0.6s ease-out forwards; }
    .animate-pulse-custom { animation: pulse-custom 2.2s infinite ease-in-out; }
    .animate-count-up { animation: countUp 0.8s ease-out forwards; }

    .hover-lift {
        transition: all 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-6px); /* Angkat sedikit lebih tinggi */
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12), 0 7px 10px rgba(0,0,0,0.08); /* Shadow lebih dramatis */
    }
    .gradient-bg-stat { /* Gradient khusus untuk stat card utama */
        background: linear-gradient(135deg, #fb923c, #f97316); /* orange-400 to orange-500 */
    }
    .loading-skeleton {
        background: linear-gradient(90deg, #e2e8f0 25%, #cbd5e1 50%, #e2e8f0 75%); /* slate-200, slate-300 */
        background-size: 200% 100%;
        animation: loading-skeleton-anim 1.5s infinite linear;
    }
    @keyframes loading-skeleton-anim {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }
    .custom-scrollbar-page::-webkit-scrollbar { width: 8px; height: 8px; }
    .custom-scrollbar-page::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
    .custom-scrollbar-page::-webkit-scrollbar-thumb { background: #fbbf24; border-radius: 10px; } /* amber-400 */
    .custom-scrollbar-page::-webkit-scrollbar-thumb:hover { background: #f59e0b; } /* amber-500 */
</style>
@endpush

@section('content')
{{-- Data dari Controller (contoh, Anda perlu menyediakan ini) --}}
@php
    $stats = $stats ?? [
        'total' => 0,
        'pending' => 0,
        'approved' => 0,
        'rejected' => 0,
        'totalGrowthText' => 'N/A',
        'pendingRateText' => 'N/A',
        'approvalRateText' => 'N/A',
        'rejectionRateText' => 'N/A',
    ];
    $monthlyApplicationData = $monthlyApplicationData ?? array_fill(0, 12, 0); // Array 12 angka 0
    $recentJobs = $recentJobs ?? collect(); // Collection kosong jika tidak ada
    $availableYears = $availableYears ?? [date('Y')];
@endphp

<div class="animate-slide-right">
    <div class="flex flex-col sm:flex-row justify-between items-start mb-6 animate-fade-up">
        <div>
            <h2 class="text-2xl lg:text-3xl font-bold text-gray-800">Admin Dashboard</h2>
            <p class="text-gray-500 mt-1 text-sm lg:text-base">Overview of job application statistics.</p>
        </div>
        <div class="flex items-center space-x-3 mt-3 sm:mt-0">
            <div id="newNotification" class="bg-yellow-400 text-yellow-800 px-4 py-2 rounded-md font-semibold animate-pulse-custom cursor-pointer hover:bg-yellow-300 transition-colors text-xs sm:text-sm shadow-sm">
                <span id="newCountDashboard">{{ $stats['pending'] }}</span> New (Pending)
            </div>
            <button onclick="refreshDashboardData()" class="bg-blue-500 text-white p-2.5 rounded-md hover:bg-blue-600 transition-colors hover-lift shadow-sm">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m-15.357-2a8.001 8.001 0 0015.357 2M9 15h4.581"></path></svg>
            </button>
        </div>
    </div>

    {{-- Loading Skeleton (Contoh, bisa Anda implementasikan jika fetch data lama) --}}
    {{-- <div id="loadingStateDashboard" class="hidden"> ... </div> --}}

    <div id="statsCards" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6 mb-6">
        <div class="gradient-bg-stat text-white p-5 rounded-xl hover-lift cursor-pointer animate-fade-up shadow-lg" onclick="showDetails('total')">
            <h3 class="text-sm font-medium mb-1 opacity-80">Total Applications</h3>
            <p id="totalCountMain" class="text-3xl font-bold animate-count-up">{{ $stats['total'] }}</p>
            <div class="mt-1.5 text-xs opacity-70">
                <span id="totalGrowthTextDashboard">{{ $stats['totalGrowthText'] }}</span>
            </div>
        </div>
        <div class="bg-white p-5 rounded-xl shadow-lg hover-lift cursor-pointer animate-fade-up" style="animation-delay: 0.1s" onclick="showDetails('pending')">
            <h3 class="text-sm text-gray-500 font-medium mb-1">Pending Applications</h3>
            <p id="pendingCountMain" class="text-3xl font-bold text-blue-600 animate-count-up">{{ $stats['pending'] }}</p>
            <div class="mt-1.5 text-xs text-gray-500">
                <span id="pendingRateTextDashboard">{{ $stats['pendingRateText'] }}</span>
            </div>
        </div>
        <div class="bg-white p-5 rounded-xl shadow-lg hover-lift cursor-pointer animate-fade-up" style="animation-delay: 0.2s" onclick="showDetails('approved')">
            <h3 class="text-sm text-gray-500 font-medium mb-1">Approved Applications</h3>
            <p id="approvedCountMain" class="text-3xl font-bold text-green-600 animate-count-up">{{ $stats['approved'] }}</p>
            <div class="mt-1.5 text-xs text-gray-500">
                <span id="approvalRateTextDashboard">{{ $stats['approvalRateText'] }}</span>
            </div>
        </div>
        <div class="bg-white p-5 rounded-xl shadow-lg hover-lift cursor-pointer animate-fade-up" style="animation-delay: 0.3s" onclick="showDetails('rejected')">
            <h3 class="text-sm text-gray-500 font-medium mb-1">Rejected Applications</h3>
            <p id="rejectedCountMain" class="text-3xl font-bold text-red-600 animate-count-up">{{ $stats['rejected'] }}</p>
            <div class="mt-1.5 text-xs text-gray-500">
                <span id="rejectionRateTextDashboard">{{ $stats['rejectionRateText'] }}</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 sm:gap-6 animate-fade-up" style="animation-delay: 0.4s">
        <div class="lg:col-span-2 bg-white p-5 rounded-xl shadow-xl hover-lift">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4">
                <div>
                    <h4 class="text-lg font-semibold text-gray-800">Application Statistics</h4>
                    <p class="text-xs text-gray-500">Monthly application trend</p>
                </div>
                <div class="mt-2 sm:mt-0">
                    <select id="yearFilterDashboard" onchange="updateDashboardChart()" class="bg-gray-100 border border-gray-300 text-gray-700 px-3 py-1.5 rounded-md text-xs font-medium cursor-pointer focus:ring-orange-500 focus:border-orange-500">
                        @foreach($availableYears as $year)
                            <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="h-64 sm:h-72 relative"><canvas id="statsChartDashboard" width="400" height="200"></canvas></div>
        </div>
        <div class="bg-orange-50 p-5 rounded-xl shadow-xl hover-lift">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4">
                 <div>
                    <h4 class="text-lg font-semibold text-gray-800">Recently Updated</h4>
                    <p class="text-xs text-gray-500">Latest job status changes</p>
                </div>
                <a href="{{ route('admin.processed') }}" class="mt-2 sm:mt-0 bg-orange-500 text-white px-3.5 py-1.5 rounded-md text-xs font-semibold hover:bg-orange-600 transition-all duration-300 shadow-sm hover:shadow-md">
                    View All
                </a>
            </div>
            <div id="jobListDashboard" class="space-y-2.5 max-h-64 sm:max-h-72 overflow-y-auto custom-scrollbar-page pr-1">
                @forelse($recentJobs as $job)
                    <div class="p-3 bg-white rounded-lg shadow-sm border border-gray-200 hover:border-orange-300 transition-colors">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-700 truncate w-3/5">{{ $job->job_name ?? 'N/A' }}</span>
                            <span class="text-xs px-2 py-0.5 rounded-full
                                @if(isset($job->status) && $job->status == 'accept') bg-green-100 text-green-700
                                @elseif(isset($job->status) && $job->status == 'decline') bg-red-100 text-red-700
                                @elseif(isset($job->status) && $job->status == 'pending') bg-yellow-100 text-yellow-700
                                @else bg-gray-100 text-gray-700 @endif">
                                {{ ucfirst($job->status ?? 'N/A') }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-500 mt-0.5 truncate">{{ $job->company_name ?? 'N/A' }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ isset($job->updated_at) ? $job->updated_at->diffForHumans() : 'N/A' }}</p>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center py-4">No recent job updates.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- Modal (jika diperlukan untuk showDetails) --}}
<div id="jobModalDashboard" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm hidden items-center justify-center z-[60]">
    <div class="bg-white p-5 sm:p-6 rounded-xl shadow-2xl max-w-lg w-full mx-4 animate-fade-up transform transition-all duration-300 ease-out" id="jobModalDashboardContent">
        <div class="flex justify-between items-center mb-4">
            <h3 id="modalTitleDashboard" class="text-lg font-semibold text-gray-800">Details</h3>
            <button onclick="closeDashboardModal()" class="text-gray-400 hover:text-gray-600 text-2xl p-1 rounded-full hover:bg-gray-100 transition-colors">&times;</button>
        </div>
        <div id="modalContentDashboard" class="text-sm text-gray-600 max-h-[60vh] overflow-y-auto custom-scrollbar-page pr-2">
            <p>Details for the selected category will be shown here.</p>
            <p>You might want to load a table or specific list related to the clicked stat card.</p>
        </div>
         <div class="mt-5 text-right">
            <button onclick="closeDashboardModal()" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-md text-xs font-medium transition-colors">Close</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
    let statsChartDashboard; // Variabel global untuk chart

    // Data dari PHP untuk chart dan list (disediakan oleh controller)
    const monthlyApplicationData = @json($monthlyApplicationData);
    // const recentJobsData = @json($recentJobs); // Sudah di-render di Blade, bisa digunakan jika perlu re-render client-side

    document.addEventListener('DOMContentLoaded', function() {
        initDashboardChart(monthlyApplicationData);
        // updateAllStatsDashboard(); // Panggil jika Anda ingin mengupdate stat dari JS juga, tapi sudah di-render Blade
        // loadRecentJobsDashboard(recentJobsData); // Jika ingin render list dari JS
    });

    function animateNumber(elementId, targetNumber) {
        const element = document.getElementById(elementId);
        if (!element) return;
        const duration = 800; // Durasi animasi dalam ms
        const frameDuration = 1000 / 60; // 60fps
        const totalFrames = Math.round(duration / frameDuration);
        let currentFrame = 0;
        const initialNumber = parseInt(element.textContent.replace(/,/g, '')) || 0;
        const increment = (targetNumber - initialNumber) / totalFrames;

        function updateNumber() {
            currentFrame++;
            const newNumber = Math.round(initialNumber + increment * currentFrame);
            element.textContent = newNumber.toLocaleString(); // Format dengan koma jika perlu
            if (currentFrame < totalFrames) {
                requestAnimationFrame(updateNumber);
            } else {
                element.textContent = targetNumber.toLocaleString(); // Pastikan angka akhir tepat
            }
        }
        requestAnimationFrame(updateNumber);
        element.classList.add('animate-count-up'); // Tambahkan kelas untuk animasi CSS jika ada
        setTimeout(() => element.classList.remove('animate-count-up'), duration + 100); // Hapus setelah selesai
    }

    function initDashboardChart(dataValues) {
        const ctx = document.getElementById('statsChartDashboard')?.getContext('2d');
        if (!ctx) return;

        const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        statsChartDashboard = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Applications',
                    data: dataValues, // Gunakan data dari controller
                    borderColor: '#f97316', // orange-500
                    backgroundColor: 'rgba(249, 115, 22, 0.05)', // Sangat transparan
                    borderWidth: 2.5,
                    tension: 0.4,
                    pointBackgroundColor: '#f97316',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: { duration: 1500, easing: 'easeInOutQuart' },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        enabled: true,
                        backgroundColor: 'rgba(0,0,0,0.7)',
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 12 },
                        padding: 10,
                        cornerRadius: 4,
                        displayColors: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(200,200,200,0.1)' },
                        ticks: { font: {size: 10}, color: '#6b7280' } // gray-500
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: {size: 10}, color: '#6b7280' } // gray-500
                    }
                }
            }
        });
    }

    function updateDashboardChart() {
        const year = document.getElementById('yearFilterDashboard').value;
        // Di sini Anda perlu logika untuk mengambil data baru berdasarkan tahun (misalnya via AJAX)
        // Untuk demo, kita akan menggunakan data acak atau data yang sama
        showToastDashboard(`Fetching data for ${year}...`, 'info');
        // Simulasi pengambilan data
        setTimeout(() => {
            const newData = Array.from({length: 12}, () => Math.floor(Math.random() * 100)); // Data acak baru
            if (statsChartDashboard) {
                statsChartDashboard.data.datasets[0].data = newData;
                statsChartDashboard.update();
                showToastDashboard(`Chart updated for ${year}.`, 'success');
            }
        }, 1000);
    }

    function refreshDashboardData() {
        // Idealnya, ini akan memicu pengambilan data baru dari server dan memperbarui semua elemen
        showToastDashboard('Refreshing dashboard data...', 'info');
        // Simulasi:
        setTimeout(() => {
            // Anda akan mengganti ini dengan logika untuk mengambil dan memperbarui $stats, $monthlyApplicationData, $recentJobs
            // dari controller, lalu merender ulang bagian yang relevan atau seluruh halaman.
            // Untuk demo client-side, kita bisa panggil updateAllStatsDashboard() jika ada data baru.
            // Atau reload halaman:
            window.location.reload();
        }, 1200);
    }

    function showDetails(category) {
        // Fungsi ini bisa digunakan untuk menampilkan detail lebih lanjut di modal
        const modal = document.getElementById('jobModalDashboard');
        const modalTitle = document.getElementById('modalTitleDashboard');
        const modalContent = document.getElementById('modalContentDashboard');
        const modalContentContainer = document.getElementById('jobModalDashboardContent');


        modalTitle.textContent = `Details for ${category.charAt(0).toUpperCase() + category.slice(1)} Applications`;
        // Di sini Anda akan mengisi modalContent dengan data yang relevan
        // Misalnya, daftar pekerjaan yang pending, approved, dll.
        modalContent.innerHTML = `<p>Showing details for <strong>${category}</strong> applications. Implement data loading here.</p>
                                  <p class="mt-2 text-xs text-gray-400">This is a placeholder. You would typically fetch and display a list or more detailed statistics related to '${category}'.</p>`;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => modalContentContainer.classList.add('scale-100'), 20); // Untuk animasi
    }

    function closeDashboardModal() {
        const modal = document.getElementById('jobModalDashboard');
        const modalContentContainer = document.getElementById('jobModalDashboardContent');
        modalContentContainer.classList.remove('scale-100'); // Untuk animasi
        setTimeout(() => modal.classList.add('hidden'), 250);
    }

    // Toast function khusus untuk dashboard jika perlu
    function showToastDashboard(message, type = 'info') {
        const toastId = 'dashboardToast';
        let toast = document.getElementById(toastId);
        if (!toast) {
            toast = document.createElement('div');
            toast.id = toastId;
            toast.className = 'fixed top-5 right-5 text-white px-5 py-3 rounded-lg shadow-xl transform translate-x-[120%] transition-transform duration-300 ease-out z-[70] text-sm';
            document.body.appendChild(toast);
        }

        toast.textContent = message;
        toast.classList.remove('bg-blue-500', 'bg-green-600', 'bg-red-600', 'translate-x-[120%]');

        if (type === 'success') toast.classList.add('bg-green-600');
        else if (type === 'error') toast.classList.add('bg-red-600');
        else toast.classList.add('bg-blue-500'); // Default info

        toast.classList.add('translate-x-0'); // Show

        setTimeout(() => {
            toast.classList.remove('translate-x-0');
            toast.classList.add('translate-x-[120%]'); // Hide
        }, 3000);
    }

</script>
@endpush
