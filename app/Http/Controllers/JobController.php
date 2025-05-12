<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class JobController extends Controller
{
    public function overview(Request $request)
    {
        // Data dummy sementara (nanti akan diganti dari database)
        $jobs = [
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

        // Data dummy kategori
        $categories = Category::all();
        // Ambil semua lokasi unik dari data job
        $locations = array_unique(array_column($jobs, 'location'));

        // Filter jika user memilih kategori
        if ($request->filled('kategori')) {
            $jobs = array_filter($jobs, function ($job) use ($request) {
                return str_contains(strtolower($job['title']), strtolower($request->kategori));
            });
        }

        // Filter jika user memilih lokasi
        if ($request->filled('lokasi')) {
            $jobs = array_filter($jobs, function ($job) use ($request) {
                return strtolower($job['location']) === strtolower($request->lokasi);
            });
        }

        // Kirim ke overview
        return view('overview', [
            'jobs' => $jobs,
            'categories' => $categories,
            'locations' => $locations,
        ]);
    }
}
