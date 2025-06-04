<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobfairEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobfairEventController extends Controller
{
    public function index()
    {
        $events = JobfairEvent::latest()->paginate(10);
        return view('admin.jobfairs.index', compact('events'));
    }

    public function create()
    {
        return view('admin.jobfairs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'date_start' => 'required|date',
            'date_end' => 'required|date|after_or_equal:date_start',
            'location' => 'required|string',
        ]);

        JobfairEvent::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'location' => $request->location,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.jobfairs.index')->with('success', 'Event berhasil ditambahkan');
    }

    public function edit(JobfairEvent $jobfair)
    {
        return view('admin.jobfairs.edit', compact('jobfair'));
    }

    public function update(Request $request, JobfairEvent $jobfair)
    {
        $request->validate([
            'name' => 'required|string',
            'date_start' => 'required|date',
            'date_end' => 'required|date|after_or_equal:date_start',
            'location' => 'required|string',
        ]);

        $jobfair->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'location' => $request->location,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.jobfairs.index')->with('success', 'Event berhasil diperbarui');
    }

    public function destroy(JobfairEvent $jobfair)
    {
        $jobfair->delete();
        return redirect()->back()->with('success', 'Event berhasil dihapus');
    }
}
