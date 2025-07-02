<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\JobfairEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class JobfairCompanyController extends Controller
{
    public function index(JobfairEvent $jobfair)
    {
        $companies = $jobfair->companies()->with('jobs')->get();
        return view('admin.jobfairs.companies.index', compact('jobfair', 'companies'));
    }

    public function create(JobfairEvent $jobfair)
    {
        $companies = Company::all();
        return view('admin.jobfairs.companies.create', compact('jobfair', 'companies'));
    }

    public function store(Request $request, JobfairEvent $jobfair)
    {
        // Validasi data
        $validatedCompanyData = $request->validate([
            'name' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'website' => 'nullable|url|max:255',
            'email' => 'nullable|email|max:255|unique:companies,email',
            'whatsapp' => 'nullable|string|max:50',
            'description' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo_removed' => 'sometimes|in:0,1',
        ]);

        // Buat instansi perusahaan baru
        $company = new Company();
        $company->name = $validatedCompanyData['name'];

        // --- LOGIKA SLUG UNIK ---
        $slug = Str::slug($validatedCompanyData['name']);
        $originalSlug = $slug;
        $count = 1;
        while (Company::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $company->slug = $slug;

        // Set atribut lainnya
        $company->industry = $validatedCompanyData['industry'];
        $company->location = $validatedCompanyData['location'];
        $company->website = $validatedCompanyData['website'] ?? null;
        $company->email = $validatedCompanyData['email'] ?? null;
        $company->whatsapp = $validatedCompanyData['whatsapp'] ?? null;
        $company->description = $validatedCompanyData['description'];

        // --- LOGIKA UPLOAD LOGO ala step 4 ---
        if ($request->logo_removed == '1') {
            $company->logo_path = null;
        } elseif ($request->hasFile('logo')) {
            if (!empty($company->logo_path)) {
                Storage::disk('public')->delete($company->logo_path);
            }
            $path = $request->file('logo')->store('company_logos', 'public');
            $company->logo_path = $path;
        }

        // Simpan data
        $company->save();

        // Asosiasikan ke event job fair
        $jobfair->companies()->attach($company->id);

        return redirect()->route('admin.jobfairs.companies.index', $jobfair)
            ->with('success', 'Perusahaan baru berhasil dibuat dan ditambahkan ke job fair.');
    }
}
