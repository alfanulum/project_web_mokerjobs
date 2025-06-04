<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\JobfairEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        // Validasi untuk field perusahaan BARU
        $validatedCompanyData = $request->validate([
            'name' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'website' => 'nullable|url|max:255',
            'email' => 'nullable|email|max:255|unique:companies,email',
            'whatsapp' => 'nullable|string|max:50',
            'description' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

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

        // Upload logo jika ada
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $company->logo_path = $path; // Pastikan kolom `logo_path` ada di tabel companies
        }

        $company->save();

        // Asosiasikan perusahaan baru dengan job fair
        $jobfair->companies()->attach($company->id);

        return redirect()->route('admin.jobfairs.companies.index', $jobfair)
            ->with('success', 'Perusahaan baru berhasil dibuat dan ditambahkan ke job fair.');
    }



    public function destroy(JobfairEvent $jobfair, Company $company)
    {
        $jobfair->companies()->detach($company->id);
        return redirect()->back()->with('success', 'Perusahaan dihapus dari event');
    }
}
