<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        .slide-in { animation: slideIn 0.3s ease-out; }
        .fade-in { animation: fadeIn 0.5s ease-out; }
        .pulse-animation { animation: pulse 2s infinite; }
        
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #fbbf24;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #f59e0b;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gradient-to-b from-orange-500 to-orange-600 p-6 shadow-xl slide-in">
            <!-- Logo -->
            <div class="mb-8 text-center">
                <h1 class="text-white text-2xl font-bold hover:scale-105 transition-transform cursor-pointer">
                    maker.jobs
                </h1>
                <div class="w-16 h-1 bg-white mx-auto mt-2 rounded-full opacity-70"></div>
            </div>
            
            <!-- Navigation Menu -->
            <nav class="space-y-3">
                <a href="#" onclick="setActiveTab('home')" id="nav-home" class="nav-item block w-full px-4 py-3 bg-orange-300 bg-opacity-50 text-white rounded-lg text-center hover:bg-opacity-70 transition-all duration-300 transform hover:scale-105">
                    <span class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>
                        <span>Home</span>
                    </span>
                </a>
                <a href="#" onclick="setActiveTab('processed')" id="nav-processed" class="nav-item block w-full px-4 py-3 bg-white text-orange-500 rounded-lg text-center font-medium hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <span class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <span>Processed</span>
                    </span>
                </a>
                <a href="#" onclick="setActiveTab('approved')" id="nav-approved" class="nav-item block w-full px-4 py-3 bg-orange-300 bg-opacity-50 text-white rounded-lg text-center hover:bg-opacity-70 transition-all duration-300 transform hover:scale-105">
                    <span class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>Approved</span>
                    </span>
                </a>
                <a href="#" onclick="setActiveTab('rejected')" id="nav-rejected" class="nav-item block w-full px-4 py-3 bg-orange-300 bg-opacity-50 text-white rounded-lg text-center hover:bg-opacity-70 transition-all duration-300 transform hover:scale-105">
                    <span class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                        <span>Rejected</span>
                    </span>
                </a>
            </nav>

            <!-- Stats Card -->
            <div class="mt-8 bg-white bg-opacity-20 backdrop-blur-sm rounded-lg p-4 fade-in">
                <h3 class="text-white text-sm font-medium mb-2">Quick Stats</h3>
                <div class="space-y-2 text-white text-xs">
                    <div class="flex justify-between">
                        <span>Total Jobs:</span>
                        <span id="totalJobs" class="font-bold">8</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Approved:</span>
                        <span id="approvedCount" class="font-bold text-green-200">0</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Rejected:</span>
                        <span id="rejectedCount" class="font-bold text-red-200">0</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Header -->
            <div class="flex justify-between items-start mb-8 fade-in">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-2 bg-gradient-to-r from-orange-500 to-orange-600 bg-clip-text text-transparent">
                        Admin Dashboard
                    </h1>
                    <p class="text-gray-600 text-lg">verification of submitted job applications</p>
                </div>
                <div class="flex space-x-4">
                    <div id="newBadge" class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-black px-6 py-3 rounded-lg font-medium shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 pulse-animation">
                        <span id="newCount">0</span> New
                    </div>
                    <button onclick="refreshData()" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-lg font-medium shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                        </svg>
                        Refresh
                    </button>
                </div>
            </div>

            <!-- Filter and Search -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6 fade-in">
                <div class="flex flex-wrap gap-4 items-center">
                    <div class="flex-1 min-w-64">
                        <input type="text" id="searchInput" placeholder="Search jobs, companies, categories..." 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300"
                               oninput="filterTable()">
                    </div>
                    <select id="categoryFilter" onchange="filterTable()" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300">
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
                    <select id="statusFilter" onchange="filterTable()" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300">
                        <option value="">All Status</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
            </div>

            <!-- Table Section -->
            <div class="bg-white rounded-lg shadow-xl overflow-hidden fade-in">
                <!-- Table Header -->
                <div class="flex justify-between items-center p-6 border-b border-gray-200 bg-gradient-to-r from-orange-50 to-orange-100">
                    <h2 class="text-2xl font-semibold text-gray-800">Processed Table</h2>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">
                            <span id="visibleRows">8</span> of <span id="totalRows">8</span> rows
                        </span>
                        <button onclick="exportData()" class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-600 transition-colors duration-300">
                            Export CSV
                        </button>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full" id="jobTable">
                        <thead class="bg-gradient-to-r from-orange-200 to-orange-300">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 border-r border-orange-400 cursor-pointer hover:bg-orange-300 transition-colors" onclick="sortTable(0)">
                                    Num <span class="sort-arrow">⇅</span>
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 border-r border-orange-400 cursor-pointer hover:bg-orange-300 transition-colors" onclick="sortTable(1)">
                                    Job Name <span class="sort-arrow">⇅</span>
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 border-r border-orange-400 cursor-pointer hover:bg-orange-300 transition-colors" onclick="sortTable(2)">
                                    Company Name <span class="sort-arrow">⇅</span>
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 border-r border-orange-400 cursor-pointer hover:bg-orange-300 transition-colors" onclick="sortTable(3)">
                                    Category <span class="sort-arrow">⇅</span>
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 border-r border-orange-400">Company Email</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 border-r border-orange-400">Actions</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Detail</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
                            <!-- Rows will be generated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Job Details -->
    <div id="jobModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50" onclick="closeModal()">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-2xl max-w-2xl w-full transform transition-all duration-300 scale-95" onclick="event.stopPropagation()" id="modalContent">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-800" id="modalTitle">Job Details</h3>
                </div>
                <div class="p-6" id="modalBody">
                    <!-- Modal content will be populated by JavaScript -->
                </div>
                <div class="p-6 border-t border-gray-200 flex justify-end space-x-4">
                    <button onclick="closeModal()" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-300">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50">
        <span id="toastMessage">Action completed successfully!</span>
    </div>

    <script>
        // Sample data
        let jobData = [
            {id: 1, jobName: "Job #1", company: "Company A", category: "Admin & Operations", email: "Company1@email.com", status: "pending"},
            {id: 2, jobName: "Job #2", company: "Company B", category: "Business Dev & Sales", email: "Company2@email.com", status: "pending"},
            {id: 3, jobName: "Job #3", company: "Company C", category: "CS & Hospitality", email: "Company3@email.com", status: "pending"},
            {id: 4, jobName: "Job #4", company: "Company D", category: "Data & Product", email: "Company4@email.com", status: "pending"},
            {id: 5, jobName: "Job #5", company: "Company E", category: "Design & Creative", email: "Company5@email.com", status: "pending"},
            {id: 6, jobName: "Job #6", company: "Company F", category: "Education & Training", email: "Company1@email.com", status: "pending"},
            {id: 7, jobName: "Job #7", company: "Company G", category: "Finance & Accounting", email: "Company6@email.com", status: "pending"},
            {id: 8, jobName: "Job #8", company: "Company H", category: "Food & Beverage", email: "Company7@email.com", status: "pending"}
        ];

        let filteredData = [...jobData];
        let sortDirection = {};

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            renderTable();
            updateStats();
        });

        // Render table
        function renderTable() {
            const tbody = document.getElementById('tableBody');
            tbody.innerHTML = '';

            filteredData.forEach((job, index) => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50 transition-colors duration-200 transform hover:scale-[1.01]';
                row.innerHTML = `
                    <td class="px-6 py-4 text-sm text-gray-900 border-r border-gray-200">${job.id}</td>
                    <td class="px-6 py-4 text-sm text-gray-900 border-r border-gray-200 font-medium">${job.jobName}</td>
                    <td class="px-6 py-4 text-sm text-gray-900 border-r border-gray-200">${job.company}</td>
                    <td class="px-6 py-4 text-sm text-gray-900 border-r border-gray-200">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">${job.category}</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900 border-r border-gray-200">
                        <a href="mailto:${job.email}" class="text-blue-600 hover:underline">${job.email}</a>
                    </td>
                    <td class="px-6 py-4 border-r border-gray-200">
                        <div class="flex space-x-2">
                            <button onclick="updateStatus(${job.id}, 'approved')" 
                                    class="bg-yellow-400 text-black px-3 py-1 rounded-full text-xs font-medium hover:bg-yellow-500 transition-all duration-300 transform hover:scale-110 ${job.status === 'approved' ? 'ring-2 ring-yellow-600' : ''}">
                                ${job.status === 'approved' ? '✓ Approved' : 'Approve'}
                            </button>
                            <button onclick="updateStatus(${job.id}, 'rejected')" 
                                    class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-medium hover:bg-red-600 transition-all duration-300 transform hover:scale-110 ${job.status === 'rejected' ? 'ring-2 ring-red-600' : ''}">
                                ${job.status === 'rejected' ? '✓ Rejected' : 'Reject'}
                            </button>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <button onclick="showJobDetails(${job.id})" class="bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-medium hover:bg-orange-600 transition-all duration-300 transform hover:scale-110 hover:shadow-lg">
                            Detail
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });

            document.getElementById('visibleRows').textContent = filteredData.length;
            document.getElementById('totalRows').textContent = jobData.length;
        }

        // Update status
        function updateStatus(jobId, newStatus) {
            const job = jobData.find(j => j.id === jobId);
            if (job) {
                job.status = newStatus;
                renderTable();
                updateStats();
                showToast(`Job ${jobId} ${newStatus} successfully!`);
            }
        }

        // Update statistics
        function updateStats() {
            const approved = jobData.filter(j => j.status === 'approved').length;
            const rejected = jobData.filter(j => j.status === 'rejected').length;
            
            document.getElementById('approvedCount').textContent = approved;
            document.getElementById('rejectedCount').textContent = rejected;
        }

        // Filter table
        function filterTable() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const categoryFilter = document.getElementById('categoryFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;

            filteredData = jobData.filter(job => {
                const matchesSearch = !searchTerm || 
                    job.jobName.toLowerCase().includes(searchTerm) ||
                    job.company.toLowerCase().includes(searchTerm) ||
                    job.category.toLowerCase().includes(searchTerm);
                
                const matchesCategory = !categoryFilter || job.category === categoryFilter;
                const matchesStatus = !statusFilter || job.status === statusFilter;

                return matchesSearch && matchesCategory && matchesStatus;
            });

            renderTable();
        }

        // Sort table
        function sortTable(columnIndex) {
            const fields = ['id', 'jobName', 'company', 'category'];
            const field = fields[columnIndex];
            
            if (!sortDirection[field]) sortDirection[field] = 'asc';
            else sortDirection[field] = sortDirection[field] === 'asc' ? 'desc' : 'asc';

            filteredData.sort((a, b) => {
                let aVal = a[field];
                let bVal = b[field];
                
                if (typeof aVal === 'string') {
                    aVal = aVal.toLowerCase();
                    bVal = bVal.toLowerCase();
                }
                
                if (sortDirection[field] === 'asc') {
                    return aVal > bVal ? 1 : -1;
                } else {
                    return aVal < bVal ? 1 : -1;
                }
            });

            renderTable();
        }

        // Show job details modal
        function showJobDetails(jobId) {
            const job = jobData.find(j => j.id === jobId);
            if (job) {
                document.getElementById('modalTitle').textContent = `${job.jobName} - ${job.company}`;
                document.getElementById('modalBody').innerHTML = `
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Job Name</label>
                            <p class="text-gray-900 bg-gray-50 p-2 rounded">${job.jobName}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Company</label>
                            <p class="text-gray-900 bg-gray-50 p-2 rounded">${job.company}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <p class="text-gray-900 bg-gray-50 p-2 rounded">${job.category}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <p class="text-gray-900 bg-gray-50 p-2 rounded capitalize">${job.status}</p>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <p class="text-gray-900 bg-gray-50 p-2 rounded">${job.email}</p>
                        </div>
                    </div>
                `;
                
                const modal = document.getElementById('jobModal');
                const modalContent = document.getElementById('modalContent');
                modal.classList.remove('hidden');
                setTimeout(() => modalContent.classList.add('scale-100'), 10);
            }
        }

        // Close modal
        function closeModal() {
            const modal = document.getElementById('jobModal');
            const modalContent = document.getElementById('modalContent');
            modalContent.classList.remove('scale-100');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        // Show toast notification
        function showToast(message) {
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toastMessage');
            toastMessage.textContent = message;
            toast.classList.remove('translate-x-full');
            setTimeout(() => toast.classList.add('translate-x-full'), 3000);
        }

        // Set active navigation tab
        function setActiveTab(tabName) {
            // Remove active state from all nav items
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('bg-white', 'text-orange-500', 'shadow-lg');
                item.classList.add('bg-orange-300', 'bg-opacity-50', 'text-white');
            });
            
            // Add active state to selected tab
            const activeTab = document.getElementById(`nav-${tabName}`);
            activeTab.classList.remove('bg-orange-300', 'bg-opacity-50', 'text-white');
            activeTab.classList.add('bg-white', 'text-orange-500', 'shadow-lg');
            
            showToast(`Switched to ${tabName.charAt(0).toUpperCase() + tabName.slice(1)} view`);
        }

        // Refresh data
        function refreshData() {
            showToast('Data refreshed successfully!');
            // Simulate data refresh
            setTimeout(() => {
                renderTable();
                updateStats();
            }, 500);
        }

        // Export data to CSV
        function exportData() {
            const csvContent = "data:text/csv;charset=utf-8," 
                + "ID,Job Name,Company,Category,Email,Status\n"
                + filteredData.map(job => 
                    `${job.id},"${job.jobName}","${job.company}","${job.category}","${job.email}","${job.status}"`
                ).join("\n");
            
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "job_applications.csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            showToast('Data exported successfully!');
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'k') {
                e.preventDefault();
                document.getElementById('searchInput').focus();
            }
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>