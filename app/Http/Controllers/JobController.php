<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Lowongan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;



class JobController extends Controller
{
    public function overview(Request $request)
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

        // Category filter
        if ($request->filled('kategori')) {
            $kategori = strtolower($request->kategori);
            $query->whereRaw('LOWER(category_job) = ?', [$kategori]);
        }

        // Location filter
        if ($request->filled('lokasi')) {
            $lokasi = strtolower($request->lokasi);
            $query->whereRaw('LOWER(location) = ?', [$lokasi]);
        }

        // Get filtered jobs
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




    // In JobController.php
    public function show($id)
    {
        $job = Lowongan::findOrFail($id);

        $jobData = [
            'step1' => [
                'job_name' => $job->job_name,
                'job_type' => $job->job_type,
                'category_job' => $job->category_job,
            ],
            'step2' => [
                'place_work' => $job->place_work,
                'type_gender' => $job->type_gender,
                'education_minimal' => $job->education_minimal,
                'experience_minimal' => $job->experience_minimal,
                'age' => $job->age,
            ],
            'step3' => [
                'location' => $job->location,
                'job_description' => $job->job_description,
                'job_requirements' => $job->job_requirements,
                'salary_minimal' => $job->salary_minimal_range,
                'maximum_salary' => $job->maximum_salary_range,
            ],
            'step4' => [
                'company_name' => $job->company_name,
                'company_description' => $job->company_description,
                'company_address' => $job->company_address,
                'company_industry' => $job->company_industry,
                'company_website' => $job->company_website,
                'company_logo_image' => $job->company_logo_image,
            ],
            'step5' => [
                'email_company' => $job->email_company,
                'no_wa_company' => $job->no_wa_company,
                'social_media_company' => $job->social_media_company,
                'delivery_limit' => $job->delivery_limit,
            ],
        ];

        return view('detail_job', compact('jobData', 'job'));
    }




    // FORM STEP 1
    public function formPostJobStep1(Request $request)
    {
        $jobTypes = ['Full Time', 'Part Time', 'Freelance'];

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

        $request->session()->put('job_step1', $validated);
        return redirect()->route('form_postjob_step2');
    }






    // FORM STEP 2
    public function formPostJobStep2(Request $request)
    {
        $step2 = $request->session()->get('job_step2', []);
        return view('post_job_pages.form_postjob_step2', compact('step2'));
    }

    public function storeStep2(Request $request)
    {
        $validated = $request->validate([
            'place_work' => 'required|string',
            'type_gender' => 'required|string',
            'education_minimal' => 'required|string',
            'experience_minimal' => 'required|string',
            'age' => 'required|string',
        ]);

        $request->session()->put('job_step2', $validated);
        return redirect()->route('form_postjob_step3');
    }




