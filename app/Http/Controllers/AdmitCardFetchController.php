<?php
namespace App\Http\Controllers;
use App\Models\AdmitCard;

class AdmitCardFetchController extends Controller
{
    public function fetch()
    {
        $data = [
            ['title'=>'TPSC Combined Exam Admit Card 2026','department'=>'TPSC','exam_date'=>'2026-09-20','description'=>'TPSC Admit Card Released','download_link'=>'https://tpsc.tripura.gov.in','release_date'=>'2026-09-05'],
            ['title'=>'Tripura Police Constable Admit Card','department'=>'Tripura Police','exam_date'=>'2026-09-25','description'=>'Police Constable Exam','download_link'=>'https://tripurapolice.gov.in','release_date'=>'2026-09-10'],
            ['title'=>'JRBT Group D Admit Card 2026','department'=>'JRBT','exam_date'=>'2026-10-01','description'=>'JRBT Admit Card','download_link'=>'https://jrbt.tripura.gov.in','release_date'=>'2026-09-12'],
            ['title'=>'TRBT Teacher Exam Admit Card','department'=>'TRBT','exam_date'=>'2026-09-28','description'=>'Teacher eligibility test','download_link'=>'https://trb.tripura.gov.in','release_date'=>'2026-09-08'],
            ['title'=>'Tripura High Court LDC Admit Card','department'=>'High Court','exam_date'=>'2026-09-22','description'=>'LDC Exam Admit Card','download_link'=>'https://thc.nic.in','release_date'=>'2026-09-09'],
        ];
        $c=0; foreach($data as $d){ if(!AdmitCard::where('title',$d['title'])->exists()){ AdmitCard::create($d); $c++; } }
        return redirect()->route('admin.dashboard')->with('success', "$c Admit Cards Added!");
    }
}