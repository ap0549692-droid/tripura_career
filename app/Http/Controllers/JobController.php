<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::query()->latest();
        if ($request->filter === 'tripura') {
            $query->where(function ($q) {
                $q->where('title', 'LIKE', '%Tripura%')
                    ->orWhere('title', 'LIKE', '%TPSC%')
                    ->orWhere('title', 'LIKE', '%TRB%')
                    ->orWhere('title', 'LIKE', '%TET%')
                    ->orWhere('department', 'LIKE', '%Tripura%')
                    ->orWhere('location', 'LIKE', '%Tripura%');
            });
        }
        if ($request->filter === 'garbage') {
            $query->where(function ($q) {
                $q->where('title', 'NOT LIKE', '%Tripura%')
                    ->where('title', 'NOT LIKE', '%TPSC%')
                    ->where('title', 'NOT LIKE', '%TRB%')
                    ->where('title', 'NOT LIKE', '%TET%')
                    ->where('department', 'NOT LIKE', '%Tripura%')
                    ->where('location', 'NOT LIKE', '%Tripura%');
            });
        }
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('department', 'LIKE', "%{$search}%")
                    ->orWhere('location', 'LIKE', "%{$search}%");
            });
        }
        if ($request->filled('qualification')) {
            $query->where('qualification', 'LIKE', '%' . $request->qualification . '%');
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        $jobs = $query->paginate(50)->withQueryString();
        return view('jobs.index', compact('jobs'));
    }

    // FIXED: Single show() with Feature 4 logic
    public function show($id)
    {
        $job = Job::findOrFail($id);
        
        // Feature 4: Document Checklist Generator
        $documents = [];
        if($job->prtc_required || str_contains(strtolower($job->title), 'prtc')) {
            $documents[] = "PRTC Certificate (Permanent Resident)";
        }
        if($job->min_age || $job->max_age) {
            $documents[] = "Age Proof (Birth Certificate / 10th Admit)";
        }
        if(str_contains(strtolower($job->category ?? ''), 'st') || str_contains(strtolower($job->title), 'st')) {
            $documents[] = "ST Certificate";
        }
        if(str_contains(strtolower($job->qualification ?? ''), 'graduation') || str_contains(strtolower($job->qualification ?? ''), 'graduate')) {
            $documents[] = "Graduation Marksheet & Certificate";
        }
        if(!empty($job->documents)){
            $extraDocs = explode(',', $job->documents);
            $documents = array_merge($documents, $extraDocs);
        }
        // Default docs
        $documents = array_unique(array_merge($documents, ["Aadhaar Card", "Passport Photo", "Signature"]));

        // Countdown calculation
        $daysLeft = $job->last_date ? Carbon::now()->diffInDays(Carbon::parse($job->last_date), false) : null;

        return view('jobs.show', compact('job', 'documents', 'daysLeft'));
    }

    public function adminIndex(Request $request)
    {
        $query = Job::query()->latest();
        if ($request->filter === 'tripura') {
            $query->where(function ($q) {
                $q->where('title', 'LIKE', '%Tripura%')
                    ->orWhere('title', 'LIKE', '%TPSC%')
                    ->orWhere('title', 'LIKE', '%TRB%')
                    ->orWhere('title', 'LIKE', '%TET%')
                    ->orWhere('department', 'LIKE', '%Tripura%')
                    ->orWhere('location', 'LIKE', '%Tripura%');
            });
        }
        if ($request->filter === 'garbage') {
            $query->where(function ($q) {
                $q->where('title', 'NOT LIKE', '%Tripura%')
                    ->where('title', 'NOT LIKE', '%TPSC%')
                    ->where('title', 'NOT LIKE', '%TRB%')
                    ->where('title', 'NOT LIKE', '%TET%')
                    ->where('department', 'NOT LIKE', '%Tripura%')
                    ->where('location', 'NOT LIKE', '%Tripura%');
            });
        }
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('department', 'LIKE', "%{$search}%")
                    ->orWhere('location', 'LIKE', "%{$search}%");
            });
        }
        $jobs = $query->paginate(50)->withQueryString();
        return view('admin.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'qualification' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'last_date' => 'required|date',
            'apply_link' => 'required|url|max:500',
            'pdf_link' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'description' => 'nullable|string',
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'syllabus_link' => 'nullable|url|max:500',
            'pyq_link' => 'nullable|url|max:500',
            'min_age' => 'nullable|integer|min:1|max:100',
            'max_age' => 'nullable|integer|min:1|max:100',
            'documents' => 'nullable|string|max:1000',
            'prtc_required' => 'nullable|boolean',
        ]);

        $validated['location'] = $validated['location'] ?? 'Tripura';
        $validated['qualification'] = $validated['qualification'] ?? 'Graduate';
        $validated['category'] = $validated['category'] ?? 'Government';
        $validated['min_age'] = $validated['min_age'] ?? 18;
        $validated['max_age'] = $validated['max_age'] ?? 40;
        $validated['prtc_required'] = $request->has('prtc_required') ? 1 : 0;

        if ($request->hasFile('pdf_link')) {
            $validated['pdf_link'] = $request->file('pdf_link')->store('jobs/pdf', 'public');
        }
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('jobs/images', 'public');
        }

        $job = Job::create($validated);

        // FACEBOOK AUTO POST
        try {
            $pageId = env('FB_PAGE_ID');
            $pageToken = env('FB_PAGE_TOKEN');
            if ($pageId && $pageToken) {
                $jobUrl = config('app.url') . '/jobs/' . $job->id;
                $formattedDate = $job->last_date ? Carbon::parse($job->last_date)->format('d M Y') : 'N/A';
                $message = "🔥 NEW GOVT JOB ALERT - TRIPURA 🔥\n\n📌 {$job->title}\n🏢 Department: {$job->department}\n📍 Location: " . ($job->location ?? 'Tripura') . "\n🎓 Qualification: " . ($job->qualification ?? 'N/A') . "\n📅 Last Date: {$formattedDate}\n\n👉 Full Details & Apply Here:\n{$jobUrl}\n\n🔗 Official Apply Link:\n{$job->apply_link}\n\n#TripuraJobs #GovtJobs #TripuraCareer #TPSC #TRB";
                Http::post('https://graph.facebook.com/v26.0/' . $pageId . '/feed', [
                    'message' => $message,
                    'link' => $jobUrl,
                    'access_token' => $pageToken,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Facebook Post Failed: ' . $e->getMessage());
        }

        return redirect()->route('admin.jobs.index')->with('success', 'Job Added Successfully: ' . $job->title);
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'qualification' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'last_date' => 'required|date',
            'apply_link' => 'required|url|max:500',
            'pdf_link' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'description' => 'nullable|string',
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'syllabus_link' => 'nullable|url|max:500',
            'pyq_link' => 'nullable|url|max:500',
            'min_age' => 'nullable|integer|min:1|max:100',
            'max_age' => 'nullable|integer|min:1|max:100',
            'documents' => 'nullable|string|max:1000',
            'prtc_required' => 'nullable|boolean',
        ]);
        $validated['location'] = $validated['location'] ?? 'Tripura';
        $validated['qualification'] = $validated['qualification'] ?? 'Graduate';
        $validated['category'] = $validated['category'] ?? 'Government';
        $validated['min_age'] = $validated['min_age'] ?? 18;
        $validated['max_age'] = $validated['max_age'] ?? 40;
        $validated['prtc_required'] = $request->has('prtc_required') ? 1 : 0;

        if ($request->hasFile('pdf_link')) {
            if ($job->pdf_link) Storage::disk('public')->delete($job->pdf_link);
            $validated['pdf_link'] = $request->file('pdf_link')->store('jobs/pdf', 'public');
        } else unset($validated['pdf_link']);
        if ($request->hasFile('image')) {
            if ($job->image) Storage::disk('public')->delete($job->image);
            $validated['image'] = $request->file('image')->store('jobs/images', 'public');
        } else unset($validated['image']);

        $job->update($validated);
        return redirect()->route('admin.jobs.index')->with('success', 'Job Updated Successfully!');
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        if ($job->pdf_link) Storage::disk('public')->delete($job->pdf_link);
        if ($job->image) Storage::disk('public')->delete($job->image);
        $job->delete();
        return redirect()->route('admin.jobs.index')->with('success', 'Job Deleted Successfully!');
    }

    public function bulkDelete(Request $request)
    {
        $jobs = Job::where('title', 'NOT LIKE', '%Tripura%')
            ->where('title', 'NOT LIKE', '%TPSC%')
            ->where('title', 'NOT LIKE', '%TRB%')
            ->where('title', 'NOT LIKE', '%TET%')
            ->where('department', 'NOT LIKE', '%Tripura%')
            ->where('location', 'NOT LIKE', '%Tripura%')->get();
        foreach ($jobs as $job) {
            if ($job->pdf_link) Storage::disk('public')->delete($job->pdf_link);
            if ($job->image) Storage::disk('public')->delete($job->image);
            $job->delete();
        }
        return back()->with('success', 'All Garbage Jobs Deleted!');
    }
}