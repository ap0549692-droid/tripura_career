<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class JobController extends Controller
{
    // PUBLIC - TripuraCareer.com/jobs - SINGLE INDEX
    public function index(Request $request)
    {
        $query = Job::query()->latest();

        // Old filters
        if($request->filter == 'tripura'){
            $query->where(function($q){
                $q->where('title','LIKE','%Tripura%')
                  ->orWhere('title','LIKE','%TPSC%')
                  ->orWhere('title','LIKE','%TRB%')
                  ->orWhere('title','LIKE','%TET%');
            });
        }
        if($request->filter == 'garbage'){
            $query->where('title','NOT LIKE','%Tripura%')
                  ->where('title','NOT LIKE','%TPSC%')
                  ->where('title','NOT LIKE','%TRB%');
        }
        if($request->search){
            $query->where('title','LIKE','%'.$request->search.'%');
        }

        // NEW filters
        if($request->qualification){
            $query->where('qualification', 'LIKE', '%'.$request->qualification.'%');
        }
        if($request->category){
            $query->where('category', $request->category);
        }

        $jobs = $query->paginate(50);
        return view('jobs.index', compact('jobs'));
    }

    public function show($id){
        $job = Job::findOrFail($id);
        return view('jobs.show', compact('job'));
    }

    // ADMIN
    public function create(){
        return view('admin.jobs.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'apply_link' => 'required|url',
            'last_date' => 'required|date',
        ]);

        $job = Job::create([
            'title' => $request->title,
            'department' => $request->department,
            'qualification' => $request->qualification ?? 'Graduate',
            'category' => $request->category ?? 'Government',
            'last_date' => $request->last_date,
            'apply_link' => $request->apply_link,
            'pdf_link' => $request->pdf_url,
        ]);

        try {
            $message = "🔥 NEW JOB ALERT 🔥\n\n".$job->title."\n\nDepartment: ".($job->department)."\nLast Date: ".date('d M Y', strtotime($job->last_date))."\n\nApply Here: ".$job->apply_link;
            Http::post("https://graph.facebook.com/v26.0/" . env('FB_PAGE_ID') . "/feed", [
                'message' => $message,
                'access_token' => env('FB_PAGE_TOKEN')
            ]);
        } catch (\Exception $e) {
            Log::error("Facebook Post Failed: " . $e->getMessage());
        }

        return redirect()->route('admin.jobs.index')->with('success', 'Job Added: '.$request->title);
    }

    public function edit($id){
        $job = Job::findOrFail($id);
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, $id){
        $job = Job::findOrFail($id);
        $job->update([
            'title' => $request->title,
            'department' => $request->department,
            'qualification' => $request->qualification,
            'category' => $request->category,
            'last_date' => $request->last_date,
            'apply_link' => $request->apply_link,
            'pdf_link' => $request->pdf_url,
        ]);
        return back()->with('success', 'Job Updated!');
    }

    public function destroy($id){
        Job::findOrFail($id)->delete();
        return back()->with('success', 'Job Deleted');
    }

    public function bulkDelete(Request $request)
    {
        Job::where('title','NOT LIKE','%Tripura%')
            ->where('title','NOT LIKE','%TPSC%')
            ->where('title','NOT LIKE','%TRB%')
            ->delete();
        return back()->with('success', 'All Garbage Jobs Deleted!');
    }
}