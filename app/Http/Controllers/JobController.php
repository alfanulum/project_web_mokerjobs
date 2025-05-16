<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class JobController extends Controller
{
    public function overview(Request $request)
    {
        $allJobs = $this->getDummyJobs();

        // Filter kategori
        if ($request->filled('kategori')) {
            $kategori = strtolower($request->kategori);
            $allJobs = array_filter(
                $allJobs,
                fn($job) =>
                str_contains(strtolower($job['title']), $kategori)
            );
        }

        // Filter lokasi
        if ($request->filled('lokasi')) {
            $lokasi = strtolower($request->lokasi);
            $allJobs = array_filter(
                $allJobs,
                fn($job) =>
                strtolower($job['location']) === $lokasi
            );
        }

        $jobs = $this->paginate($allJobs, 3, $request);
        $categories = Category::all();
        $locations = array_unique(array_column($allJobs, 'location'));

        return view('overview', compact('jobs', 'categories', 'locations'));
    }

    public function findJob(Request $request)
    {
        $allJobs = $this->getDummyJobs();

        // Sama: bisa tambahkan filter kategori/lokasi juga kalau ingin
        $jobs = $this->paginate($allJobs, 8, $request);
        $categories = Category::all();
        $locations = array_unique(array_column($allJobs, 'location'));

        $jobTypes = [
            ['label' => 'Full Time', 'value' => 'full_time', 'count' => 123],
            ['label' => 'Part Time', 'value' => 'part_time', 'count' => 45],
            ['label' => 'Freelance', 'value' => 'freelance', 'count' => 30],
        ];

        $workTypes = [
            ['label' => 'Hybrid', 'value' => 'hybrid', 'count' => 50],
            ['label' => 'On-site', 'value' => 'onsite', 'count' => 70],
            ['label' => 'Remote', 'value' => 'remote', 'count' => 40],
        ];

        $educations = [
            ['label' => 'D1-D3', 'value' => 'd3', 'count' => 20],
            ['label' => 'S1/D4', 'value' => 's1', 'count' => 30],
            ['label' => 'S2/Profesi', 'value' => 's2', 'count' => 15],
            ['label' => 'SMA/K', 'value' => 'smak', 'count' => 25],
            ['label' => 'SD-SMP', 'value' => 'sd', 'count' => 10],
        ];


        // Ambil semua kategori dari database
        $categories = Category::all()->map(function ($category) use ($allJobs) {
            $count = collect($allJobs)->where('category', $category->name)->count();

            return [
                'value' => strtolower(str_replace(' ', '_', $category->name)), // contoh: IT & Engineering → it_engineering
                'label' => $category->name,
                'count' => $count,
            ];
        });

        return view('find_job', compact(
            'jobs',
            'categories',
            'locations',
            'jobTypes',
            'workTypes',
            'educations'
        ));
    }

    public function formPostJobStep1(Request $request)
    {
        $allJobs = $this->getDummyJobs();

        // Sama: bisa tambahkan filter kategori/lokasi juga kalau ingin
        $jobs = $this->paginate($allJobs, 8, $request);
        $categories = Category::all();

        $jobTypes = [
            ['label' => 'Full Time', 'value' => 'full_time', 'count' => 123],
            ['label' => 'Part Time', 'value' => 'part_time', 'count' => 45],
            ['label' => 'Freelance', 'value' => 'freelance', 'count' => 30],
        ];

        // Ambil semua kategori dari database
        $categories = Category::all()->map(function ($category) use ($allJobs) {
            $count = collect($allJobs)->where('category', $category->name)->count();

            return [
                'value' => strtolower(str_replace(' ', '_', $category->name)), // contoh: IT & Engineering → it_engineering
                'label' => $category->name,
                'count' => $count,
            ];
        });

        return view('post_job_pages.form_postjob_step1', compact(
            'jobs',
            'categories',
            'jobTypes'
        ));
    }

    // 🧩 Fungsi untuk pagination manual
    private function paginate(array $items, int $perPage, Request $request)
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $offset = ($page - 1) * $perPage;
        $paginatedItems = array_slice($items, $offset, $perPage);

        return new LengthAwarePaginator(
            $paginatedItems,
            count($items),
            $perPage,
            $page,
            [
                'path' => $request->url(),
                'query' => $request->query(),
                'fragment' => 'jobs',
            ]
        );
    }

    // 🧩 Fungsi untuk ambil data dummy
    private function getDummyJobs(): array
    {
        return [
            [
                'type' => 'Full Time',
                'title' => 'Frontend Developer',
                'salary' => '8.000.000',
                'posted' => '2 hari lalu',
                'work_type' => 'On-site',
                'edu' => 'S1',
                'location' => 'Jetis',
                'company' => 'Jetis Company',
                'apply_url' => '/job/1',
                'apply_label' => 'Daftar',
                'border' => 'border-orange-400',
                'ring' => 'ring-blue-500',
                'image' => 'images/jobs/frontend.png',
            ],
            [
                'type' => 'Part Time',
                'title' => 'UI/UX Designer',
                'salary' => '5.500.000',
                'posted' => '5 hari lalu',
                'work_type' => 'Remote',
                'edu' => 'D3',
                'location' => 'Magersari',
                'company' => 'Design Studio',
                'apply_url' => '/job/2',
                'apply_label' => 'Apply Now',
                'border' => 'border-green-400',
                'ring' => '',
                'image' => 'images/jobs/uiux.png',
            ],
            [
                'type' => 'Full Time',
                'title' => 'Frontend Developer',
                'salary' => '8.000.000',
                'posted' => '2 hari lalu',
                'work_type' => 'On-site',
                'edu' => 'S1',
                'location' => 'Jetis',
                'company' => 'Jetis Company',
                'apply_url' => '/job/1',
                'apply_label' => 'Daftar',
                'border' => 'border-orange-400',
                'ring' => 'ring-blue-500',
                'image' => 'images/jobs/frontend.png',
            ],
            [
                'type' => 'Part Time',
                'title' => 'UI/UX Designer',
                'salary' => '5.500.000',
                'posted' => '5 hari lalu',
                'work_type' => 'Remote',
                'edu' => 'D3',
                'location' => 'Magersari',
                'company' => 'Design Studio',
                'apply_url' => '/job/2',
                'apply_label' => 'Apply Now',
                'border' => 'border-green-400',
                'ring' => '',
                'image' => 'images/jobs/uiux.png',
            ],
            [
                'type' => 'Full Time',
                'title' => 'Frontend Developer',
                'salary' => '8.000.000',
                'posted' => '2 hari lalu',
                'work_type' => 'On-site',
                'edu' => 'S1',
                'location' => 'Jetis',
                'company' => 'Jetis Company',
                'apply_url' => '/job/1',
                'apply_label' => 'Daftar',
                'border' => 'border-orange-400',
                'ring' => 'ring-blue-500',
                'image' => 'images/jobs/frontend.png',
            ],
            [
                'type' => 'Part Time',
                'title' => 'UI/UX Designer',
                'salary' => '5.500.000',
                'posted' => '5 hari lalu',
                'work_type' => 'Remote',
                'edu' => 'D3',
                'location' => 'Magersari',
                'company' => 'Design Studio',
                'apply_url' => '/job/2',
                'apply_label' => 'Apply Now',
                'image' => 'images/jobs/uiux.png',
            ],
            [
                'type' => 'Full Time',
                'title' => 'Backend Developer',
                'salary' => '8.000.000',
                'posted' => '3 hari lalu',
                'work_type' => 'WFO',
                'edu' => 'S1',
                'location' => 'Prajurit Kulon',
                'company' => 'TechNova',
                'apply_url' => '/job/3',
                'apply_label' => 'Lamar Sekarang',
                'image' => 'images/jobs/backend.png',
            ],
            [
                'type' => 'Freelance',
                'title' => 'Content Writer',
                'salary' => '3.500.000',
                'posted' => '1 minggu lalu',
                'work_type' => 'Remote',
                'edu' => 'SMA',
                'location' => 'Jetis',
                'company' => 'Wordify Agency',
                'apply_url' => '/job/4',
                'apply_label' => 'Apply Now',
                'image' => 'images/jobs/writer.png',
            ],
            [
                'type' => 'Full Time',
                'title' => 'Marketing Specialist',
                'salary' => '6.200.000',
                'posted' => '2 hari lalu',
                'work_type' => 'Hybrid',
                'edu' => 'D3',
                'location' => 'Magersari',
                'company' => 'Promote.ID',
                'apply_url' => '/job/5',
                'apply_label' => 'Apply Now',
                'image' => 'images/jobs/marketing.png',
            ],
            [
                'type' => 'Part Time',
                'title' => 'Customer Support',
                'salary' => '4.000.000',
                'posted' => '6 hari lalu',
                'work_type' => 'Remote',
                'edu' => 'SMA',
                'location' => 'Prajurit Kulon',
                'company' => 'HelpDeskPro',
                'apply_url' => '/job/6',
                'apply_label' => 'Lamar Sekarang',
                'image' => 'images/jobs/support.png',
            ],
            [
                'type' => 'Freelance',
                'title' => 'Graphic Designer',
                'salary' => '4.800.000',
                'posted' => '4 hari lalu',
                'work_type' => 'Remote',
                'edu' => 'D3',
                'location' => 'Jetis',
                'company' => 'Kreasi Visual',
                'apply_url' => '/job/7',
                'apply_label' => 'Apply Now',
                'image' => 'images/jobs/graphic.png',
            ],
            [
                'type' => 'Full Time',
                'title' => 'Data Analyst',
                'salary' => '7.500.000',
                'posted' => 'Hari ini',
                'work_type' => 'WFO',
                'edu' => 'S1',
                'location' => 'Magersari',
                'company' => 'InsightLab',
                'apply_url' => '/job/8',
                'apply_label' => 'Lamar Sekarang',
                'image' => 'images/jobs/dataanalyst.png',
            ],
            [
                'type' => 'Part Time',
                'title' => 'Barista',
                'salary' => '2.500.000',
                'posted' => '2 minggu lalu',
                'work_type' => 'Shift',
                'edu' => 'SMA',
                'location' => 'Jetis',
                'company' => 'Kopi Mantap',
                'apply_url' => '/job/9',
                'apply_label' => 'Apply Now',
                'image' => 'images/jobs/barista.png',
            ],
            [
                'type' => 'Freelance',
                'title' => 'Video Editor',
                'salary' => '6.000.000',
                'posted' => '3 hari lalu',
                'work_type' => 'Remote',
                'edu' => 'D3',
                'location' => 'Prajurit Kulon',
                'company' => 'EditHaus',
                'apply_url' => '/job/10',
                'apply_label' => 'Lamar Sekarang',
                'image' => 'images/jobs/videoeditor.png',
            ],
            // Tambahkan data dummy lain jika perlu...
        ];
    }
}
