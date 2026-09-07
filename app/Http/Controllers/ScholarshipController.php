<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PUBLIC SCHOLARSHIPS
    |--------------------------------------------------------------------------
    */

    // Scholarship List
    public function index()
    {
        $scholarships = Scholarship::latest()->get();

        return view('scholarships.index', compact('scholarships'));
    }


    // Single Scholarship
    public function show($id)
    {
        $scholarship = Scholarship::findOrFail($id);

        return view('scholarships.show', compact('scholarship'));
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN SCHOLARSHIPS
    |--------------------------------------------------------------------------
    */

    // Admin Scholarship List
    public function adminIndex(Request $request)
    {
        $query = Scholarship::query()->latest();


        /*
        |--------------------------------------------------------------------------
        | Filter: Tripura Scholarships
        |--------------------------------------------------------------------------
        */

        if ($request->filter === 'tripura') {

            $query->where(function ($q) {

                $q->where('title', 'LIKE', '%Tripura%')
                    ->orWhere('title', 'LIKE', '%ST%')
                    ->orWhere('title', 'LIKE', '%SC%')
                    ->orWhere('title', 'LIKE', '%Merit%');

            });
        }


        /*
        |--------------------------------------------------------------------------
        | Filter: Garbage Scholarships
        |--------------------------------------------------------------------------
        */

        if ($request->filter === 'garbage') {

            $query->where('title', 'NOT LIKE', '%Tripura%')
                ->where('title', 'NOT LIKE', '%Scholarship%');
        }


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('provider', 'LIKE', '%' . $search . '%')
                    ->orWhere('category', 'LIKE', '%' . $search . '%');

            });
        }


        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $scholarships = $query
            ->paginate(50)
            ->withQueryString();


        return view(
            'admin.scholarships.index',
            compact('scholarships')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Bulk Delete Garbage Scholarships
    |--------------------------------------------------------------------------
    */

    public function bulkDelete(Request $request)
    {
        Scholarship::where('title', 'NOT LIKE', '%Tripura%')
            ->where('title', 'NOT LIKE', '%Scholarship%')
            ->delete();

        return back()->with(
            'success',
            'All Garbage Scholarships Deleted!'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE SCHOLARSHIP
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('scholarships.create');
    }


    /*
    |--------------------------------------------------------------------------
    | STORE SCHOLARSHIP
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            'title' => [
                'required',
                'string',
                'max:255'
            ],

            'provider' => [
                'nullable',
                'string',
                'max:255'
            ],

            'department' => [
                'nullable',
                'string',
                'max:255'
            ],

            'category' => [
                'nullable',
                'string',
                'max:255'
            ],

            'amount' => [
                'required',
                'string',
                'max:255'
            ],

            'last_date' => [
                'required',
                'date'
            ],

            'apply_link' => [
                'required',
                'url',
                'max:2048'
            ],

            'description' => [
                'nullable',
                'string'
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Save Scholarship
        |--------------------------------------------------------------------------
        */

        Scholarship::create([

            'title' => $validated['title'],

            'provider' => $validated['provider'] ?? null,

            'department' => $validated['department']
                ?? $validated['provider']
                ?? null,

            'category' => $validated['category'] ?? null,

            'amount' => $validated['amount'],

            'deadline' => $validated['last_date'],

            'last_date' => $validated['last_date'],

            'apply_link' => $validated['apply_link'],

            'link' => $validated['apply_link'],

            'description' => $validated['description'] ?? null,

        ]);


        return redirect()
            ->route('admin.scholarships.index')
            ->with(
                'success',
                'Scholarship Added Successfully! Amount: ₹'
                . $validated['amount']
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT SCHOLARSHIP
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $scholarship = Scholarship::findOrFail($id);

        return view(
            'scholarships.edit',
            compact('scholarship')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE SCHOLARSHIP
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $scholarship = Scholarship::findOrFail($id);


        $validated = $request->validate([

            'title' => [
                'required',
                'string',
                'max:255'
            ],

            'provider' => [
                'nullable',
                'string',
                'max:255'
            ],

            'department' => [
                'nullable',
                'string',
                'max:255'
            ],

            'category' => [
                'nullable',
                'string',
                'max:255'
            ],

            'amount' => [
                'required',
                'string',
                'max:255'
            ],

            'last_date' => [
                'required',
                'date'
            ],

            'apply_link' => [
                'required',
                'url',
                'max:2048'
            ],

            'description' => [
                'nullable',
                'string'
            ],

        ]);


        $scholarship->update([

            'title' => $validated['title'],

            'provider' => $validated['provider'] ?? null,

            'department' => $validated['department']
                ?? $validated['provider']
                ?? null,

            'category' => $validated['category'] ?? null,

            'amount' => $validated['amount'],

            'deadline' => $validated['last_date'],

            'last_date' => $validated['last_date'],

            'apply_link' => $validated['apply_link'],

            'link' => $validated['apply_link'],

            'description' => $validated['description'] ?? null,

        ]);


        return back()->with(
            'success',
            'Scholarship Updated Successfully! Amount: ₹'
            . $validated['amount']
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE SCHOLARSHIP
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $scholarship = Scholarship::findOrFail($id);

        $scholarship->delete();

        return back()->with(
            'success',
            'Scholarship Deleted Successfully!'
        );
    }
}