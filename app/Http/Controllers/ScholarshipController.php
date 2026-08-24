<?php
namespace App\Http\Controllers;
use App\Models\Scholarship;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    // USER ke liye - /scholarships
    public function index()
    {
        $scholarships = Scholarship::latest()->get();
        return view('scholarships.index', compact('scholarships'));
    }

    public function show($id)
    {
        $scholarship = Scholarship::findOrFail($id);
        return view('scholarships.show', compact('scholarship'));
    }

    // ADMIN ke liye - /admin/scholarships
    public function adminIndex()
    {
        $scholarships = Scholarship::latest()->get();
        return view('admin.scholarships.index', compact('scholarships'));
    }

    public function create()
    {
        return view('admin.scholarships.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('scholarships', 'public');
        }
        Scholarship::create($data);
        return redirect()->route('admin.scholarships.index')->with('success','Scholarship Added!');
    }

    public function edit($id)
    {
        $scholarship = Scholarship::findOrFail($id);
        return view('admin.scholarships.edit', compact('scholarship'));
    }

    public function update(Request $request, $id)
    {
        $scholarship = Scholarship::findOrFail($id);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('scholarships', 'public');
        }
        $scholarship->update($data);
        return redirect()->route('admin.scholarships.index')->with('success','Scholarship Updated!');
    }

    public function destroy($id)
    {
        Scholarship::findOrFail($id)->delete();
        return back()->with('success','Scholarship Deleted!');
    }
}