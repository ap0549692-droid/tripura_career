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
    public function adminIndex(){
        $scholarships = Scholarship::latest()->get();
        return view('scholarships.admin-show', compact('scholarships'));
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