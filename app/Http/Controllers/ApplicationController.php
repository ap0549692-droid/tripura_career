<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Scholarship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\ApplicationSubmitted;
use Illuminate\Support\Facades\Mail;
use App\Mail\ScholarshipStatusMail;


class ApplicationController extends Controller
{
   public function updateStatus(Request $request, $id)
{
    $application = Application::with('user', 'scholarship')->find($id);
    $application->status = $request->status;
    $application->save();

    // YEH 1 LINE NAYI - Mail bhej de
    Mail::to($application->user->email)->send(new ScholarshipStatusMail($application));

    return back()->with('success', 'Status updated & Email sent to ' . $application->user->name);
}

    public function create($id)
    {
        $scholarship = Scholarship::findOrFail($id);
        return view('scholarships.create', compact('scholarship'));
    }

    public function store(Request $request, $id)
    {
        // Check if already applied
$exists = Application::where('user_id', auth()->id())
            ->where('scholarship_id', $request->scholarship_id)
            ->exists();

if($exists){
    return back()->with('error', 'You have already applied for this scholarship.');
}
        $scholarship = Scholarship::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'document' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $application = new Application();
        $application->user_id = Auth::id();
        $application->scholarship_id = $id;
        $application->name = $request->name;
        $application->email = $request->email;
        $application->phone = $request->phone;
        $application->status = 'Pending';

        if($request->hasFile('document')){
            $file = $request->file('document');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $application->document = $filename;
        }

        $application->save();

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }
    public function myApplications()
{
    $applications = Application::where('user_id', auth()->id())
                        ->with('scholarship')
                        ->latest()
                        ->get();

    return view('applications.my', compact('applications'));
}


}