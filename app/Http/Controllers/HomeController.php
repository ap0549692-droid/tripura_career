<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\AdmitCard;
use App\Models\Scholarship;

class HomeController extends Controller
{
    public function index()
    {
        // Jobs
        $jobs = Job::latest()->get();

        // Admit Cards
        $admitCards = AdmitCard::latest()->get();

        // Scholarships
        $scholarships = Scholarship::latest()->get();

        return view('home', compact(
            'jobs',
            'admitCards',
            'scholarships'
        ));
    }
}