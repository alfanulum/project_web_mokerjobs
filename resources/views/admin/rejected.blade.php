@extends('layouts.admin_app')

@section('title', 'Rejected Job Applications')

@push('styles')
<style>
    /* Style serupa dengan approved.blade.php atau processed.blade.php */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .fade-in { animation: fadeIn 0.5s ease-out forwards; }

    .custom-scrollbar-page::-webkit-scrollbar { width: 8px; height: 8px; }
    .custom-scrollbar-page::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
    .custom-scrollbar-page::-webkit-scrollbar-thumb { background: #fbbf24; border-radius: 10px; }
    .custom-scrollbar-page::-webkit-scrollbar-thumb:hover { background: #f59e0b; }
    
    .sort-arrow { opacity: 0.4; display: inline-block; transition: opacity 0.2s; font-size: 0.9em; margin-left: 2px; }
    th:hover .sort-arrow { opacity: 1; }

    #jobTable th,
    #jobTable td {
        border-right: 1px solid #e5e7eb; /* Tailwind gray-200 */
    }
     #jobTable th:first-child,
    #jobTable td:first-child {
        border-left: none;
    }
    #jobTable th:last-child,
    #jobTable td:last-child {
        border-right: none;
    }
</style>
@endpush

@section('content')
@php
    $rejectedJobs = $rejectedJobs ?? collect();
    $isPaginator = $rejectedJobs instanceof \Illuminate\Pagination\LengthAwarePaginator;
    // $availableCategories = $availableCategories ?? [];
@endphp

