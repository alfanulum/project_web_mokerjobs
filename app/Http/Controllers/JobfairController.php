<?php

namespace App\Http\Controllers;

use App\Models\JobfairEvent;
use App\Models\Company;
use App\Models\Job;

class JobfairController extends Controller
{
    public function index()
    {
        $events = JobfairEvent::whereDate('date_end', '>=', now())->get();
        return view('jobfair.index', compact('events'));
    }

    public function showEvent(JobfairEvent $event)
    {
        $companies = $event->companies;
        return view('jobfair.event', compact('event', 'companies'));
    }

    public function showCompany(JobfairEvent $event, Company $company)
    {
        $jobs = Job::where('company_id', $company->id)
            ->where('jobfair_event_id', $event->id)
            ->get();
        return view('jobfair.company', compact('event', 'company', 'jobs'));
    }


    public function show(JobfairEvent $event, Company $company, Job $job)
    {
        // validasi kalau job ini benar-benar milik company dan event
        if ($job->company_id !== $company->id || $job->jobfair_event_id !== $event->id) {
            abort(404);
        }

        return view('jobfair.show', compact('job'));
    }
}
