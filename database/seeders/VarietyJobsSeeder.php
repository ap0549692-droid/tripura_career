<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Job;
use Carbon\Carbon;

class VarietyJobsSeeder extends Seeder
{
    public function run()
    {
        Job::truncate();

        $jobs = [
            ['title'=>'Tripura Gramin Bank Clerk 2026 - 120 Posts', 'department'=>'Tripura Gramin Bank', 'category'=>'Banking', 'link'=>'https://tripuragramin.bank.in'],
            ['title'=>'SBI PO Recruitment Tripura - 50 Posts', 'department'=>'SBI', 'category'=>'Banking', 'link'=>'https://bank.sbi/careers'],
            ['title'=>'Tripura Police Constable 916 Posts', 'department'=>'Tripura Police', 'category'=>'Defence', 'link'=>'https://tripurapolice.gov.in'],
            ['title'=>'Indian Army Agniveer Rally Agartala 2026', 'department'=>'Indian Army', 'category'=>'Defence', 'link'=>'https://joinindianarmy.nic.in'],
            ['title'=>'India Post GDS Tripura 2026 - 850 Posts', 'department'=>'India Post', 'category'=>'Post Office', 'link'=>'https://indiapost.gov.in/gdsonlineengagement'],
            ['title'=>'India Post Postman / MTS Tripura', 'department'=>'India Post', 'category'=>'Post Office', 'link'=>'https://indiapost.gov.in/gdsonlineengagement'],
            ['title'=>'Railway RRB NTPC Tripura - 1200 Vacancies', 'department'=>'Railway', 'category'=>'Railway', 'link'=>'https://www.rrbguwahati.gov.in'],
            ['title'=>'NFR Railway Apprentice - Agartala Workshop', 'department'=>'Railway', 'category'=>'Railway', 'link'=>'https://nfr.indianrailways.gov.in'],
            ['title'=>'TPSC Combined Service - 40 Posts', 'department'=>'TPSC', 'category'=>'Government', 'link'=>'https://tpsc.tripura.gov.in'],
            ['title'=>'JRBT LDC / MTS - Tripura', 'department'=>'JRBT', 'category'=>'Government', 'link'=>'https://jrbt.tripura.gov.in'],
            ['title'=>'Private Job - Customer Care Executive Agartala', 'department'=>'Private Sector', 'category'=>'Private', 'link'=>'https://www.naukri.com/jobs-in-agartala'],
            ['title'=>'Private Job - Sales Boy / Girl Agartala', 'department'=>'Private Sector', 'category'=>'Private', 'link'=>'https://www.naukri.com/jobs-in-agartala'],
        ];

               foreach($jobs as $j){
            Job::create([
                'title'=>$j['title'],
                'department'=>$j['department'],
                'category'=>$j['category'],
                'qualification'=>'Graduate / 12th Pass',
                'last_date'=>Carbon::now()->addDays(30),
                'apply_link'=>$j['link'],
                'pdf_link'=>$j['link'],
            ]);
        }
    }
}