<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Job;
use App\Models\JobfairEvent;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Company $company)
    {
        $jobs = $company->jobs()->latest()->get();
        return view('admin.jobs.index', compact('company', 'jobs'));
    }

    public function create(Company $company)
    {
        $events = JobfairEvent::all();
        return view('admin.jobs.create', compact('company', 'events'));
    }


    public function store(Request $request, Company $company)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'jobfair_event_id' => 'required|exists:jobfair_events,id',
            'location' => 'required|string',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'education_level' => 'required|string',
            'experience_years' => 'required|integer',
            'salary' => 'required|numeric|min:0',
            'type' => 'required|string',
            'expired_at' => 'required|date',
            'apply_link' => 'required|url',
        ]);

        $validated['company_id'] = $company->id;
        $validated['posted_at'] = now(); // 👈 otomatis set now()

        Job::create($validated);

        return redirect()->route('admin.jobs.index', $company)->with('success', 'Lowongan berhasil ditambahkan.');
    }


    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'education_level' => 'required|string',
            'experience_years' => 'required|integer|min:0',
            'salary' => 'required|numeric|min:0',
            'type' => 'required|string',
            'posted_at' => 'required|date',
            'expired_at' => 'required|date|after:posted_at',
            'apply_link' => 'required|url',
        ]);

        $job->update($validated);

        return redirect()->route('admin.jobs.index', $job->company_id)->with('success', 'Lowongan diperbarui');
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->back()->with('success', 'Lowongan dihapus');
    }
}
