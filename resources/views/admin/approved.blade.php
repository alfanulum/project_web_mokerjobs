<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Admin Panel - Approved</title>
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
        /* Removed pulse animation for "0 New" to match image */
        .slide-in { animation: slideIn 0.3s ease-out; }
        .fade-in { animation: fadeIn 0.5s ease-out; }
        
        .custom-scrollbar::-webkit-scrollbar { width: 8px; height: 8px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #fbbf24; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #f59e0b; }

        /* Ensure nav-item styling matches processed.blade.php for active state */
        .nav-item.active {
            background-color: white !important;
            color: #f97316 !important; /* orange-500 */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .nav-item.active span, .nav-item.active svg {
             color: #f97316 !important; /* orange-500 */
        }
        .nav-item:not(.active) span, .nav-item:not(.active) svg {
            color: white !important;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 font-sans">
    <div class="flex min-h-screen">
        <div class="w-64 bg-gradient-to-b from-orange-500 to-orange-600 p-6 shadow-xl slide-in">
            <div class="mb-8 text-center">
                <h1 class="text-white text-2xl font-bold hover:scale-105 transition-transform cursor-pointer">
                    maker.jobs
                </h1>
                <div class="w-16 h-1 bg-white mx-auto mt-2 rounded-full opacity-70"></div>
            </div>
            
            <nav class="space-y-3">
                <a href="#" onclick="setActiveTab('home', event)" id="nav-home" class="nav-item block w-full px-4 py-3 bg-orange-300 bg-opacity-50 text-white rounded-lg text-center hover:bg-opacity-70 transition-all duration-300 transform hover:scale-105">
                    <span class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
                        <span>Home</span>
                    </span>
                </a>
                <a href="#" onclick="setActiveTab('processed', event)" id="nav-processed" class="nav-item block w-full px-4 py-3 bg-orange-300 bg-opacity-50 text-white rounded-lg text-center hover:bg-opacity-70 transition-all duration-300 transform hover:scale-105">
                    <span class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/></svg>
                        <span>Processed</span>
                    </span>
                </a>
                <a href="#" onclick="setActiveTab('approved', event)" id="nav-approved" class="nav-item active block w-full px-4 py-3 bg-white text-orange-500 rounded-lg text-center font-medium hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <span class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        <span>Approved</span>
                    </span>
                </a>
                <a href="#" onclick="setActiveTab('rejected', event)" id="nav-rejected" class="nav-item block w-full px-4 py-3 bg-orange-300 bg-opacity-50 text-white rounded-lg text-center hover:bg-opacity-70 transition-all duration-300 transform hover:scale-105">
                    <span class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        <span>Rejected</span>
                    </span>
                </a>
            </nav>

            <div class="mt-8 bg-white bg-opacity-20 backdrop-blur-sm rounded-lg p-4 fade-in">
                <h3 class="text-white text-sm font-medium mb-2">Quick Stats</h3>
                <div class="space-y-2 text-white text-xs">
                    <div class="flex justify-between">
                        <span>Total Jobs:</span>
                        <span id="totalJobs" class="font-bold">8</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Approved:</span>
                        <span id="approvedCount" class="font-bold text-green-200">8</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Rejected:</span>
                        <span id="rejectedCount" class="font-bold text-red-200">0</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 p-8">
            <div class="flex justify-between items-start mb-8 fade-in">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800">Admin</h1>
                    <p class="text-gray-600 text-lg">verification of submitted job applications</p>
                </div>
                <div class="bg-yellow-400 text-black px-6 py-3 rounded-lg font-medium shadow-lg">
                    0 New
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-xl overflow-hidden fade-in">
                <div class="flex justify-between items-center p-6 border-b border-gray-200 bg-gradient-to-r from-orange-50 to-orange-100">
                    <h2 class="text-2xl font-semibold text-gray-800">Approved Table</h2>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">
                            <span id="visibleRows">8</span> of <span id="totalRows">8</span> row
                        </span>
                    </div>
                </div>

                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full" id="jobTable">
                        <thead class="bg-gradient-to-r from-orange-200 to-orange-300">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 border-r border-orange-400 cursor-pointer hover:bg-orange-300 transition-colors" onclick="sortTable(0)">Num <span class="sort-arrow">⇅</span></th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 border-r border-orange-400 cursor-pointer hover:bg-orange-300 transition-colors" onclick="sortTable(1)">Job Name <span class="sort-arrow">⇅</span></th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 border-r border-orange-400 cursor-pointer hover:bg-orange-300 transition-colors" onclick="sortTable(2)">Company Name <span class="sort-arrow">⇅</span></th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 border-r border-orange-400 cursor-pointer hover:bg-orange-300 transition-colors" onclick="sortTable(3)">Category <span class="sort-arrow">⇅</span></th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 border-r border-orange-400">Company email</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 border-r border-orange-400">Accepted</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Detail</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="jobModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50" onclick="closeModal()">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-2xl max-w-2xl w-full transform transition-all duration-300 scale-95" onclick="event.stopPropagation()" id="modalContentContainer">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-800" id="modalTitle">Job Details</h3>
                </div>
                <div class="p-6" id="modalBody">
                    </div>
                <div class="p-6 border-t border-gray-200 flex justify-end space-x-4">
                    <button onclick="closeModal()" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-300">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample data for Approved view
        let jobData = [
            {id: 1, jobName: "Job #1", company: "Company A", category: "Admin & Operations", email: "Company1@email.com", status: "approved"},
            {id: 2, jobName: "Job #2", company: "Company B", category: "Business Dev & Sales", email: "Company2@email.com", status: "approved"},
            {id: 3, jobName: "Job #3", company: "Company C", category: "CS & Hospitality", email: "Company3@email.com", status: "approved"},
            {id: 4, jobName: "Job #4", company: "Company D", category: "Data & Product", email: "Company4@email.com", status: "approved"},
            {id: 5, jobName: "Job #5", company: "Company E", category: "Design & Creative", email: "Company5@email.com", status: "approved"},
            {id: 6, jobName: "Job #6", company: "Company F", category: "Education & Training", email: "Company1@email.com", status: "approved"},
            {id: 7, jobName: "Job #7", company: "Company G", category: "Finance & Accounting", email: "Company6@email.com", status: "approved"},
            {id: 8, jobName: "Job #8", company: "Company H", category: "Food & Beverage", email: "Company7@email.com", status: "approved"}
        ];

        let filteredData = [...jobData]; // In this view, all data is pre-filtered to 'approved'
        let sortDirection = {};

        document.addEventListener('DOMContentLoaded', function() {
            renderTable();
            updateStats(); // To update sidebar stats if needed, here showing all as approved
        });

        function renderTable() {
            const tbody = document.getElementById('tableBody');
            tbody.innerHTML = '';

            filteredData.forEach((job, index) => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50 transition-colors duration-200'; // Removed hover scale to match image more
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
                    <td class="px-6 py-4 text-sm text-gray-900 border-r border-gray-200 text-center">
                        <span class="bg-yellow-400 text-black px-3 py-1 rounded-full text-xs font-medium">Accepted</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button onclick="showJobDetails(${job.id})" class="bg-orange-500 text-white px-4 py-2 rounded-lg text-xs font-medium hover:bg-orange-600 transition-all duration-300">
                            Detail
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });

            document.getElementById('visibleRows').textContent = filteredData.length;
            document.getElementById('totalRows').textContent = jobData.length;
        }

        function updateStats() {
            // These would typically be calculated from a master list if this page was dynamic
            // For this static slice, reflecting the "Approved" view:
            document.getElementById('totalJobs').textContent = jobData.length; // Assuming these 8 are part of a larger total
            document.getElementById('approvedCount').textContent = jobData.length; // All jobs in this view are approved
            document.getElementById('rejectedCount').textContent = 0;
        }
        
        function sortTable(columnIndex) {
            const fields = ['id', 'jobName', 'company', 'category']; // No email or status sort in image
            const field = fields[columnIndex];
            if (!field) return;
            
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

        function showJobDetails(jobId) {
            const job = jobData.find(j => j.id === jobId);
            if (job) {
                document.getElementById('modalTitle').textContent = `${job.jobName} - ${job.company}`;
                document.getElementById('modalBody').innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><label class="block text-sm font-medium text-gray-700 mb-1">Job Name</label><p class="text-gray-900 bg-gray-50 p-2 rounded">${job.jobName}</p></div>
                        <div><label class="block text-sm font-medium text-gray-700 mb-1">Company</label><p class="text-gray-900 bg-gray-50 p-2 rounded">${job.company}</p></div>
                        <div><label class="block text-sm font-medium text-gray-700 mb-1">Category</label><p class="text-gray-900 bg-gray-50 p-2 rounded">${job.category}</p></div>
                        <div><label class="block text-sm font-medium text-gray-700 mb-1">Status</label><p class="text-gray-900 bg-gray-50 p-2 rounded capitalize font-semibold ${job.status === 'approved' ? 'text-green-600' : 'text-red-600'}">${job.status}</p></div>
                        <div class="col-span-1 md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Email</label><p class="text-gray-900 bg-gray-50 p-2 rounded">${job.email}</p></div>
                    </div>
                `;
                
                const modal = document.getElementById('jobModal');
                const modalContentContainer = document.getElementById('modalContentContainer');
                modal.classList.remove('hidden');
                setTimeout(() => modalContentContainer.classList.add('scale-100'), 10); // For modal animation
                modalContentContainer.classList.remove('scale-95');
            }
        }

        function closeModal() {
            const modal = document.getElementById('jobModal');
            const modalContentContainer = document.getElementById('modalContentContainer');
            modalContentContainer.classList.remove('scale-100');
            modalContentContainer.classList.add('scale-95');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        function setActiveTab(tabName, event) {
            if(event) event.preventDefault();
            // Remove active state from all nav items
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active', 'bg-white', 'text-orange-500', 'shadow-lg');
                item.classList.add('bg-orange-300', 'bg-opacity-50', 'text-white');
            });
            
            // Add active state to selected tab
            const activeTab = document.getElementById(`nav-${tabName}`);
            if (activeTab) {
                activeTab.classList.add('active');
                activeTab.classList.remove('bg-orange-300', 'bg-opacity-50', 'text-white');
                 // Ensure active class styling takes precedence
                activeTab.classList.add('bg-white', 'text-orange-500', 'shadow-lg');
            }
            // For a real application, you would load data for the selected tab here or navigate.
            // For this static slice, we are manually setting the active tab in the HTML.
            // If you want to navigate:
            // if (tabName === 'home') window.location.href = '#'; // Replace with actual URLs
            // if (tabName === 'processed') window.location.href = '#';
            // if (tabName === 'rejected') window.location.href = 'rejected_jobs_ui.blade.php';
        }
         // Set initial active tab based on the page
        document.addEventListener('DOMContentLoaded', function() {
            setActiveTab('approved'); // Set this page's tab as active
            // ... rest of DOMContentLoaded
        });
    </script>
</body>
</html>