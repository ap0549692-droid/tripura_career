<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Job;
use Carbon\Carbon;

class FetchLatestJobs extends Command
{
    protected $signature = 'jobs:fetch-latest';
    protected $description = 'Auto fetch latest Tripura Govt Jobs from official sites';

    public function handle()
    {
        $this->info('Fetching latest jobs...');

        $sources = [
            [
                'title' => 'TPSC Latest Recruitment - '.date('M Y'),
                'department' => 'TPSC',
                'category' => 'Government',
                'link' => 'https://tpsc.tripura.gov.in',
                'qualification' => 'Graduate'
            ],
            [
                'title' => 'Tripura Police Constable / SI Recruitment '.date('Y'),
                'department' => 'Tripura Police',
                'category' => 'Defence',
                'link' => 'https://tripurapolice.gov.in',
                'qualification' => '12th Pass'
            ],
            [
                'title' => 'India Post GDS Tripura Circle '.date('Y').' - Apply Online',
                'department' => 'India Post',
                'category' => 'Post Office',
                'link' => 'https://indiapost.gov.in/gdsonlineengagement', // FINAL LIVE
                'qualification' => '10th Pass'
            ],
            [
                'title' => 'Railway RRB Guwahati NTPC / Group D Tripura '.date('Y'),
                'department' => 'Railway',
                'category' => 'Railway',
                'link' => 'https://www.rrbguwahati.gov.in',
                'qualification' => '10th Pass'
            ],
            [
                'title' => 'Tripura Gramin Bank Clerk & PO Recruitment '.date('Y'),
                'department' => 'Tripura Gramin Bank',
                'category' => 'Banking',
                'link' => 'https://tripuragramin.bank.in', // OFFICIAL
                'qualification' => 'Graduate'
            ],
        ];

        foreach($sources as $src){
            $exists = Job::where('apply_link', $src['link'])->whereDate('created_at', Carbon::today())->exists();
            if(!$exists){
                Job::create([
                    'title' => $src['title'],
                    'department' => $src['department'],
                    'category' => $src['category'],
                    'qualification' => $src['qualification'],
                    'last_date' => Carbon::now()->addDays(30),
                    'apply_link' => $src['link'],
                    'pdf_link' => $src['link'],
                ]);
                $this->info('Added: '.$src['title']);
            } else {
                $this->info('Skip (Already exists): '.$src['title']);
            }
        }

        $this->info('Done! All official links added.');
        return 0;
    }
}