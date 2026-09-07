<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdmitCard;

class AdmitCardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PUBLIC
    |--------------------------------------------------------------------------
    */

    // All Admit Cards
    public function index()
    {
        $admitCards = AdmitCard::latest()->get();

        return view('admit-cards.index', compact('admitCards'));
    }


    // Single Admit Card
    public function show($id)
    {
        $admitCard = AdmitCard::findOrFail($id);

        return view('admit-cards.show', compact('admitCard'));
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    // Admin Admit Card List
    public function adminIndex()
    {
        $admitCards = AdmitCard::latest()->paginate(20);

        return view('admin.admit-cards.index', compact('admitCards'));
    }


    // Create Page
    public function create()
    {
        return view('admin.admit-cards.create');
    }


    // Save Admit Card
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'description' => 'nullable|string',
        ]);

        AdmitCard::create([
            'title' => $request->title,
            'link' => $request->link,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('admin.admit-cards.index')
            ->with('success', 'Admit Card added successfully!');
    }


    // Edit Page
    public function edit($id)
    {
        $admitCard = AdmitCard::findOrFail($id);

        return view('admin.admit-cards.edit', compact('admitCard'));
    }


    // Update
    public function update(Request $request, $id)
    {
        $admitCard = AdmitCard::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'description' => 'nullable|string',
        ]);

        $admitCard->update([
            'title' => $request->title,
            'link' => $request->link,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('admin.admit-cards.index')
            ->with('success', 'Admit Card updated successfully!');
    }


    // Delete
    public function destroy($id)
    {
        $admitCard = AdmitCard::findOrFail($id);

        $admitCard->delete();

        return back()->with(
            'success',
            'Admit Card deleted successfully!'
        );
    }


    // Bulk Delete
    public function bulkDelete()
    {
        AdmitCard::query()->delete();

        return back()->with(
            'success',
            'All Admit Cards deleted successfully!'
        );
    }
}