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

        // General search across multiple fields
        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(job_name) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(category_job) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(company_name) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(location) LIKE ?', ["%{$search}%"]);
            });
        }

        // Filter kategori
        if ($request->filled('kategori')) {
            $kategori = strtolower($request->kategori);
            $query->whereRaw('LOWER(category_job) = ?', [$kategori]);
        }

        // Filter lokasi
        if ($request->filled('lokasi') && is_string($request->lokasi)) {
            $lokasi = strtolower($request->lokasi);
            $query->whereRaw('LOWER(location) = ?', [$lokasi]);
        }

        // Get filtered jobs and map data
        $allJobs = $query->latest()->get()->map(function ($job) {
            return $this->mapJobData($job);
        })->toArray();

        // Paginate results
        $jobs = $this->paginate($allJobs, 3, $request);

        // Get unique locations for dropdown
        $locations = Lowongan::select('location')->distinct()->pluck('location')->toArray();

        return view('overview', compact('jobs', 'locations'));
    }

    public function findJob(Request $request)
    {
        $query = Lowongan::query();

        // General search
        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(job_name) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(category_job) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(company_name) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(location) LIKE ?', ["%{$search}%"]);
            });
        }

        // Filter lokasi
        if ($request->filled('lokasi') && is_string($request->lokasi)) {
            $lokasi = strtolower($request->lokasi);
            $query->whereRaw('LOWER(location) = ?', [$lokasi]);
        }

        // Other filters
        if ($request->filled('job_type')) {
            $query->where('job_type', $request->job_type);
        }
        if ($request->filled('place_work')) {
            $query->where('place_work', $request->place_work);
        }
        if ($request->filled('education_minimal')) {
            $query->where('education_minimal', $request->education_minimal);
        }
        if ($request->filled('kategori')) {
            $query->where('category_job', $request->kategori);
        }

        // Rest of your method remains the same
        $allJobs = $query->latest()->get()->map(function ($job) {
            $job->job_type = ucwords(strtolower($job->job_type));
            return $this->mapJobData($job);
        })->toArray();

        $jobs = $this->paginate($allJobs, 8, $request);

        $categories = $this->getFilterOptions('category_job');
        $locations = $this->getFilterOptions('location');
        $jobTypes = $this->getFilterOptions('job_type');
        $workTypes = $this->getFilterOptions('place_work');
        $educations = $this->getFilterOptions('education_minimal');

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


public function create()
{
    return view('post_job_pages.form_postjob_step3');
}
    // Terima data form dan simpan
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'lokasi' => 'required|string',
            'job_description' => 'required|string',
            'job_requirements' => 'required|string',
            'min_salary' => 'nullable|integer',
            'max_salary' => 'nullable|integer',
        ]);

        // Simpan ke database lowongan
        Lowongan::create([
            'lokasi' => $validated['lokasi'],
            'job_description' => $validated['job_description'],
            'job_requirements' => $validated['job_requirements'],
            'min_salary' => $validated['min_salary'] ?? null,
            'max_salary' => $validated['max_salary'] ?? null,
        ]);

        // Redirect misal ke halaman daftar lowongan
        return redirect()->route('job.create')->with('success', 'Lowongan berhasil disimpan!');
    }



    public static function getCategoryIcon($category)
    {
        $icons = [
            'IT' => 'fas fa-laptop-code',
            'Marketing' => 'fas fa-bullhorn',
            'Finance' => 'fas fa-coins',
            'Education' => 'fas fa-graduation-cap',
            'Healthcare' => 'fas fa-heartbeat',
            'Engineering' => 'fas fa-cogs',
            'Design' => 'fas fa-paint-brush',
            'Sales' => 'fas fa-handshake',
            'Administration' => 'fas fa-clipboard-list',
            'Customer Service' => 'fas fa-headset',
            'Human Resources' => 'fas fa-users',
            'Manufacturing' => 'fas fa-industry',
            'Retail' => 'fas fa-shopping-bag',
            'Hospitality' => 'fas fa-utensils',
            'Transportation' => 'fas fa-truck',
            'Construction' => 'fas fa-hard-hat',
            'Legal' => 'fas fa-gavel',
            'Media' => 'fas fa-film',
            'Science' => 'fas fa-flask',
            'Telecommunication' => 'fas fa-phone-alt',
        ];

        foreach ($icons as $key => $icon) {
            if (str_contains(strtolower($category), strtolower($key))) {
                return $icon;
            }
        }

        return 'fas fa-briefcase'; // default icon
    }


    private function mapJobData($job)
    {
        return [
            'title' => $job->job_name,
            'salary' => number_format($job->salary_minimal_range, 0, ',', '.'),
            'location' => $job->location,
            'type' => ucwords(strtolower($job->job_type)),
            'work_type' => $job->place_work,
            'edu' => $job->education_minimal,
            'company' => $job->company_name,
            'image' => $job->company_logo_image ? 'storage/' . $job->company_logo_image : 'images/placeholder.png',
            'posted' => optional($job->created_at)->diffForHumans() ?? 'Baru saja',
            'apply_url' => route('apply.job', ['id' => $job->id]),
            'apply_label' => 'Lamar Sekarang'
        ];
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

    private function getFilterOptions($column)
    {
        return Lowongan::select($column)
            ->distinct()
            ->pluck($column)
            ->map(function ($value) use ($column) {
                return [
                    'label' => ucfirst($value),
                    'value' => strtolower(str_replace([' ', '/'], '_', $value)),
                    'count' => Lowongan::where($column, $value)->count(),
                ];
            })->toArray();
    }
}