    // FORM STEP 3
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
            'salary_minimal' => 'nullable|integer',
            'maximum_salary' => 'nullable|integer',
        ]);

        $request->session()->put('job_step3', $validated);
        return redirect()->route('form_postjob_step4');
    }




    // FORM STEP 4
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
            'logo_removed' => 'sometimes|in:0,1',
        ]);

        $step4Session = $request->session()->get('job_step4', []);

        // Tangani penghapusan logo jika user centang "hapus logo"
        if ($request->logo_removed == '1') {
            if (isset($step4Session['company_logo_image'])) {
                Storage::disk('public')->delete($step4Session['company_logo_image']);
            }
            $validated['company_logo_image'] = null;
        }
        // Tangani upload logo baru
        elseif ($request->hasFile('company_logo')) {
            if (isset($step4Session['company_logo_image'])) {
                Storage::disk('public')->delete($step4Session['company_logo_image']);
            }
            $path = $request->file('company_logo')->store('company_logos', 'public');
            $validated['company_logo_image'] = $path;
        }
        // Jika tidak ada perubahan, gunakan logo sebelumnya
        elseif (isset($step4Session['company_logo_image'])) {
            $validated['company_logo_image'] = $step4Session['company_logo_image'];
        }

        // Hilangkan field sementara
        unset($validated['company_logo']);
        unset($validated['logo_removed']);

        // Simpan ke session
        $request->session()->put('job_step4', $validated);

        return redirect()->route('form_postjob_step5');
    }



    // FORM STEP 5
    public function formPostJobStep5(Request $request)
    {
        $step5 = $request->session()->get('job_step5', []);
        return view('post_job_pages.form_postjob_step5', compact('step5'));
    }

    // In JobController.php

    // FORM STEP 5
    public function storeStep5(Request $request)
    {
        $validated = $request->validate([
            'email_company' => 'required|email',
            'no_wa_company' => 'required|string',
            'social_media_company' => 'nullable|url',
            'delivery_limit' => 'required|date|after:today',
        ]);

        $request->session()->put('job_step5', $validated);

        // Pastikan redirectnya benar
        return redirect()->route('form_postjob_step6');
    }






    // FORM STEP 6 - PREVIEW
    public function formPostJobStep6(Request $request)
    {
        $requiredSteps = ['job_step1', 'job_step2', 'job_step3', 'job_step4', 'job_step5'];

        foreach ($requiredSteps as $step) {
            if (!$request->session()->has($step)) {
                return redirect()
                    ->route('form_postjob_step1')
                    ->with('error', 'Silakan lengkapi semua langkah terlebih dahulu.');
            }
        }

        $jobData = [
            'step1' => $request->session()->get('job_step1'),
            'step2' => $request->session()->get('job_step2'),
            'step3' => $request->session()->get('job_step3'),
            'step4' => $request->session()->get('job_step4'),
            'step5' => $request->session()->get('job_step5'),
        ];

        return view('post_job_pages.form_postjob_step6', compact('jobData'));
    }

    public function submitJob(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validate the request
            $request->validate([
                'job_data' => 'required|json'
            ]);

            $jobData = json_decode($request->job_data, true, 512, JSON_THROW_ON_ERROR);

            // Create the job
            $lowongan = Lowongan::create([
                'job_name' => $jobData['step1']['job_name'] ?? null,
                'job_type' => $jobData['step1']['job_type'] ?? null,
                'category_job' => $jobData['step1']['category_job'] ?? null,
                'place_work' => $jobData['step2']['place_work'] ?? null,
                'type_gender' => $jobData['step2']['type_gender'] ?? null,
                'education_minimal' => $jobData['step2']['education_minimal'] ?? null,
                'experience_minimal' => $jobData['step2']['experience_minimal'] ?? null,
                'age' => $jobData['step2']['age'] ?? null,
                'location' => $jobData['step3']['location'] ?? null,
                'job_description' => $jobData['step3']['job_description'] ?? null,
                'job_requirements' => $jobData['step3']['job_requirements'] ?? null,
                'salary_minimal_range' => $jobData['step3']['salary_minimal'] ?? 0,
                'maximum_salary_range' => $jobData['step3']['maximum_salary'] ?? 0,
                'company_name' => $jobData['step4']['company_name'] ?? null,
                'company_description' => $jobData['step4']['company_description'] ?? null,
                'company_address' => $jobData['step4']['company_address'] ?? null,
                'company_industry' => $jobData['step4']['company_industry'] ?? null,
                'company_website' => $jobData['step4']['company_website'] ?? null,
                'company_logo_image' => $jobData['step4']['company_logo_image'] ?? null,
                'email_company' => $jobData['step5']['email_company'] ?? null,
                'no_wa_company' => $jobData['step5']['no_wa_company'] ?? null,
                'social_media_company' => $jobData['step5']['social_media_company'] ?? null,
                'delivery_limit' => $jobData['step5']['delivery_limit'] ?? null,
            ]);

            // Clear session
            $request->session()->forget([
                'job_step1',
                'job_step2',
                'job_step3',
                'job_step4',
                'job_step5'
            ]);

            DB::commit();

            return redirect()->route('job_submission_success');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Job submission failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengirim lowongan: ' . $e->getMessage());
        }
    }

    public function jobSubmissionSuccess()
    {
        return view('post_job_pages.job_submission_success');
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
            'id' => $job->id,
            'title' => $job->job_name,
            'salary' => number_format($job->salary_minimal_range, 0, ',', '.'),
            'location' => $job->location,
            'type' => ucwords(strtolower($job->job_type)),
            'work_type' => $job->place_work,
            'edu' => $job->education_minimal,
            'company' => $job->company_name,
            'email' => $job->email_company,
            'whatsapp' => $job->no_wa_company,
            'image' => $job->company_logo_image ? 'storage/' . $job->company_logo_image : 'images/placeholder.png',
            'posted' => optional($job->created_at)->diffForHumans(),
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
