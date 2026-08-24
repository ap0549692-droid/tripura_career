<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class MyApplicationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $applications = Application::with('scholarship')
                        ->where('user_id', Auth::id())
                        ->latest()
                        ->get();
                        
        return view('scholarship.my-applications', compact('applications'));
    }
}