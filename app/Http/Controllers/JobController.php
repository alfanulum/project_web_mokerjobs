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



    //form 1
    public function formPostJobStep1(Request $request)
    {
        $jobTypes = ['Full-time', 'Part-time', 'Freelance'];

        $categories = [
            'Admin & Operations',
            'Business Dev & Sales',
            'CS & Hospitality',
            'Data & Product',
            'Design & Creative',
            'Education & Training',
            'Finance & Accounting',
            'Food & Beverage',
            'HR & Recruiting',
            'Health & Science',
            'IT & Engineering',
            'Marketing & PR',
            'Home Service',
            'Technical Work',
            'Retail & Merchandising',
            'Transportation & Logistic'
        ];

        // Ambil data lama dari session untuk diisi ulang ke form
        $oldData = $request->session()->get('job_step1', []);

        return view('post_job_pages.form_postjob_step1', compact('jobTypes', 'categories', 'oldData'));
    }
    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'job_name' => 'required|string|max:255',
            'job_type' => 'required|string|max:255',
            'category_job' => 'required|string|max:255',
        ]);

        // Simpan ke session untuk diambil di form selanjutnya atau saat kembali ke form ini
        $request->session()->put('job_step1', $validated);

        // Redirect ke form berikutnya
        return redirect()->route('form_postjob_step2');
    }

    // Tampilkan form step 2 dengan data lama dari session (optional)
    public function formPostJobStep2(Request $request)
    {
        $step2 = $request->session()->get('job_step2', []);
        return view('post_job_pages.form_postjob_step2', compact('step2'));
    }

    // Simpan data step 2 ke session lalu redirect ke step 3
    public function storeStep2(Request $request)
    {
        $validated = $request->validate([
            'place_work' => 'required|string',
            'type_gender' => 'required|string',
            'education_min' => 'required|string',
            'experience_min' => 'required|string',
            'age' => 'required|string',
        ]);

        $request->session()->put('job_step2', $validated);

        return redirect()->route('form_postjob_step3');
    }



    // Tampilkan form step 3
    public function formPostJobStep3(Request $request)
    {
        $step3 = $request->session()->get('job_step3', []);
        return view('post_job_pages.form_postjob_step3', compact('step3'));
    }

    public function storeStep3(Request $request)
    {
        $validated = $request->validate([
            'location' => 'required|string',
            'job_description' => 'required|string',
            'job_requirements' => 'required|string',
            'salary_minimal'  => 'nullable|integer',
             'maximum_salary' => 'nullable|integer',
        ]);

        $request->session()->put('job_step3', $validated);

        return redirect()->route('form_postjob_step4');
    }



    // Tampilkan form step 4
    public function formPostJobStep4(Request $request)
    {
        $step4 = $request->session()->get('job_step4', []);
        return view('post_job_pages.form_postjob_step4', compact('step4'));
    }


    public function storeStep4(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_description' => 'required|string',
            'company_address' => 'required|string',
            'company_industry' => 'required|string',
            'company_website' => 'nullable|url',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('company_logo')) {
            $path = $request->file('company_logo')->store('company_logos', 'public');
            $validated['company_logo'] = $path;
        }

        $request->session()->put('job_step4', $validated);

        // Redirect to step 5 instead of saving
        return redirect()->route('form_postjob_step5');
    }



    //tampilkan form 5 
    public function formPostJobStep5(Request $request)
    {
        $step5 = $request->session()->get('job_step5', []);
        return view('post_job_pages.form_postjob_step5', compact('step5'));
    }

    public function storeStep5(Request $request)
    {
      $validated = $request->validate([
    'email_company' => 'required|email',
    'no_wa_company' => 'required|string',
    'social_media_company' => 'nullable|url',
    'deadline' => 'required|date',
]);


        $request->session()->put('job_step5', $validated);

        // Combine all steps and save to database
        $step1 = $request->session()->get('job_step1', []);
        $step2 = $request->session()->get('job_step2', []);
        $step3 = $request->session()->get('job_step3', []);
        $step4 = $request->session()->get('job_step4', []);
        $step5 = $request->session()->get('job_step5', []);

        $allData = array_merge($step1, $step2, $step3, $step4, $step5);

        // If key 'category' exists, change it to 'category_job'
        if (isset($allData['category'])) {
            $allData['category_job'] = $allData['category'];
            unset($allData['category']);
        }

        // Handle company logo if it exists in step4
        if (isset($step4['company_logo'])) {
            $allData['company_logo_image'] = $step4['company_logo'];
        }

        // Create the job listing
        Lowongan::create($allData);

        // Clear the session
        $request->session()->forget([
            'job_step1',
            'job_step2',
            'job_step3',
            'job_step4',
            'job_step5'
        ]);

        return redirect()->route('form_postjob_step1')->with('success', 'Job posting created successfully!');
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
            'posted' => optional($job->created_at)->diffForHumans(),
            'apply_url' => route('apply.job', ['id' => $job->id]),
            'apply_label' => 'Lamar Sekarang'
        ];
    }

    private function paginate(array $items, int $perPage, Request $request)
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $page = $request->input('page', 1);
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