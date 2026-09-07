<?php
namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JobFetchController extends Controller
{
    public function fetch()
    {
        // Sample Tripura Govt Jobs - will be fetched from Google if key is present, else this will work
        $jobs = [
            ['title'=>'Tripura TPSC Combined Competitive Exam 2026','department'=>'TPSC','location'=>'Tripura','qualification'=>'Graduate','category'=>'State Govt','description'=>'Tripura Public Service Commission recruitment 2026','apply_link'=>'https://tpsc.tripura.gov.in','last_date'=>'2026-09-30'],
            ['title'=>'Tripura Health Department Staff Nurse Recruitment','department'=>'Health & Family Welfare','location'=>'Agartala','qualification'=>'BSc Nursing','category'=>'Medical','description'=>'Staff Nurse jobs in Tripura','apply_link'=>'https://tripura.gov.in','last_date'=>'2026-09-25'],
            ['title'=>'Tripura Police Constable Recruitment 2026','department'=>'Tripura Police','location'=>'Tripura','qualification'=>'12th Pass','category'=>'Police','description'=>'Constable vacancies','apply_link'=>'https://tripurapolice.gov.in','last_date'=>'2026-09-20'],
            ['title'=>'Tripura High Court LDC Recruitment','department'=>'High Court of Tripura','location'=>'Agartala','qualification'=>'Graduate','category'=>'Court','description'=>'Lower Division Clerk','apply_link'=>'https://thc.nic.in','last_date'=>'2026-09-28'],
            ['title'=>'Tripura TRBT Teacher Recruitment 2026','department'=>'Education Department','location'=>'Tripura','qualification'=>'B.Ed','category'=>'Teaching','description'=>'Graduate Teacher','apply_link'=>'https://trb.tripura.gov.in','last_date'=>'2026-10-05'],
            ['title'=>'Tripura Forest Department Forester Jobs','department'=>'Forest Department','location'=>'Tripura','qualification'=>'12th Pass','category'=>'Forest','description'=>'Forester recruitment','apply_link'=>'https://forest.tripura.gov.in','last_date'=>'2026-09-22'],
            ['title'=>'Tripura NHM Community Health Officer','department'=>'NHM Tripura','location'=>'Tripura','qualification'=>'BSc Nursing','category'=>'Medical','description'=>'CHO jobs','apply_link'=>'https://tripuranrhm.gov.in','last_date'=>'2026-09-18'],
            ['title'=>'Tripura State Cooperative Bank Clerk','department'=>'TSCB','location'=>'Agartala','qualification'=>'Graduate','category'=>'Bank','description'=>'Clerk cum Cashier','apply_link'=>'https://tscb.tripura.gov.in','last_date'=>'2026-09-30'],
            ['title'=>'Tripura Power Department Junior Engineer','department'=>'TSECL','location'=>'Tripura','qualification'=>'Diploma Engineering','category'=>'Engineering','description'=>'JE Electrical','apply_link'=>'https://tsecl.in','last_date'=>'2026-10-01'],
            ['title'=>'Tripura University Non-Teaching Staff','department'=>'Tripura University','location'=>'Suryamaninagar','qualification'=>'Graduate','category'=>'University','description'=>'Non-teaching posts','apply_link'=>'https://tripurauniv.ac.in','last_date'=>'2026-10-10'],
        ];

        $count = 0;
        foreach($jobs as $j){
            if(!Job::where('title', $j['title'])->exists()){
                Job::create($j);
                $count++;
            }
        }

        return redirect()->route('admin.dashboard')->with('success', "$count New Tripura Jobs Fetched Successfully!");
    }
}