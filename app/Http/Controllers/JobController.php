<?php
namespace App\Http\Controllers;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    // Public ke liye - /jobs
    public function index(Request $request)
    {
        $query = Job::query();
        if($request->search){
            $query->where('title','like','%'.$request->search.'%');
        }
        $jobs = $query->latest()->get();
        return view('jobs.index', compact('jobs'));
    }

    public function show($id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.show', compact('job'));
    }

    // ===== Admin ke liye =====
    public function adminIndex()
    {
        $jobs = Job::latest()->get();
        return view('admin.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'department' => 'required',
            'qualification' => 'required',
            'last_date' => 'required|date',
            'apply_link' => 'required|url',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->only(['title','department','qualification','last_date','apply_link','pdf_link']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('jobs', 'public');
        }

        Job::create($data);

        return redirect()->route('admin.jobs.index')->with('success','Job Added!');
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, $id)
{
    $job = Job::findOrFail($id);
    $data = $request->only(['title','department','qualification','last_date','apply_link','pdf_link']);
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('jobs', 'public');
    }
    $job->update($data);
    return redirect()->route('admin.jobs.index')->with('success','Job Updated!');
}

    public function destroy($id)
    {
        Job::findOrFail($id)->delete();
        return back()->with('success','Job Deleted!');
    }
}