<div class="fade-in">
    <div class="flex flex-col sm:flex-row justify-between items-start mb-6">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Rejected Job Applications</h1>
            <p class="text-gray-500 mt-1 text-sm lg:text-base">List of all job applications that have been rejected.</p>
        </div>
         <div class="flex items-center space-x-3 mt-3 sm:mt-0">
            <button onclick="refreshPageData()" class="bg-blue-500 text-white p-2.5 rounded-md hover:bg-blue-600 transition-colors shadow-sm flex items-center text-sm font-medium">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m-15.357-2a8.001 8.001 0 0015.357 2M9 15h4.581"></path></svg>
                Refresh
            </button>
        </div>
    </div>

    {{-- Pesan Sukses/Error dari Session --}}
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

    <div class="bg-white rounded-lg shadow-md p-4 sm:p-6 mb-6">
        <div class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4 items-center">
            <div class="flex-1 min-w-full sm:min-w-64">
                <input type="text" id="searchInputRejected" placeholder="Search rejected jobs..."
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-300 text-sm"
                       oninput="filterRejectedTableClientSide()">
            </div>
            <select id="categoryFilterRejected" onchange="filterRejectedTableClientSide()" class="w-full sm:w-auto px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-300 text-sm">
                <option value="">All Categories</option>
                {{-- @foreach($availableCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach --}}
                 <option value="Admin & Operations">Admin & Operations</option>
                <option value="Business Dev & Sales">Business Dev & Sales</option>
                {{-- Tambahkan kategori lain --}}
            </select>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-xl overflow-hidden">
        <div class="flex flex-col sm:flex-row justify-between items-center px-6 py-4 border-b border-gray-200 bg-white">
            <h2 class="text-xl font-semibold text-gray-700 mb-2 sm:mb-0">Rejected Jobs Table</h2>
            <div class="flex items-center space-x-3 sm:space-x-4">
                <span class="text-xs sm:text-sm text-gray-500">
                    <span id="visibleRowsRejected">{{ $rejectedJobs->count() }}</span> of <span id="totalRowsRejected">{{ $isPaginator ? $rejectedJobs->total() : $rejectedJobs->count() }}</span> rows
                </span>
                <button onclick="exportRejectedData()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-xs font-semibold shadow-sm hover:shadow-md transition-colors duration-300">
                    Export CSV
                </button>
            </div>
        </div>

        <div class="overflow-x-auto custom-scrollbar-page">
            <table class="w-full min-w-max" id="jobTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200 cursor-pointer hover:bg-gray-100" onclick="sortTableClientSide(0, 'rejected')">
                            No. <span class="sort-arrow">⇅</span>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200 cursor-pointer hover:bg-gray-100" onclick="sortTableClientSide(1, 'rejected')">
                            Job Name <span class="sort-arrow">⇅</span>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200 cursor-pointer hover:bg-gray-100" onclick="sortTableClientSide(2, 'rejected')">
                            Company Name <span class="sort-arrow">⇅</span>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200 cursor-pointer hover:bg-gray-100" onclick="sortTableClientSide(3, 'rejected')">
                            Category <span class="sort-arrow">⇅</span>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">Company Email</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">Actions</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">Detail</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="tableBodyRejected">
                    @forelse ($rejectedJobs as $index => $job)
                    @continue(!is_object($job))
                    <tr class="hover:bg-slate-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $isPaginator ? ($rejectedJobs->firstItem() + $index) : ($index + 1) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-medium">{{ $job->job_name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $job->company_name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <span class="px-2 py-1 bg-sky-100 text-sky-700 rounded-full text-xs font-medium">{{ $job->category_job ?? 'N/A' }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <a href="mailto:{{ $job->company_email ?? '#' }}" class="text-orange-600 hover:text-orange-700 hover:underline">{{ $job->company_email ?? 'N/A' }}</a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-700">
                                Rejected
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center space-x-2">
                            @if(isset($job->id))
                            <form action="{{ route('admin.processed.update_status', $job->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="pending">
                                <button type="submit" title="Set to Pending" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-2.5 py-1 rounded-md text-xs font-semibold shadow-sm hover:shadow transition-all duration-200">
                                    Pending
                                </button>
                            </form>
                            <form action="{{ route('admin.processed.update_status', $job->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="accept">
                                <button type="submit" title="Approve Application" class="bg-yellow-400 hover:bg-yellow-500 text-yellow-800 px-2.5 py-1 rounded-md text-xs font-semibold shadow-sm hover:shadow transition-all duration-200">
                                    Approve
                                </button>
                            </form>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                            <button onclick="showJobDetailsModal({{ json_encode($job) }})" class="bg-orange-500 hover:bg-orange-600 text-white px-2.5 py-1 rounded-md text-xs font-semibold shadow-sm hover:shadow transition-all duration-200">
                                Detail
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 whitespace-nowrap text-sm text-gray-500 text-center">
                            No rejected job applications found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($isPaginator && $rejectedJobs->hasPages())
    <div class="mt-6 p-4 bg-white rounded-lg shadow-lg">
        {{ $rejectedJobs->links() }}
    </div>
    @endif
</div>

{{-- Modal (gunakan struktur modal yang sama dengan approved) --}}
<div id="jobDetailModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm hidden items-center justify-center z-[60]">
    <div class="bg-white p-5 sm:p-6 rounded-xl shadow-2xl max-w-lg w-full mx-4 transform transition-all duration-300 ease-out scale-95" id="jobDetailModalContent">
        <div class="flex justify-between items-center mb-4">
            <h3 id="modalJobTitle" class="text-lg font-semibold text-gray-800">Job Details</h3>
            <button onclick="closeJobDetailsModal()" class="text-gray-400 hover:text-gray-600 text-2xl p-1 rounded-full hover:bg-gray-100 transition-colors">&times;</button>
        </div>
        <div id="modalJobBody" class="text-sm text-gray-600 max-h-[60vh] overflow-y-auto custom-scrollbar-page pr-2">
            {{-- Konten detail akan diisi oleh JavaScript --}}
        </div>
         <div class="mt-5 text-right">
            <button onclick="closeJobDetailsModal()" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-md text-xs font-medium transition-colors">Close</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let clientSideRejectedJobs = @json($isPaginator ? $rejectedJobs->items() : $rejectedJobs->all());
    const originalRejectedDataFromServer = @json($isPaginator ? $rejectedJobs->items() : $rejectedJobs->all());
    const firstRejectedItemNumber = {{ $isPaginator ? ($rejectedJobs->firstItem() ?? 1) : 1 }};

    document.addEventListener('DOMContentLoaded', function() {
        updateTableStatsRejected(clientSideRejectedJobs.length, {{ $isPaginator ? $rejectedJobs->total() : $rejectedJobs->count() }});
    });

    function updateTableStatsRejected(visible, total) {
        document.getElementById('visibleRowsRejected').textContent = visible;
        document.getElementById('totalRowsRejected').textContent = total;
    }

    function refreshPageData() {
        window.location.reload();
    }

    function exportRejectedData() {
        const dataForExport = clientSideRejectedJobs;
        if (dataForExport.length === 0) {
            alert('No data to export.'); return;
        }
        const csvContent = "data:text/csv;charset=utf-8,"
            + "No,Job Name,Company,Category,Company Email,Status\n"
            + dataForExport.map((job, index) => {
                let itemNumber = index + 1;
                 if ({{ $isPaginator ? 'true' : 'false' }}) {
                    const originalIndex = originalRejectedDataFromServer.findIndex(orig => orig.id === job.id);
                    if (originalIndex !== -1) itemNumber = firstRejectedItemNumber + originalIndex;
                }
                return `${itemNumber},"${job.job_name || ''}","${job.company_name || ''}","${job.category_job || ''}","${job.company_email || ''}","rejected"`
            }).join("\n");
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "rejected_jobs.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    // Fungsi showJobDetailsModal dan closeJobDetailsModal bisa di-share atau di-include dari file JS terpisah
    // Jika sama persis dengan halaman approved, Anda bisa meletakkannya di app.js atau layout.
    // Untuk saat ini, saya duplikasi agar setiap file mandiri.
    function showJobDetailsModal(job) {
        if (!job) return;
        document.getElementById('modalJobTitle').textContent = `${job.job_name || 'N/A'} - ${job.company_name || 'N/A'}`;
        document.getElementById('modalJobBody').innerHTML = `
            <div class="space-y-3">
                <div><strong class="text-gray-500">Job Name:</strong><p class="text-gray-800 bg-slate-50 p-2 rounded-md mt-0.5">${job.job_name || 'N/A'}</p></div>
                <div><strong class="text-gray-500">Company:</strong><p class="text-gray-800 bg-slate-50 p-2 rounded-md mt-0.5">${job.company_name || 'N/A'}</p></div>
                <div><strong class="text-gray-500">Category:</strong><p class="text-gray-800 bg-slate-50 p-2 rounded-md mt-0.5">${job.category_job || 'N/A'}</p></div>
                <div><strong class="text-gray-500">Email:</strong><p class="text-gray-800 bg-slate-50 p-2 rounded-md mt-0.5">${job.company_email || 'N/A'}</p></div>
                <div><strong class="text-gray-500">Status:</strong><p class="text-red-600 font-semibold bg-red-50 p-2 rounded-md mt-0.5">Rejected</p></div>
                ${job.job_description ? `<div><strong class="text-gray-500">Description:</strong><div class="text-gray-800 bg-slate-50 p-2 rounded-md mt-0.5 max-h-28 overflow-y-auto custom-scrollbar-page">${job.job_description.replace(/\n/g, '<br>')}</div></div>` : ''}
            </div>
        `;
        const modal = document.getElementById('jobDetailModal');
        const modalContent = document.getElementById('jobDetailModalContent');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => modalContent.classList.remove('scale-95'), 10);
        setTimeout(() => modalContent.classList.add('scale-100'), 20);
    }

    function closeJobDetailsModal() {
        const modal = document.getElementById('jobDetailModal');
        const modalContent = document.getElementById('jobDetailModalContent');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 250);
    }

    let currentSortDirectionRejected = {};
    function renderRejectedTableClientSide(dataToRender) {
        const tbody = document.getElementById('tableBodyRejected');
        tbody.innerHTML = '';
        if (dataToRender.length === 0) {
            tbody.innerHTML = `<tr><td colspan="8" class="px-6 py-12 whitespace-nowrap text-sm text-gray-500 text-center">No matching rejected jobs found.</td></tr>`;
            updateTableStatsRejected(0, originalRejectedDataFromServer.length);
            return;
        }

        dataToRender.forEach((job, loopIndex) => {
            let itemNumber = loopIndex + 1;
            if ({{ $isPaginator ? 'true' : 'false' }}) {
                const originalIndex = originalRejectedDataFromServer.findIndex(orig => orig.id === job.id);
                if (originalIndex !== -1) itemNumber = firstRejectedItemNumber + originalIndex;
                else itemNumber = firstRejectedItemNumber + loopIndex; // Fallback
            }
            const row = document.createElement('tr');
            row.className = 'hover:bg-slate-50 transition-colors duration-150';
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${itemNumber}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-medium">${job.job_name || 'N/A'}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${job.company_name || 'N/A'}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                    <span class="px-2 py-1 bg-sky-100 text-sky-700 rounded-full text-xs font-medium">${job.category_job || 'N/A'}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                    <a href="mailto:${job.company_email || '#'}" class="text-orange-600 hover:text-orange-700 hover:underline">${job.company_email || 'N/A'}</a>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-700">Rejected</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center space-x-2">
                     ${job.id ? `
                    <button onclick="alert('Implement server-side action to set job ID ${job.id} to Pending.')" title="Set to Pending" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-2.5 py-1 rounded-md text-xs font-semibold shadow-sm">Pending</button>
                    <button onclick="alert('Implement server-side action to Approve job ID ${job.id}.')" title="Approve Application" class="bg-yellow-400 hover:bg-yellow-500 text-yellow-800 px-2.5 py-1 rounded-md text-xs font-semibold shadow-sm">Approve</button>
                    ` : ''}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                    <button onclick='showJobDetailsModal(${JSON.stringify(job)})' class="bg-orange-500 hover:bg-orange-600 text-white px-2.5 py-1 rounded-md text-xs font-semibold shadow-sm">Detail</button>
                </td>
            `;
            tbody.appendChild(row);
        });
        updateTableStatsRejected(dataToRender.length, originalRejectedDataFromServer.length);
    }

    function filterRejectedTableClientSide() {
        const searchTerm = document.getElementById('searchInputRejected').value.toLowerCase();
        const categoryFilter = document.getElementById('categoryFilterRejected').value;

        const filtered = originalRejectedDataFromServer.filter(job => {
            const matchesSearch = !searchTerm ||
                (job.job_name && job.job_name.toLowerCase().includes(searchTerm)) ||
                (job.company_name && job.company_name.toLowerCase().includes(searchTerm)) ||
                (job.category_job && job.category_job.toLowerCase().includes(searchTerm));
            const matchesCategory = !categoryFilter || job.category_job === categoryFilter;
            return matchesSearch && matchesCategory;
        });
        renderRejectedTableClientSide(filtered);
    }
    
    // Anda bisa menggunakan fungsi sortTableClientSide yang sama dari approved.blade.php jika Anda membuatnya lebih generik
    // atau duplikasi dan sesuaikan untuk 'rejected'
    function sortTableClientSide(columnIndex, type) {
        let dataToSort;
        let sortDirectionObject;
        let originalDataSource;
        let firstItemNum;
        let renderFunction;
        let searchInputId, categoryFilterId;

        if (type === 'approved') { // Ini seharusnya tidak terpanggil di halaman rejected, tapi untuk struktur
            // ... (logika untuk approved)
        } else if (type === 'rejected') {
            dataToSort = [...originalRejectedDataFromServer];
            sortDirectionObject = currentSortDirectionRejected; // Pastikan ini didefinisikan: let currentSortDirectionRejected = {};
            originalDataSource = originalRejectedDataFromServer;
            firstItemNum = firstRejectedItemNumber;
            renderFunction = renderRejectedTableClientSide;
            searchInputId = 'searchInputRejected';
            categoryFilterId = 'categoryFilterRejected';
        } else {
            return; // Tipe tidak diketahui
        }

        const searchTerm = document.getElementById(searchInputId).value.toLowerCase();
        const categoryFilter = document.getElementById(categoryFilterId).value;

        dataToSort = dataToSort.filter(job => {
            const matchesSearch = !searchTerm ||
                (job.job_name && job.job_name.toLowerCase().includes(searchTerm)) ||
                (job.company_name && job.company_name.toLowerCase().includes(searchTerm)) ||
                (job.category_job && job.category_job.toLowerCase().includes(searchTerm));
            const matchesCategory = !categoryFilter || job.category_job === categoryFilter;
            return matchesSearch && matchesCategory;
        });

        const fields = ['id', 'job_name', 'company_name', 'category_job'];
        const field = fields[columnIndex];
        if (!field) return;

        sortDirectionObject[field] = sortDirectionObject[field] === 'asc' ? 'desc' : 'asc';

        dataToSort.sort((a, b) => {
            let aVal, bVal;
            if (field === 'id') {
                const indexA = originalDataSource.findIndex(orig => orig.id === a.id);
                const indexB = originalDataSource.findIndex(orig => orig.id === b.id);
                aVal = a.id !== undefined ? (firstItemNum + indexA) : (firstItemNum + originalDataSource.indexOf(a));
                bVal = b.id !== undefined ? (firstItemNum + indexB) : (firstItemNum + originalDataSource.indexOf(b));
            } else {
                aVal = a[field] || '';
                bVal = b[field] || '';
            }
            
            if (typeof aVal === 'string' && typeof bVal === 'string') {
                aVal = aVal.toLowerCase();
                bVal = bVal.toLowerCase();
            } else if (typeof aVal === 'number' && typeof bVal === 'number') { /* No change */ }
            else { aVal = String(aVal).toLowerCase(); bVal = String(bVal).toLowerCase(); }

            if (aVal < bVal) return sortDirectionObject[field] === 'asc' ? -1 : 1;
            if (aVal > bVal) return sortDirectionObject[field] === 'asc' ? 1 : -1;
            return 0;
        });
        renderFunction(dataToSort);
    }


</script>
@endpush
