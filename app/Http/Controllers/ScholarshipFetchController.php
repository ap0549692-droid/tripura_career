<?php
namespace App\Http\Controllers;
use App\Models\Scholarship;

class ScholarshipFetchController extends Controller
{
    public function fetch()
    {
        $data = [
            ['title'=>'Tripura Post Matric Scholarship 2026','provider'=>'Govt of Tripura','eligibility'=>'ST/SC/OBC','amount'=>'Rs. 12000/year','description'=>'Post Matric scholarship for Tripura students','apply_link'=>'https://scholarship.tripura.gov.in','last_date'=>'2026-10-15'],
            ['title'=>'Tripura Merit Cum Means Scholarship','provider'=>'Education Dept','eligibility'=>'Graduate','amount'=>'Rs. 20000','description'=>'Merit scholarship','apply_link'=>'https://tripura.gov.in','last_date'=>'2026-09-30'],
            ['title'=>'NEC Merit Scholarship Tripura','provider'=>'NEC','eligibility'=>'12th Pass','amount'=>'Rs. 15000','description'=>'North East Council Scholarship','apply_link'=>'https://scholarships.gov.in','last_date'=>'2026-10-20'],
            ['title'=>'Tripura Minority Scholarship 2026','provider'=>'Minority Welfare','eligibility'=>'Minority Students','amount'=>'Rs. 10000','description'=>'For minority community','apply_link'=>'https://scholarships.gov.in','last_date'=>'2026-10-10'],
            ['title'=>'Tripura Girls Higher Education Scholarship','provider'=>'Women & Child Dev','eligibility'=>'Girls 12th Pass','amount'=>'Rs. 25000','description'=>'For girl students of Tripura','apply_link'=>'https://tripura.gov.in','last_date'=>'2026-11-01'],
        ];
        $c=0; foreach($data as $d){ if(!Scholarship::where('title',$d['title'])->exists()){ Scholarship::create($d); $c++; } }
        return redirect()->route('admin.dashboard')->with('success', "$c Scholarships Added!");
    }
}