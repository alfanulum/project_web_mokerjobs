<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maker.jobs Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <style>
        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: scale(0.5);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .slide-in {
            animation: slideIn 0.3s ease-out;
        }

        .animate-slide-left {
            animation: slideInLeft 0.6s ease-out;
        }

        .animate-slide-right {
            animation: slideInRight 0.6s ease-out;
        }

        .animate-fade-up {
            animation: fadeInUp 0.8s ease-out;
        }

        .animate-pulse-custom {
            animation: pulse 2s infinite;
        }

        .animate-count-up {
            animation: countUp 1s ease-out;
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #f97316, #ea580c);
        }

        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
        }

        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

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

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 font-sans min-h-screen">
    <div class="flex min-h-screen">
        <div class="w-64 bg-gradient-to-b from-orange-500 to-orange-600 p-6 shadow-xl slide-in">
            <div class="mb-8 text-center">
                <h1 class="text-white text-2xl font-bold hover:scale-105 transition-transform cursor-pointer">
                    maker.jobs
                </h1>
                <div class="w-16 h-1 bg-white mx-auto mt-2 rounded-full opacity-70"></div>
            </div>
            <nav class="space-y-3">
                <a href="#" onclick="setActiveTab('home'); console.log('Home tab clicked')" id="nav-home" class="nav-item block w-full px-4 py-3 bg-white text-orange-500 rounded-lg text-center font-medium hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <span class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        <span>Home</span>
                    </span>
                </a>


                <a href="#" onclick="setActiveTab('approved'); console.log('Approved tab clicked')" id="nav-approved" class="nav-item block w-full px-4 py-3 bg-orange-300 bg-opacity-50 text-white rounded-lg text-center hover:bg-opacity-70 transition-all duration-300 transform hover:scale-105">
                    <span class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span>Approved</span>
                    </span>
                </a>
                <a href="#" onclick="setActiveTab('rejected'); console.log('Rejected tab clicked')" id="nav-rejected" class="nav-item block w-full px-4 py-3 bg-orange-300 bg-opacity-50 text-white rounded-lg text-center hover:bg-opacity-70 transition-all duration-300 transform hover:scale-105">
                    <span class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        <span>Rejected</span>
                    </span>
                </a>
            </nav>
            <div class="mt-8 bg-white bg-opacity-20 backdrop-blur-sm rounded-lg p-4 fade-in">
                <h3 class="text-white text-sm font-medium mb-2">Quick Stats</h3>
                <div class="space-y-2 text-white text-xs">
                    <div class="flex justify-between">
                        <span>Total Jobs:</span>
                        <span id="totalJobsSidebar" class="font-bold">0</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Approved:</span>
                        <span id="approvedCountSidebar" class="font-bold text-green-200">0</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Rejected:</span>
                        <span id="rejectedCountSidebar" class="font-bold text-red-200">0</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 p-6 animate-slide-right">
            <div class="flex justify-between items-center mb-6 animate-fade-up">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 bg-gradient-to-r from-orange-500 to-orange-600 bg-clip-text text-transparent">Admin Dashboard</h2>
                    <p class="text-gray-600 mt-1">verification of submitted job applications</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div id="newNotification" class="bg-yellow-400 px-4 py-2 rounded-full font-medium animate-pulse-custom cursor-pointer hover:bg-yellow-300 transition-colors">
                        <span id="newCount">0</span> New (Pending)
                    </div>
                    <button onclick="refreshData()" class="bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600 transition-colors hover-lift">
                        <span id="refreshIcon">🔄</span>
                    </button>
                </div>
            </div>

            <div id="loadingState" class="hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="loading-skeleton h-32 rounded-xl"></div>
                    <div class="loading-skeleton h-32 rounded-xl"></div>
                    <div class="loading-skeleton h-32 rounded-xl"></div>
                    <div class="loading-skeleton h-32 rounded-xl"></div>
                </div>
            </div>

            <div id="statsCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="gradient-bg text-white p-6 rounded-xl hover-lift cursor-pointer animate-fade-up shadow-xl" onclick="showDetails('total')">
                    <h3 class="text-sm font-medium mb-2 opacity-90">Job Applications</h3>
                    <h4 class="text-lg font-bold mb-2">Total</h4>
                    <p id="totalCountMain" class="text-3xl font-bold animate-count-up">0</p>
                    <div class="mt-2 text-sm opacity-75">
                        <span class="inline-block w-2 h-2 bg-green-300 rounded-full mr-1"></span>
                        <span id="totalGrowthText"></span>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-xl hover-lift cursor-pointer animate-fade-up" style="animation-delay: 0.1s" onclick="showDetails('pending')">
                    <h3 class="text-sm text-gray-500 font-medium mb-2">Job Applications</h3>
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Pending</h4>
                    <p id="pendingCountMain" class="text-3xl font-bold text-blue-600 animate-count-up">0</p>
                    <div class="mt-2 text-sm text-gray-500">
                        <span class="inline-block w-2 h-2 bg-blue-400 rounded-full mr-1"></span>
                        <span id="pendingRateText"></span>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-xl hover-lift cursor-pointer animate-fade-up" style="animation-delay: 0.2s" onclick="showDetails('approved')">
                    <h3 class="text-sm text-gray-500 font-medium mb-2">Job Applications</h3>
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Approved</h4>
                    <p id="approvedCountMain" class="text-3xl font-bold text-green-600 animate-count-up">0</p>
                    <div class="mt-2 text-sm text-gray-500">
                        <span class="inline-block w-2 h-2 bg-green-400 rounded-full mr-1"></span>
                        <span id="approvalRateText"></span>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-xl hover-lift cursor-pointer animate-fade-up" style="animation-delay: 0.3s" onclick="showDetails('rejected')">
                    <h3 class="text-sm text-gray-500 font-medium mb-2">Job Applications</h3>
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Rejected</h4>
                    <p id="rejectedCountMain" class="text-3xl font-bold text-red-600 animate-count-up">0</p>
                    <div class="mt-2 text-sm text-gray-500">
                        <span class="inline-block w-2 h-2 bg-red-400 rounded-full mr-1"></span>
                        <span id="rejectionRateText"></span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 animate-fade-up" style="animation-delay: 0.4s">
                <div class="bg-white p-6 rounded-xl shadow-xl hover-lift">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h3 class="text-sm text-gray-500 font-medium mb-1">Job Applications</h3>
                            <h4 class="text-xl font-bold text-gray-800">Total Statistics</h4>
                        </div>
                        <div class="flex items-center space-x-2">
                            <select id="yearFilter" onchange="updateChart()" class="bg-yellow-400 px-3 py-1 rounded-full text-sm font-medium border-none cursor-pointer">
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                            </select>
                        </div>
                    </div>
                    <div class="h-64 relative"><canvas id="statsChart" width="400" height="200"></canvas></div>
                </div>
                <div class="bg-gradient-to-br from-orange-50 to-orange-100 p-6 rounded-xl shadow-xl">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h3 class="text-sm text-gray-600 font-medium mb-1">Job Applications</h3>
                            <h4 class="text-xl font-bold text-gray-800">Recently Updated</h4>
                        </div>
                        <button onclick="showAllJobs()" class="bg-orange-500 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-orange-600 transition-all duration-300 hover:scale-105 shadow-lg">
                            View All (Processed Page)
                        </button>
                    </div>
                    <div id="jobList" class="space-y-3 max-h-80 overflow-y-auto custom-scrollbar">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="jobModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-6 rounded-xl max-w-md w-full mx-4 animate-fade-up">
            <div class="flex justify-between items-center mb-4">
                <h3 id="modalTitle" class="text-xl font-bold text-gray-800"></h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
            </div>
            <div id="modalContent" class="text-gray-600"></div>
        </div>
    </div>

    <script>
        let chart;
        // Data structure from processed.blade.php
        let jobs = [{
                id: 1,
                jobName: "Job #1",
                company: "Company A",
                category: "Admin & Operations",
                email: "Company1@email.com",
                status: "pending"
            },
            {
                id: 2,
                jobName: "Job #2",
                company: "Company B",
                category: "Business Dev & Sales",
                email: "Company2@email.com",
                status: "pending"
            },
            {
                id: 3,
                jobName: "Job #3",
                company: "Company C",
                category: "CS & Hospitality",
                email: "Company3@email.com",
                status: "pending"
            },
            {
                id: 4,
                jobName: "Job #4",
                company: "Company D",
                category: "Data & Product",
                email: "Company4@email.com",
                status: "pending"
            },
            {
                id: 5,
                jobName: "Job #5",
                company: "Company E",
                category: "Design & Creative",
                email: "Company5@email.com",
                status: "pending"
            },
            {
                id: 6,
                jobName: "Job #6",
                company: "Company F",
                category: "Education & Training",
                email: "Company1@email.com",
                status: "pending"
            },
            {
                id: 7,
                jobName: "Job #7",
                company: "Company G",
                category: "Finance & Accounting",
                email: "Company6@email.com",
                status: "pending"
            },
            {
                id: 8,
                jobName: "Job #8",
                company: "Company H",
                category: "Food & Beverage",
                email: "Company7@email.com",
                status: "pending"
            }
        ];

        // Store previous counts for growth calculation
        let previousCounts = {
            total: 0,
            pending: 0,
            approved: 0,
            rejected: 0
        };

        document.addEventListener('DOMContentLoaded', function() {
            initChart();
            updateAllStats(); // Initial calculation and display of all stats
            loadJobs(); // Load initial job list
            setActiveTab('home');
            // startDataUpdates(); // Auto-update can be enabled if desired
        });

        function calculateStats() {
            const total = jobs.length;
            const pending = jobs.filter(j => j.status === 'pending').length;
            const approved = jobs.filter(j => j.status === 'approved').length;
            const rejected = jobs.filter(j => j.status === 'rejected').length;
            return {
                total,
                pending,
                approved,
                rejected
            };
        }

        function updateAllStats(isRefresh = false) {
            const currentStats = calculateStats();

            // Update sidebar stats
            document.getElementById('totalJobsSidebar').textContent = currentStats.total;
            document.getElementById('approvedCountSidebar').textContent = currentStats.approved;
            document.getElementById('rejectedCountSidebar').textContent = currentStats.rejected;

            // Update main dashboard stats cards
            animateNumber('totalCountMain', currentStats.total);
            animateNumber('pendingCountMain', currentStats.pending);
            animateNumber('approvedCountMain', currentStats.approved);
            animateNumber('rejectedCountMain', currentStats.rejected);

            // Update "New (Pending)" notification
            document.getElementById('newCount').textContent = currentStats.pending;

            // Update growth/rate texts
            if (isRefresh) {
                document.getElementById('totalGrowthText').textContent = `${getGrowthPercentage(currentStats.total, previousCounts.total)} from last refresh`;
                document.getElementById('pendingRateText').textContent = `Processing rate: ${getRatePercentage(currentStats.pending, currentStats.total)}`;
                document.getElementById('approvalRateText').textContent = `Approval rate: ${getRatePercentage(currentStats.approved, currentStats.total - currentStats.pending)}`; // Rate of non-pending
                document.getElementById('rejectionRateText').textContent = `Rejection rate: ${getRatePercentage(currentStats.rejected, currentStats.total - currentStats.pending)}`; // Rate of non-pending
            } else {
                // Initial placeholder texts or leave blank
                document.getElementById('totalGrowthText').textContent = `Currently ${currentStats.total} jobs`;
                document.getElementById('pendingRateText').textContent = `${getRatePercentage(currentStats.pending, currentStats.total)} are pending`;
                document.getElementById('approvalRateText').textContent = `${getRatePercentage(currentStats.approved, currentStats.total)} approved`;
                document.getElementById('rejectionRateText').textContent = `${getRatePercentage(currentStats.rejected, currentStats.total)} rejected`;
            }

            // Store current stats as previous for next refresh
            previousCounts = {
                ...currentStats
            };
        }

        function getGrowthPercentage(current, previous) {
            if (previous === 0) return current > 0 ? "+100%" : "0%";
            const diff = current - previous;
            const percentage = (diff / previous) * 100;
            return `${diff >= 0 ? '+' : ''}${percentage.toFixed(0)}%`;
        }

        function getRatePercentage(count, total) {
            if (total === 0) return "0%";
            return `${((count / total) * 100).toFixed(0)}%`;
        }


        function initChart() {
            const ctx = document.getElementById('statsChart').getContext('2d');
            chart = new Chart(ctx, {
                type: 'line',
                data: {
                    /* ... Chart data ... */
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Applications',
                        data: [50, 90, 20, 40, 40, 40, 40, 70, 10, 20, 20, 20], // Example data
                        borderColor: '#f97316',
                        backgroundColor: 'rgba(249, 115, 22, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        pointBackgroundColor: '#f97316',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                        fill: true
                    }]
                },
                options: {
                    /* ... Chart options ... */
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 2000,
                        easing: 'easeInOutQuart'
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            border: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                stepSize: 20
                            },
                            grid: {
                                color: '#f3f4f6'
                            },
                            border: {
                                display: false
                            }
                        }
                    },
                    elements: {
                        point: {
                            hoverRadius: 8
                        }
                    }
                }
            });
        }

        function updateChart() {
            const year = document.getElementById('yearFilter').value;
            let newData;
            if (year === '2024') newData = [50, 90, 20, 40, 40, 40, 40, 70, 10, 20, 20, 20];
            else if (year === '2023') newData = [30, 60, 45, 55, 35, 50, 65, 45, 25, 35, 40, 30];
            else newData = [25, 40, 35, 30, 45, 35, 50, 40, 30, 25, 35, 25];
            chart.data.datasets[0].data = newData;
            chart.update('active');
        }

        function loadJobs() {
            const jobList = document.getElementById('jobList');
            jobList.innerHTML = ''; // Clear existing list
            // Display a few recently updated or pending jobs, for example
            const recentJobs = jobs.slice(-5).reverse(); // Display last 5, newest first

            recentJobs.forEach((job, index) => {
                setTimeout(() => {
                    const jobElement = document.createElement('div');
                    jobElement.className = 'bg-white p-4 rounded-lg border border-orange-200 hover-lift cursor-pointer animate-fade-up';
                    jobElement.onclick = () => showJobDetails(job.id);

                    const statusColor = job.status === 'approved' ? 'green' : job.status === 'rejected' ? 'red' : 'blue';

                    jobElement.innerHTML = `
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="font-medium text-gray-800">${job.jobName}</div>
                                <div class="text-sm text-gray-500">${job.company} - ${job.category}</div>
                            </div>
                            <span class="px-2 py-1 rounded-full text-xs font-medium bg-${statusColor}-100 text-${statusColor}-600 capitalize">
                                ${job.status}
                            </span>
                        </div>
                    `;
                    jobList.appendChild(jobElement);
                }, index * 100);
            });
        }

        function showJobDetails(jobId) {
            const job = jobs.find(j => j.id === jobId);
            if (!job) return;

            document.getElementById('modalTitle').textContent = job.jobName;
            document.getElementById('modalContent').innerHTML = `
                <p><strong>Company:</strong> ${job.company}</p>
                <p><strong>Category:</strong> ${job.category}</p>
                <p><strong>Email:</strong> <a href="mailto:${job.email}" class="text-blue-600 hover:underline">${job.email}</a></p>
                <p><strong>Status:</strong> <span class="capitalize">${job.status}</span></p>
                <p><strong>Job ID:</strong> #${job.id.toString().padStart(6, '0')}</p>
                <div class="mt-4 space-x-2">
                    ${job.status !== 'approved' ? `<button onclick="updateJobStatus(${job.id}, 'approved')" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors">Approve</button>` : ''}
                    ${job.status !== 'rejected' ? `<button onclick="updateJobStatus(${job.id}, 'rejected')" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition-colors">Reject</button>` : ''}
                    ${job.status !== 'pending' && (job.status === 'approved' || job.status === 'rejected') ? `<button onclick="updateJobStatus(${job.id}, 'pending')" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition-colors">Set to Pending</button>` : ''}
                </div>
            `;
            document.getElementById('jobModal').classList.remove('hidden');
            document.getElementById('jobModal').classList.add('flex');
        }

        function updateJobStatus(jobId, newStatus) {
            const jobIndex = jobs.findIndex(j => j.id === jobId);
            if (jobIndex > -1) {
                jobs[jobIndex].status = newStatus;
                updateAllStats(true); // Recalculate and update stats, indicate it's a refresh
                loadJobs(); // Reload job list which might show different jobs or statuses
                closeModal();
                showToast(`Job #${jobId} status updated to ${newStatus}.`);
            }
        }

        function closeModal() {
            document.getElementById('jobModal').classList.add('hidden');
            document.getElementById('jobModal').classList.remove('flex');
        }

        function showDetails(type) { // type can be 'total', 'pending', 'approved', 'rejected'
            const stats = calculateStats();
            let title = '';
            let content = '';

            switch (type) {
                case 'total':
                    title = 'Total Applications';
                    content = `<p>Currently, there are <strong>${stats.total}</strong> total job applications in the system.</p>`;
                    break;
                case 'pending':
                    title = 'Pending Applications';
                    content = `<p>There are <strong>${stats.pending}</strong> applications awaiting review.</p>`;
                    break;
                case 'approved':
                    title = 'Approved Applications';
                    content = `<p><strong>${stats.approved}</strong> applications have been approved.</p>`;
                    break;
                case 'rejected':
                    title = 'Rejected Applications';
                    content = `<p><strong>${stats.rejected}</strong> applications have been rejected.</p>`;
                    break;
            }
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalContent').innerHTML = content + `<div class="mt-4 bg-gray-50 p-3 rounded">View the respective table/page for more details.</div>`;
            document.getElementById('jobModal').classList.remove('hidden');
            document.getElementById('jobModal').classList.add('flex');
        }

        function refreshData() {
            const refreshIcon = document.getElementById('refreshIcon');
            refreshIcon.style.animation = 'spin 1s linear'; // One spin, not infinite

            document.getElementById('statsCards').classList.add('hidden');
            document.getElementById('loadingState').classList.remove('hidden');

            setTimeout(() => {
                // Simulate some data changes for demonstration before recalculating
                if (jobs.length > 0) {
                    const randomIndex = Math.floor(Math.random() * jobs.length);
                    const statuses = ['pending', 'approved', 'rejected'];
                    // Change status of a random job if not already that status
                    let newStatus = jobs[randomIndex].status;
                    while (newStatus === jobs[randomIndex].status) {
                        newStatus = statuses[Math.floor(Math.random() * statuses.length)];
                    }
                    jobs[randomIndex].status = newStatus;
                }

                updateAllStats(true); // Recalculate and update stats, indicate it's a refresh
                loadJobs(); // Reload job list which might show different jobs or statuses

                document.getElementById('loadingState').classList.add('hidden');
                document.getElementById('statsCards').classList.remove('hidden');

                setTimeout(() => {
                    refreshIcon.style.animation = '';
                }, 1000); // Clear animation after it's done
                showToast('Dashboard data refreshed!');
            }, 1500);
        }

        function animateNumber(elementId, targetValue) {
            const element = document.getElementById(elementId);
            if (!element) return;
            const startValueText = element.textContent.replace(/,/g, '');
            const startValue = parseInt(startValueText) || 0;
            const duration = 800; // Slightly faster animation
            const startTime = performance.now();

            function updateNumber(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const easeOutQuart = 1 - Math.pow(1 - progress, 4);
                const currentValue = Math.floor(startValue + (targetValue - startValue) * easeOutQuart);
                element.textContent = currentValue.toLocaleString();
                if (progress < 1) requestAnimationFrame(updateNumber);
            }
            requestAnimationFrame(updateNumber);
        }

        // function startDataUpdates() { /* ... Optional: for periodic auto-refresh ... */ }

        function setActiveTab(tabName) {
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('bg-white', 'text-orange-500', 'shadow-lg');
                item.classList.add('bg-orange-300', 'bg-opacity-50', 'text-white');
            });
            const activeTab = document.getElementById(`nav-${tabName}`);
            if (activeTab) {
                activeTab.classList.remove('bg-orange-300', 'bg-opacity-50', 'text-white');
                activeTab.classList.add('bg-white', 'text-orange-500', 'shadow-lg');
            }
            // Add logic here to change main content view based on tab if this dashboard is meant to be multi-page
            // For example, if 'processed' tab should show a table like in processed.blade.php
            if (tabName === 'processed') {
                // Potentially redirect or load the content of processed.blade.php here
                // For now, just a console log
                console.log("Navigating to Processed view (not implemented in this single page dashboard version)");
                // window.location.href = '/path-to-processed-page'; // If it's a separate page
            }
        }

        function showAllJobs() {
            // This function should ideally navigate to a page that lists all jobs,
            // similar to what processed.blade.php does.
            // setActiveTab('processed'); // Visually activate the tab
            showToast('Navigating to full job list (Processed Page)...');
            // If processed.blade.php is a separate HTML page, you would redirect:
            // window.location.href = 'processed.html'; // Or the correct path
            console.log("Attempting to show all jobs - ideally navigates to a 'Processed' type view/page.");
        }

        const styleSheet = document.createElement('style');
        styleSheet.textContent = `@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }`;
        document.head.appendChild(styleSheet);

        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50';
            toast.textContent = message;
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.classList.remove('translate-x-full');
            }, 10);
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 3000);
        }
    </script>
</body>

</html>