<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Lowongan;

class JobController extends Controller
{
    public function overview(Request $request)
    {
        $query = Lowongan::query();

        // General search across multiple fields (optional)
        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(job_name) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(category_job) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(company_name) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(location) LIKE ?', ["%{$search}%"]);
            });
        }

        // Filter kategori (optional)
        if ($request->filled('kategori')) {
            $kategori = strtolower($request->kategori);
            $query->whereRaw('LOWER(category_job) = ?', [$kategori]);
        }

        // Filter lokasi (dari dropdown)
        if ($request->filled('lokasi') && is_string($request->lokasi)) {
            $lokasi = strtolower($request->lokasi);
            $query->whereRaw('LOWER(location) = ?', [$lokasi]);
        }

        // Ambil data pekerjaan terbaru setelah filter
        $allJobs = $query->latest()->get()->map(function ($job) {
            return $this->mapJobData($job);
        })->toArray();

        // Pagination manual karena sudah map ke array
        $jobs = $this->paginate($allJobs, 3, $request);

        // Ambil lokasi unik untuk dropdown (jika dibutuhkan)
        $locations = Lowongan::select('location')->distinct()->pluck('location')->toArray();

        return view('overview', compact('jobs', 'locations'));
    }
    public function findJob(Request $request)
    {
        $query = Lowongan::query();

        // Ambil data lowongan terbaru dan mapping
        $allJobs = $query->latest()->get()->map(function ($job) {
            $job->job_type = ucwords(strtolower($job->job_type));
            return $this->mapJobData($job);
        })->toArray();

        // Pagination, 8 per page
        $jobs = $this->paginate($allJobs, 8, $request);

        // Mapping categories ke format array asosiatif
        $categories = Lowongan::select('category_job')->distinct()->pluck('category_job')->map(function ($category) {
            return [
                'label' => ucfirst($category),
                'value' => strtolower(str_replace(' ', '_', $category)),
                'count' => Lowongan::where('category_job', $category)->count(),
            ];
        })->toArray();

        // Mapping locations ke format array asosiatif
        $locations = Lowongan::select('location')->distinct()->pluck('location')->map(function ($location) {
            return [
                'label' => ucfirst($location),
                'value' => strtolower(str_replace(' ', '_', $location)),
                'count' => Lowongan::where('location', $location)->count(),
            ];
        })->toArray();

        // Job Types sudah dalam format yang benar
        $jobTypes = Lowongan::select('job_type')->distinct()->pluck('job_type')->map(function ($type) {
            return [
                'label' => ucfirst($type),
                'value' => strtolower($type),
                'count' => Lowongan::where('job_type', $type)->count()
            ];
        })->toArray();

        // Work Types sudah dalam format yang benar
        $workTypes = Lowongan::select('place_work')->distinct()->pluck('place_work')->map(function ($type) {
            return [
                'label' => ucfirst($type),
                'value' => strtolower($type),
                'count' => Lowongan::where('place_work', $type)->count()
            ];
        })->toArray();

        // Educations sudah dalam format yang benar
        $educations = Lowongan::select('education_minimal')->distinct()->pluck('education_minimal')->map(function ($edu) {
            return [
                'label' => $edu,
                'value' => strtolower(str_replace([' ', '/'], '_', $edu)),
                'count' => Lowongan::where('education_minimal', $edu)->count()
            ];
        })->toArray();

        // Kirim data ke view
        return view('find_job', compact(
            'jobs',
            'categories',
            'locations',
            'jobTypes',
            'workTypes',
            'educations'
        ));
    }

    public function formPostJobStep1()
    {
        $jobTypes = ['Full Time', 'Part Time', 'Internship', 'Freelance'];
        $categories = Lowongan::select('category_job')->distinct()->pluck('category_job')->toArray();

        return view('post_job_pages.form_postjob_step1', compact('jobTypes', 'categories'));
    }

    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'job_name' => 'required|string|max:255',
            'job_type' => 'required|string',
            'category' => 'required|string',
        ]);

        Lowongan::create([
            'job_name' => $validated['job_name'],
            'job_type' => $validated['job_type'],
            'category_job' => $validated['category'],
            'place_work' => '-',
            'type_gender' => '-',
            'education_minimal' => '-',
            'experience_minimal' => '-',
            'age' => '-',
            'job_description' => '-',
            'job_requirements' => '-',
            'salary_minimal_range' => 0,
            'maximum_salary_range' => 0,
            'location' => '-',
            'company_name' => '-',
            'company_description' => '-',
            'company_address' => '-',
            'social_media_company' => '-',
            'company_industry' => '-',
            'email_company' => '-',
            'no_wa_company' => '-',
            'image_banner' => null,
            'company_logo_image' => null,
            'delivery_limit' => now()->addDays(30),
        ]);

        return redirect()->route('form_postjob_step2');
    }

    public function formPostJobStep2()
    {
        return view('post_job_pages.form_postjob_step2');
    }

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

    private function mapJobData($job)
    {
        return [
            'title' => $job->job_name,
            'salary' => number_format($job->salary_minimal_range, 0, ',', '.'),
            'location' => $job->location,
            'type' => ucwords(strtolower($job->job_type)),  // NORMALISASI di sini
            'work_type' => $job->place_work,
            'edu' => $job->education_minimal,
            'company' => $job->company_name,
            'image' => $job->company_logo_image ? 'storage/' . $job->company_logo_image : 'images/placeholder.png',
            'posted' => optional($job->created_at)->diffForHumans() ?? 'Baru saja',
            'apply_url' => route('apply.job', ['id' => $job->id]),
            'apply_label' => 'Lamar Sekarang'
        ];
    }
}
