<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scholarship;

class ScholarshipController extends Controller
{
    public function index(){
        $scholarships = Scholarship::latest()->get();
        return view('scholarships.index', compact('scholarships'));
    }

    public function show($id){
        $scholarship = Scholarship::findOrFail($id);
        return view('scholarships.show', compact('scholarship'));
    }

    // ADMIN
   public function adminIndex(Request $request)
{
    $query = \App\Models\Scholarship::query()->latest();

    if($request->filter == 'tripura'){
        $query->where(function($q){
            $q->where('title','LIKE','%Tripura%')
              ->orWhere('title','LIKE','%ST%')
              ->orWhere('title','LIKE','%SC%')
              ->orWhere('title','LIKE','%Merit%');
        });
    }

    if($request->filter == 'garbage'){
        $query->where('title','NOT LIKE','%Tripura%')
              ->where('title','NOT LIKE','%Scholarship%');
    }

    if($request->search){
        $query->where('title','LIKE','%'.$request->search.'%');
    }

    $scholarships = $query->paginate(50);
    return view('admin.scholarships.index', compact('scholarships'));
}

public function bulkDelete(Request $request)
{
    \App\Models\Scholarship::where('title','NOT LIKE','%Tripura%')
        ->where('title','NOT LIKE','%Scholarship%')
        ->delete();

    return back()->with('success', 'All Garbage Scholarships Deleted!');
}

    public function create(){
        return view('scholarships.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'amount' => 'required',
            'last_date' => 'required',
            'apply_link' => 'required|url'
        ]);

        Scholarship::create([
            'title' => $request->title,
            'provider' => $request->provider,
            'department' => $request->provider, // dono me save
            'category' => $request->category,
            'amount' => $request->amount, // <-- YEHI SE ALAG-ALAG HOGA
            'deadline' => $request->last_date, // last_date ko deadline me map
            'last_date' => $request->last_date,
            'apply_link' => $request->apply_link,
            'link' => $request->apply_link,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.scholarships.index')->with('success', 'Scholarship Added with ₹'.$request->amount);
    }

    public function edit($id){
        $scholarship = Scholarship::findOrFail($id);
        return view('scholarships.edit', compact('scholarship'));
    }

    public function update(Request $request, $id){
        $s = Scholarship::findOrFail($id);
        $s->update([
            'title' => $request->title,
            'provider' => $request->provider,
            'department' => $request->provider,
            'category' => $request->category,
            'amount' => $request->amount,
            'deadline' => $request->last_date,
            'last_date' => $request->last_date,
            'apply_link' => $request->apply_link,
            'link' => $request->apply_link,
            'description' => $request->description,
        ]);
        return back()->with('success', 'Updated! Amount is now ₹'.$request->amount);
    }

    public function destroy($id){
        Scholarship::findOrFail($id)->delete();
        return back()->with('success', 'Deleted');
    }
}