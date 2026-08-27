<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   public function index()
{
    // HomeController ke index() me
    $jobs = \App\Models\Job::latest()->take(6)->get();
    $scholarships = \App\Models\Scholarship::latest()->take(6)->get();
    $admitCards = \App\Models\AdmitCard::latest()->take(4)->get();
    
    return view('home', compact('jobs','scholarships','admitCards'));
}
}
