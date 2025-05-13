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
        // Data dummy sementara (nanti akan diganti dari database)
        $allJobs = [
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
            // Tambah data dummy lainnya sesuai kebutuhan
        ];

        // Filter berdasarkan kategori (judul)
        if ($request->filled('kategori')) {
            $kategori = strtolower($request->kategori);
            $allJobs = array_filter(
                $allJobs,
                fn($job) =>
                str_contains(strtolower($job['title']), $kategori)
            );
        }

        // Filter berdasarkan lokasi
        if ($request->filled('lokasi')) {
            $lokasi = strtolower($request->lokasi);
            $allJobs = array_filter(
                $allJobs,
                fn($job) =>
                strtolower($job['location']) === $lokasi
            );
        }

        // Pagination manual
        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 3;
        $offset = ($page - 1) * $perPage;
        $items = array_slice($allJobs, $offset, $perPage);

        $jobs = new LengthAwarePaginator(
            $items,
            count($allJobs),
            $perPage,
            $page,
            [
                'path' => $request->url(),
                'query' => $request->query(),
                'fragment' => 'jobs',
            ]
        );


        // Ambil data kategori dari DB (jika ada model Category)
        $categories = Category::all();

        // Ambil daftar lokasi unik dari data
        $locations = array_unique(array_column($allJobs, 'location'));

        return view('overview', compact('jobs', 'categories', 'locations'));
    }
}
