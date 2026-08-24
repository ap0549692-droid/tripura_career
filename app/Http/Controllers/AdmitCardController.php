<?php
namespace App\Http\Controllers;
use App\Models\AdmitCard;
use Illuminate\Http\Request;

class AdmitCardController extends Controller
{
    // Ye admin wala hai
    public function adminIndex(){
        $admitCards = AdmitCard::latest()->get();
        return view('admin.admit-cards.index', compact('admitCards'));
    }

    // Ye public wala hai
    public function publicIndex()
    {
        $admitCards = AdmitCard::latest()->get();
        return view('admit-cards.index', compact('admitCards'));
    }

    public function create(){ 
        return view('admin.admit-cards.create'); 
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'department' => 'required',
            'exam_date' => 'required',
            'admit_link' => 'required|url'
        ]);
        AdmitCard::create($request->all());
        return redirect()->route('admin.admit-cards.index')->with('success','Admit Card Added!');
    }

    public function edit($id){
        $card = AdmitCard::findOrFail($id);
        return view('admin.admit-cards.edit', compact('card'));
    }

    public function update(Request $request, $id){
        AdmitCard::findOrFail($id)->update($request->all());
        return redirect()->route('admin.admit-cards.index')->with('success','Updated!');
    }

    public function destroy($id){
        AdmitCard::findOrFail($id)->delete();
        return back()->with('success','Deleted!');
    }
}