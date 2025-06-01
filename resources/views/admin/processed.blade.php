@extends('layouts.admin_app') {{-- Sesuaikan dengan layout admin utama Anda --}}

@section('title', 'Pengelolaan Ajuan Lowongan')

@section('content')
@php
    $safeLowonganList = $lowonganList ?? collect();
    $isPaginator = $safeLowonganList instanceof \Illuminate\Pagination\LengthAwarePaginator;
@endphp
<div class="flex-1 fade-in"> {{-- Asumsi layout admin_app sudah punya padding seperti p-8 --}}
    <div class="flex flex-col sm:flex-row justify-between items-start mb-8">
        <div>
            <h1 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-1 sm:mb-2 bg-gradient-to-r from-orange-500 to-orange-600 bg-clip-text text-transparent">
                Admin Dashboard
            </h1>
            <p class="text-gray-500 text-base lg:text-lg">Verification of submitted job applications</p>
        </div>
        <div class="flex space-x-3 sm:space-x-4 mt-4 sm:mt-0">
            <div id="newBadge" class="bg-yellow-400 text-yellow-800 px-4 sm:px-6 py-2 sm:py-3 rounded-md font-semibold shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105 pulse-animation text-sm sm:text-base">
                <span id="newCount">{{ $newApplicationsCount ?? 0 }}</span> New
            </div>
            <button onclick="refreshData()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-md font-semibold shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105 text-sm sm:text-base flex items-center">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                </svg>
                Refresh
            </button>
        </div>
    </div>

    {{-- Menampilkan pesan sukses atau error dari session --}}
    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-4 shadow-md fade-in" role="alert">
        <p class="font-bold">Success</p>
        <p>{{ session('success') }}</p>
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded mb-4 shadow-md fade-in" role="alert">
        <p class="font-bold">Error</p>
        <p>{{ session('error') }}</p>
    </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-4 sm:p-6 mb-6 fade-in">
        <div class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4 items-center">
            <div class="flex-1 min-w-full sm:min-w-64">
                <input type="text" id="searchInput" placeholder="Search jobs, companies, categories..."
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-300 text-sm"
                       oninput="filterTableClientSide()">
            </div>
            <select id="categoryFilter" onchange="filterTableClientSide()" class="w-full sm:w-auto px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-300 text-sm">
                <option value="">All Categories</option>
                <option value="Admin & Operations">Admin & Operations</option>
                <option value="Business Dev & Sales">Business Dev & Sales</option>
                <option value="CS & Hospitality">CS & Hospitality</option>
                <option value="Data & Product">Data & Product</option>
                <option value="Design & Creative">Design & Creative</option>
                <option value="Education & Training">Education & Training</option>
                <option value="Finance & Accounting">Finance & Accounting</option>
                <option value="Food & Beverage">Food & Beverage</option>
            </select>
            <select id="statusFilter" onchange="filterTableClientSide()" class="w-full sm:w-auto px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-300 text-sm">
                <option value="">All Status</option>
                <option value="accept">Approved</option>
                <option value="decline">Rejected</option>
                <option value="pending">Pending</option>
            </select>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-xl overflow-hidden fade-in">
        <div class="flex flex-col sm:flex-row justify-between items-center px-6 py-4 border-b border-gray-200 bg-white">
            <h2 class="text-xl font-semibold text-gray-700 mb-2 sm:mb-0">Processed Table</h2>
            <div class="flex items-center space-x-3 sm:space-x-4">
                <span class="text-xs sm:text-sm text-gray-500">
                    <span id="visibleRows">{{ $safeLowonganList->count() }}</span> of <span id="totalRowsServer">{{ $isPaginator ? $safeLowonganList->total() : $safeLowonganList->count() }}</span> rows
                </span>
                <button onclick="exportData()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-xs font-semibold shadow-sm hover:shadow-md transition-colors duration-300">
                    Export CSV
                </button>
            </div>
        </div>

        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full min-w-max" id="jobTable"> {{-- min-w-max untuk scrolling horizontal jika perlu --}}
                <thead class="bg-gray-50"> {{-- Latar belakang header tabel lebih terang --}}
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200 cursor-pointer hover:bg-gray-100" onclick="sortTableClientSide(0)">
                            Num <span class="sort-arrow">⇅</span>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200 cursor-pointer hover:bg-gray-100" onclick="sortTableClientSide(1)">
                            Job Name <span class="sort-arrow">⇅</span>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200 cursor-pointer hover:bg-gray-100" onclick="sortTableClientSide(2)">
                            Company Name <span class="sort-arrow">⇅</span>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200 cursor-pointer hover:bg-gray-100" onclick="sortTableClientSide(3)">
                            Category <span class="sort-arrow">⇅</span>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">Company Email</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">Actions</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">Detail</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
                    @forelse ($safeLowonganList as $index => $lowongan)
                    @continue(!is_object($lowongan))
                    <tr class="hover:bg-slate-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $isPaginator ? ($safeLowonganList->firstItem() + $index) : ($index + 1) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-medium">{{ $lowongan->job_name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $lowongan->company_name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <span class="px-2 py-1 bg-sky-100 text-sky-700 rounded-full text-xs font-medium">{{ $lowongan->category_job ?? 'N/A' }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <a href="mailto:{{ $lowongan->company_email ?? '#' }}" class="text-orange-600 hover:text-orange-700 hover:underline">{{ $lowongan->company_email ?? 'N/A' }}</a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if(isset($lowongan->status) && $lowongan->status == 'accept') bg-green-100 text-green-700
                                @elseif(isset($lowongan->status) && $lowongan->status == 'decline') bg-red-100 text-red-700
                                @elseif(isset($lowongan->status) && $lowongan->status == 'pending') bg-yellow-100 text-yellow-700
                                @else bg-gray-100 text-gray-700 @endif">
                                {{ ucfirst($lowongan->status ?? 'N/A') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center space-x-2">
                            @if(isset($lowongan->status) && $lowongan->status != 'accept' && isset($lowongan->id))
                            <form action="{{ route('admin.processed.update_status', $lowongan->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="accept">
                                <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-yellow-800 px-2.5 py-1 rounded-md text-xs font-semibold shadow-sm hover:shadow transition-all duration-200 transform hover:scale-105">
                                    Approve
                                </button>
                            </form>
                            @endif
                            @if(isset($lowongan->status) && $lowongan->status != 'decline' && isset($lowongan->id))
                            <form action="{{ route('admin.processed.update_status', $lowongan->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="decline">
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-2.5 py-1 rounded-md text-xs font-semibold shadow-sm hover:shadow transition-all duration-200 transform hover:scale-105">
                                    Reject
                                </button>
                            </form>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                            <button onclick="showJobDetails({{ json_encode($lowongan) }})" class="bg-orange-500 hover:bg-orange-600 text-white px-2.5 py-1 rounded-md text-xs font-semibold shadow-sm hover:shadow transition-all duration-200 transform hover:scale-105">
                                Detail
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 whitespace-nowrap text-sm text-gray-500 text-center">
                            Tidak ada data ajuan lowongan yang perlu diproses atau ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($isPaginator && $safeLowonganList->hasPages())
    <div class="mt-6 p-4 bg-white rounded-lg shadow-lg">
        {{ $safeLowonganList->links() }}
    </div>
    @endif
</div>

<div id="jobModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm hidden z-50" onclick="closeModal()">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full transform transition-all duration-300 ease-out scale-95" onclick="event.stopPropagation()" id="modalContent">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800" id="modalTitle">Detail Lowongan</h3>
            </div>
            <div class="p-6 custom-scrollbar overflow-y-auto max-h-[70vh]" id="modalBody">
                </div>
            <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                <button onclick="closeModal()" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg text-sm font-medium transition-colors duration-200">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<div id="toast" class="fixed top-5 right-5 bg-green-600 text-white px-5 py-3 rounded-lg shadow-xl transform translate-x-[120%] transition-transform duration-300 ease-out z-[100] text-sm">
    <span id="toastMessage">Aksi berhasil!</span>
</div>
@endsection

@push('styles')
<style>
    @keyframes slideIn {
        from { transform: translateX(-100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes pulse {
        0%, 100% { transform: scale(1); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06); }
        50% { transform: scale(1.03); box-shadow: 0 10px 15px -3px rgba(251, 191, 36, 0.4), 0 4px 6px -2px rgba(251, 191, 36, 0.2); }
    }
    .slide-in { animation: slideIn 0.4s ease-out forwards; }
    .fade-in { animation: fadeIn 0.5s ease-out forwards; }
    .pulse-animation { animation: pulse 2.5s infinite ease-in-out; }

    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #edf2f7; /* gray-200 */
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #a0aec0; /* gray-500 */
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #718096; /* gray-600 */
    }
    .sort-arrow {
        opacity: 0.4;
        display: inline-block;
        transition: opacity 0.2s;
        font-size: 0.9em;
        margin-left: 2px;
    }
    th:hover .sort-arrow {
        opacity: 1;
    }
    /* Menghapus border kanan pada TH dan TD terakhir agar lebih mirip gambar */
    /* #jobTable thead th:last-child,
    #jobTable tbody td:last-child {
        border-right: none;
    } */
    /* Memberi border pada semua sel untuk tampilan grid yang jelas */
    #jobTable th,
    #jobTable td {
        border-right: 1px solid #e5e7eb; /* Tailwind gray-200 */
    }
     #jobTable th:first-child,
    #jobTable td:first-child {
        border-left: none; /* Hapus border kiri pada kolom pertama jika card tabel tidak punya padding horizontal internal */
    }
    #jobTable th:last-child,
    #jobTable td:last-child {
        border-right: none; /* Hapus border kanan pada kolom terakhir */
    }


</style>
@endpush

@push('scripts')
<script>
    const IS_PAGINATOR = {{ $isPaginator ? 'true' : 'false' }};
    let clientSideJobData = @json($isPaginator ? $safeLowonganList->items() : $safeLowonganList->all());
    let currentSortDirection = {};
    const originalDataFromServer = @json($isPaginator ? $safeLowonganList->items() : $safeLowonganList->all());
    const firstItemNumber = {{ $isPaginator ? $safeLowonganList->firstItem() ?? 1 : 1 }};


    document.addEventListener('DOMContentLoaded', function() {
        updateTableStats(
            clientSideJobData.length,
            {{ $isPaginator ? $safeLowonganList->total() : $safeLowonganList->count() }}
        );

        @if(session('success'))
            showToast("{{ session('success') }}", 'success');
        @endif
        @if(session('error'))
            showToast("{{ session('error') }}", 'error');
        @endif
    });

    function updateTableStats(visible, total) {
        document.getElementById('visibleRows').textContent = visible;
        document.getElementById('totalRowsServer').textContent = total;
    }

    function showJobDetails(job) {
        if (job) {
            document.getElementById('modalTitle').textContent = `${job.job_name || 'N/A'} - ${job.company_name || 'N/A'}`;
            document.getElementById('modalBody').innerHTML = `
                <div class="space-y-4 text-sm">
                    <div>
                        <label class="block font-semibold text-gray-500 mb-0.5">Nama Pekerjaan</label>
                        <p class="text-gray-800 bg-slate-50 p-2.5 rounded-md ">${job.job_name || 'N/A'}</p>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-500 mb-0.5">Perusahaan</label>
                        <p class="text-gray-800 bg-slate-50 p-2.5 rounded-md ">${job.company_name || 'N/A'}</p>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-500 mb-0.5">Kategori</label>
                        <p class="text-gray-800 bg-slate-50 p-2.5 rounded-md ">${job.category_job || 'N/A'}</p>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-500 mb-0.5">Status</label>
                        <p class="text-gray-800 bg-slate-50 p-2.5 rounded-md  capitalize">${job.status || 'N/A'}</p>
                    </div>
                    <div class="col-span-full">
                        <label class="block font-semibold text-gray-500 mb-0.5">Email Perusahaan</label>
                        <p class="text-gray-800 bg-slate-50 p-2.5 rounded-md ">${job.company_email || 'N/A'}</p>
                    </div>
                    <div class="col-span-full">
                        <label class="block font-semibold text-gray-500 mb-0.5">Deskripsi Pekerjaan</label>
                        <div class="text-gray-800 bg-slate-50 p-2.5 rounded-md  max-h-32 overflow-y-auto custom-scrollbar">
                            ${job.job_description ? job.job_description.replace(/\n/g, '<br>') : 'N/A'}
                        </div>
                    </div>
                     <div class="col-span-full">
                        <label class="block font-semibold text-gray-500 mb-0.5">Alamat Perusahaan</label>
                        <p class="text-gray-800 bg-slate-50 p-2.5 rounded-md ">${job.company_address || 'N/A'}</p>
                    </div>
                </div>
            `;

            const modal = document.getElementById('jobModal');
            const modalContent = document.getElementById('modalContent');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => { // Untuk transisi
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            } , 20);
        }
    }

    function closeModal() {
        const modal = document.getElementById('jobModal');
        const modalContent = document.getElementById('modalContent');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 250); // Sesuaikan dengan durasi transisi
    }

    function showToast(message, type = 'success') {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toastMessage');
        toastMessage.textContent = message;

        toast.classList.remove('bg-green-600', 'bg-red-600', 'translate-x-[120%]');
        if (type === 'error') {
            toast.classList.add('bg-red-600');
        } else {
            toast.classList.add('bg-green-600');
        }
        toast.classList.remove('translate-x-[120%]'); // Show
        toast.classList.add('translate-x-0');

        setTimeout(() => {
            toast.classList.remove('translate-x-0');
            toast.classList.add('translate-x-[120%]'); // Hide
        }, 3000);
    }

    function setActiveTab(tabName) { /* ... implementasi jika sidebar diatur dari sini ... */ }

    function refreshData() {
        showToast('Refreshing data...');
        setTimeout(() => { window.location.reload(); }, 800);
    }

    function exportData() {
        const dataForExport = clientSideJobData;
        if (dataForExport.length === 0) {
            showToast('No data to export.', 'error');
            return;
        }
        const csvContent = "data:text/csv;charset=utf-8,"
            + "No,Job Name,Company,Category,Company Email,Status\n"
            + dataForExport.map((job, index) => {
                let itemNumber = index + 1;
                // Jika paginasi dan ingin nomor global, perlu logika lebih kompleks atau data ID asli
                // Untuk CSV, nomor urut sederhana dari data yang diexport biasanya cukup
                return `${itemNumber},"${job.job_name || ''}","${job.company_name || ''}","${job.category_job || ''}","${job.company_email || ''}","${job.status || ''}"`
            }).join("\n");
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "job_applications_processed.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        showToast('Data exported successfully!');
    }

    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && (e.key === 'k' || e.key === 'K')) {
            e.preventDefault();
            document.getElementById('searchInput').focus();
        }
        if (e.key === 'Escape') {
            if (!document.getElementById('jobModal').classList.contains('hidden')) {
                closeModal();
            }
        }
    });

    function renderClientSideTable(dataToRender) {
        const tbody = document.getElementById('tableBody');
        tbody.innerHTML = '';
        if (dataToRender.length === 0) {
            tbody.innerHTML = `<tr><td colspan="8" class="px-6 py-12 whitespace-nowrap text-sm text-gray-500 text-center">No matching records found.</td></tr>`;
            updateTableStats(0, originalDataFromServer.length);
            return;
        }

        dataToRender.forEach((lowongan, loopIndex) => {
            let itemNumber = loopIndex + 1;
            if (IS_PAGINATOR) {
                const originalIndex = originalDataFromServer.findIndex(orig => orig.id === lowongan.id);
                if (originalIndex !== -1) {
                     itemNumber = firstItemNumber + originalIndex;
                } else { // Fallback jika tidak ditemukan di original (seharusnya tidak terjadi jika data konsisten)
                    itemNumber = firstItemNumber + loopIndex;
                }
            }

            const row = document.createElement('tr');
            row.className = 'hover:bg-slate-50 transition-colors duration-150';
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${itemNumber}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-medium">${lowongan.job_name || 'N/A'}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${lowongan.company_name || 'N/A'}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                    <span class="px-2 py-1 bg-sky-100 text-sky-700 rounded-full text-xs font-medium">${lowongan.category_job || 'N/A'}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                    <a href="mailto:${lowongan.company_email || '#'}" class="text-orange-600 hover:text-orange-700 hover:underline">${lowongan.company_email || 'N/A'}</a>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ${ (lowongan.status === 'accept') ? 'bg-green-100 text-green-700' : (lowongan.status === 'decline') ? 'bg-red-100 text-red-700' : (lowongan.status === 'pending') ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-700'}">
                        ${lowongan.status ? lowongan.status.charAt(0).toUpperCase() + lowongan.status.slice(1) : 'N/A'}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center space-x-2">
                    ${ (lowongan.status !== 'accept' && lowongan.id) ? `<button onclick="alert('Server-side action required for Approve. Job ID: ${lowongan.id}.')" class="bg-yellow-400 hover:bg-yellow-500 text-yellow-800 px-2.5 py-1 rounded-md text-xs font-semibold shadow-sm hover:shadow">Approve</button>` : ''}
                    ${ (lowongan.status !== 'decline' && lowongan.id) ? `<button onclick="alert('Server-side action required for Reject. Job ID: ${lowongan.id}.')" class="bg-red-500 hover:bg-red-600 text-white px-2.5 py-1 rounded-md text-xs font-semibold shadow-sm hover:shadow">Reject</button>` : ''}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                    <button onclick='showJobDetails(${JSON.stringify(lowongan)})' class="bg-orange-500 hover:bg-orange-600 text-white px-2.5 py-1 rounded-md text-xs font-semibold shadow-sm hover:shadow">Detail</button>
                </td>
            `;
            tbody.appendChild(row);
        });
        updateTableStats(dataToRender.length, originalDataFromServer.length);
    }

    function filterTableClientSide() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const categoryFilter = document.getElementById('categoryFilter').value;
        const statusFilter = document.getElementById('statusFilter').value;

        const filtered = originalDataFromServer.filter(job => {
            const matchesSearch = !searchTerm ||
                (job.job_name && job.job_name.toLowerCase().includes(searchTerm)) ||
                (job.company_name && job.company_name.toLowerCase().includes(searchTerm)) ||
                (job.category_job && job.category_job.toLowerCase().includes(searchTerm));
            const matchesCategory = !categoryFilter || job.category_job === categoryFilter;
            const matchesStatus = !statusFilter || job.status === statusFilter;
            return matchesSearch && matchesCategory && matchesStatus;
        });
        renderClientSideTable(filtered);
    }

    function sortTableClientSide(columnIndex) {
        const fields = ['id', 'job_name', 'company_name', 'category_job'];
        const field = fields[columnIndex];
        if (!field) return;

        currentSortDirection[field] = currentSortDirection[field] === 'asc' ? 'desc' : 'asc';
        
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const categoryFilter = document.getElementById('categoryFilter').value;
        const statusFilter = document.getElementById('statusFilter').value;
        
        let dataToSort = originalDataFromServer.filter(job => {
            const matchesSearch = !searchTerm ||
                (job.job_name && job.job_name.toLowerCase().includes(searchTerm)) ||
                (job.company_name && job.company_name.toLowerCase().includes(searchTerm)) ||
                (job.category_job && job.category_job.toLowerCase().includes(searchTerm));
            const matchesCategory = !categoryFilter || job.category_job === categoryFilter;
            const matchesStatus = !statusFilter || job.status === statusFilter;
            return matchesSearch && matchesCategory && matchesStatus;
        });

        dataToSort.sort((a, b) => {
            let aVal, bVal;
            if (field === 'id') {
                const indexA = originalDataFromServer.findIndex(orig => orig.id === a.id);
                const indexB = originalDataFromServer.findIndex(orig => orig.id === b.id);
                aVal = a.id !== undefined ? (firstItemNumber + indexA) : (firstItemNumber + originalDataFromServer.indexOf(a));
                bVal = b.id !== undefined ? (firstItemNumber + indexB) : (firstItemNumber + originalDataFromServer.indexOf(b));
            } else {
                aVal = a[field] || '';
                bVal = b[field] || '';
            }
            
            if (typeof aVal === 'string' && typeof bVal === 'string') {
                aVal = aVal.toLowerCase();
                bVal = bVal.toLowerCase();
            } else if (typeof aVal === 'number' && typeof bVal === 'number') { /* No change */ }
            else { aVal = String(aVal).toLowerCase(); bVal = String(bVal).toLowerCase(); }

            if (aVal < bVal) return currentSortDirection[field] === 'asc' ? -1 : 1;
            if (aVal > bVal) return currentSortDirection[field] === 'asc' ? 1 : -1;
            return 0;
        });
        renderClientSideTable(dataToSort);
    }
</script>
@endpush
