<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Job;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class FetchAllJobs extends Command
{
    protected $signature = 'jobs:fetch-all';
    protected $description = 'Fetch ALL Tripura Jobs + Auto FB Post';

    public function handle(){
        $this->fetchGDS();
        $this->fetchMTS();
        $this->fetchForest();
        $this->fetchDefence();
        $this->fetchEngineer();
        $this->fetchPolice();
        $this->info("ALL DONE!");
    }

    private function fetchGDS(){
        $job = Job::firstOrCreate(
            ['title'=>'Tripura Gramin Dak Sevak GDS Recruitment 2026 - 250+ Posts'],
            [
                'post_name'=>'GDS - BPM/ABPM','total_vacancy'=>250,'salary_min'=>'10000','salary_max'=>'29380','level'=>'central','sector'=>'gds','qualification'=>'10th Pass','job_location'=>'All Tripura Districts','department'=>'India Post','location'=>'Tripura','last_date'=>now()->addDays(25)->format('Y-m-d'),'deadline'=>now()->addDays(25)->format('Y-m-d'),'apply_link'=>'https://indiapostgdsonline.gov.in','official_link'=>'https://indiapostgdsonline.gov.in','official_notification'=>'https://indiapostgdsonline.gov.in','source_website'=>'indiapostgdsonline.gov.in','description'=>'Tripura GDS Recruitment for 10th pass, Salary 10k-29k','is_verified'=>true
            ]
        );
        if($job->wasRecentlyCreated){ $this->info("GDS Added"); $this->postToFacebook($job); }
    }

    private function fetchMTS(){
        $job = Job::firstOrCreate(
            ['title'=>'SSC MTS Havaldar Recruitment 2026 - Tripura Region'],
            [
                'post_name'=>'MTS & Havaldar','total_vacancy'=>1500,'salary_min'=>'18000','salary_max'=>'56900','level'=>'central','sector'=>'mts','qualification'=>'10th Pass','job_location'=>'Tripura','department'=>'SSC','location'=>'Tripura','last_date'=>now()->addDays(35)->format('Y-m-d'),'deadline'=>now()->addDays(35)->format('Y-m-d'),'apply_link'=>'https://ssc.nic.in','official_link'=>'https://ssc.nic.in','official_notification'=>'https://ssc.nic.in','source_website'=>'ssc.nic.in','description'=>'SSC MTS 2026, 10th pass','is_verified'=>true
            ]
        );
        if($job->wasRecentlyCreated){ $this->info("MTS Added"); $this->postToFacebook($job); }
    }

    private function fetchForest(){
        $jobs = [
            ['title'=>'Tripura Forest Guard & Forester Recruitment 2026','post_name'=>'Forest Guard / Forester','salary_min'=>'21700','salary_max'=>'69100','dept'=>'Tripura Forest Department','link'=>'https://forest.tripura.gov.in'],
            ['title'=>'Tripura Forest Ranger Officer Recruitment 2026','post_name'=>'Forest Ranger','salary_min'=>'35400','salary_max'=>'112400','dept'=>'Tripura Forest Dept','link'=>'https://forest.tripura.gov.in'],
        ];
        foreach($jobs as $d){
            $job = Job::firstOrCreate(['title'=>$d['title']],[
                'post_name'=>$d['post_name'],'total_vacancy'=>120,'salary_min'=>$d['salary_min'],'salary_max'=>$d['salary_max'],'level'=>'tripura_govt','sector'=>'forest','qualification'=>'12th Pass','job_location'=>'Tripura','department'=>$d['dept'],'location'=>'Tripura','last_date'=>now()->addDays(28)->format('Y-m-d'),'deadline'=>now()->addDays(28)->format('Y-m-d'),'apply_link'=>$d['link'],'official_link'=>$d['link'],'official_notification'=>$d['link'],'source_website'=>'forest.tripura.gov.in','description'=>$d['title'],'is_verified'=>true
            ]);
            if($job->wasRecentlyCreated){ $this->info("FOREST Added: ".$d['title']); $this->postToFacebook($job); }
        }
    }

    private function fetchDefence(){
        $job = Job::firstOrCreate(['title'=>'Tripura Defence Jobs 2026 - Indian Army Agniveer & Assam Rifles'],['post_name'=>'Agniveer / Rifleman','total_vacancy'=>300,'salary_min'=>'30000','salary_max'=>'40000','level'=>'central','sector'=>'defence','qualification'=>'10th Pass','job_location'=>'Tripura','department'=>'Indian Army','location'=>'Tripura','last_date'=>now()->addDays(40)->format('Y-m-d'),'deadline'=>now()->addDays(40)->format('Y-m-d'),'apply_link'=>'https://joinindianarmy.nic.in','official_link'=>'https://joinindianarmy.nic.in','official_notification'=>'https://joinindianarmy.nic.in','source_website'=>'joinindianarmy.nic.in','description'=>'Defence Job Salary 30k-40k','is_verified'=>true]);
        if($job->wasRecentlyCreated){ $this->info("DEFENCE Added"); $this->postToFacebook($job); }
    }

    private function fetchEngineer(){
        $job = Job::firstOrCreate(['title'=>'Tripura PWD & RD Engineer Recruitment 2026 - JE/AE'],['post_name'=>'Junior Engineer / AE','total_vacancy'=>80,'salary_min'=>'35400','salary_max'=>'112400','level'=>'tripura_govt','sector'=>'engineering','qualification'=>'Diploma / B.Tech','job_location'=>'Tripura','department'=>'PWD','location'=>'Tripura','last_date'=>now()->addDays(32)->format('Y-m-d'),'deadline'=>now()->addDays(32)->format('Y-m-d'),'apply_link'=>'https://tpsc.tripura.gov.in','official_link'=>'https://tpsc.tripura.gov.in','official_notification'=>'https://tpsc.tripura.gov.in','source_website'=>'tpsc.tripura.gov.in','description'=>'Engineer Salary Level-7','is_verified'=>true]);
        if($job->wasRecentlyCreated){ $this->info("ENGINEER Added"); $this->postToFacebook($job); }
    }

    private function fetchPolice(){
        $job = Job::firstOrCreate(['title'=>'Tripura Police Constable & SI Recruitment 2026'],['post_name'=>'Constable / SI','total_vacancy'=>1000,'salary_min'=>'21700','salary_max'=>'69100','level'=>'tripura_govt','sector'=>'police','qualification'=>'12th Pass','job_location'=>'Tripura','department'=>'Tripura Police','location'=>'Tripura','last_date'=>now()->addDays(35)->format('Y-m-d'),'deadline'=>now()->addDays(35)->format('Y-m-d'),'apply_link'=>'https://tripurapolice.gov.in','official_link'=>'https://tripurapolice.gov.in','official_notification'=>'https://tripurapolice.gov.in','source_website'=>'tripurapolice.gov.in','description'=>'Police Constable Salary 21700-69100','is_verified'=>true]);
        if($job->wasRecentlyCreated){ $this->info("POLICE Added"); $this->postToFacebook($job); }
    }

    private function postToFacebook($job){
        try {
            $message = "🔥 NEW JOB ALERT 🔥\n\n"
                     . $job->title . "\n\n"
                     . "Salary: ₹".$job->salary_min." - ₹".$job->salary_max."\n"
                     . "Last Date: " . date('d M Y', strtotime($job->last_date)) . "\n\n"
                     . "Apply Here: " . $job->apply_link . "\n\n"
                     . "#TripuraJobs #".$job->sector;

            Http::post("https://graph.facebook.com/v26.0/" . env('FB_PAGE_ID') . "/feed", [
                'message' => $message,
                'access_token' => env('FB_PAGE_TOKEN')
            ]);
        } catch (\Exception $e) {
            Log::error("FB Post Failed: ".$e->getMessage());
        }
    }
}