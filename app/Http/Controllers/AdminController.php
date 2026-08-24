<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use App\Models\Scholarship;
use App\Models\AdmitCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function dashboard(){
    $totalJobs = \App\Models\Job::count();
    $totalScholarships = \App\Models\Scholarship::count();
    $totalApplications = \App\Models\Application::count();

    $recentJobs = \App\Models\Job::latest()->take(5)->get();
    $recentScholarships = \App\Models\Scholarship::latest()->take(5)->get();

    return view('admin.dashboard', compact('totalJobs','totalScholarships','totalApplications','recentJobs','recentScholarships'));
}

    public function index()
    {
        $applications = Application::with('user', 'scholarship')->latest()->get();
        return view('admin.applications', compact('applications'));
    }

    public function updateStatus(Request $request, $id)
    {
        $application = Application::find($id);
        $application->status = $request->status;
        $application->save();

        return back()->with('success', 'Status updated!');
    }

    // 1 click fetch - FIXED
    public function fetchJobs()
    {
        Artisan::call('jobs:fetch');
        $output = Artisan::output();
        Log::info('Jobs fetched at ' . now() . ' - ' . $output);
        return back()->with('success', '✅ Jobs fetched successfully! ' . $output);
    }

    public function fetchScholarships()
    {
        Artisan::call('scholarships:fetch'); // yaha S small kiya
        $output = Artisan::output();
        Log::info('Scholarships fetched at ' . now() . ' - ' . $output);
        return back()->with('success', '✅ Scholarships fetched successfully! ' . $output);
    }
}