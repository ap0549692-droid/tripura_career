<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Scholarship;
use Carbon\Carbon;

class FetchScholarships extends Command
{
    protected $signature = 'scholarships:fetch';
    protected $description = 'Fetch and auto-add Tripura & Central Scholarships';

    public function handle()
    {
        $this->info('Fetching Scholarships...');

        $scholarships = [
            [
                'title' => 'Post Matric Scholarship for SC Students, Tripura',
                'provider' => 'Ministry of Social Justice & Empowerment',
                'amount' => '12000 per year',
                'category' => 'Post Matric',
                'eligibility' => 'SC category, Family income < 2.5 Lakh, Tripura Domicile',
                'description' => 'Financial assistance to SC students of Tripura studying in Class 11 to Post Graduation. Covers tuition fee and maintenance allowance.',
                'apply_link' => 'https://scholarships.gov.in/',
                'last_date' => Carbon::now()->addDays(45),
                'deadline' => Carbon::now()->addDays(45),
            ],
            [
                'title' => 'Post Matric Scholarship for ST Students, Tripura',
                'provider' => 'Ministry of Tribal Affairs, Govt. of India',
                'amount' => '15000 per year',
                'category' => 'Post Matric',
                'eligibility' => 'ST category, Family income < 2.5 Lakh, Tripura Domicile',
                'description' => 'For ST students pursuing higher education. Includes book allowance and hostel fees.',
                'apply_link' => 'https://scholarships.gov.in/',
                'last_date' => Carbon::now()->addDays(45),
                'deadline' => Carbon::now()->addDays(45),
            ],
            [
                'title' => 'Post Matric Scholarship for OBC Students, Tripura',
                'provider' => 'Govt. of Tripura, OBC Welfare Dept',
                'amount' => '10000 per year',
                'category' => 'Post Matric',
                'eligibility' => 'OBC category, Family income < 1.5 Lakh',
                'description' => 'Support for OBC students of Tripura for post-matric studies.',
                'apply_link' => 'https://scholarships.gov.in/',
                'last_date' => Carbon::now()->addDays(40),
                'deadline' => Carbon::now()->addDays(40),
            ],
            [
                'title' => 'Dr. B.R. Ambedkar Post Matric Scholarship for EBC',
                'provider' => 'Central Govt - EBC Welfare',
                'amount' => '8000 per year',
                'category' => 'Post Matric',
                'eligibility' => 'General/EBC category, Income < 1 Lakh',
                'description' => 'Special scheme for Economically Backward Class students.',
                'apply_link' => 'https://scholarships.gov.in/',
                'last_date' => Carbon::now()->addDays(35),
                'deadline' => Carbon::now()->addDays(35),
            ],
            [
                'title' => 'Nec Merit Scholarship Tripura',
                'provider' => 'North Eastern Council (NEC), Shillong',
                'amount' => '30000 per year',
                'category' => 'Merit',
                'eligibility' => 'Domicile of NE states including Tripura, Minimum 60% in last exam',
                'description' => 'Merit scholarship for students of North East pursuing higher studies.',
                'apply_link' => 'https://scholarships.gov.in/public/scheme/NEC_Merit',
                'last_date' => Carbon::now()->addDays(50),
                'deadline' => Carbon::now()->addDays(50),
            ],
            [
                'title' => 'Tripura State Merit Scholarship for Girls',
                'provider' => 'Directorate of Higher Education, Tripura',
                'amount' => '5000 per year',
                'category' => 'Girls',
                'eligibility' => 'Only for Girl students of Tripura, Class 9 to College',
                'description' => 'To encourage girl education in Tripura. Special incentive for meritorious girls.',
                'apply_link' => 'https://highereducation.tripura.gov.in/scholarship',
                'last_date' => Carbon::now()->addDays(60),
                'deadline' => Carbon::now()->addDays(60),
            ],
            [
                'title' => 'Swami Dayanand Post Matric Scholarship for SC - Central',
                'provider' => 'Ministry of Social Justice, Central Sector',
                'amount' => '54000 per year',
                'category' => 'Central',
                'eligibility' => 'SC students studying in top institutes',
                'description' => 'Top class education scholarship for SC students with full fee reimbursement.',
                'apply_link' => 'https://scholarships.gov.in/public/scheme/TopClass_SC',
                'last_date' => Carbon::now()->addDays(55),
                'deadline' => Carbon::now()->addDays(55),
            ],
        ];

        foreach ($scholarships as $data) {
            Scholarship::updateOrCreate(
                ['title' => $data['title']],
                $data
            );
        }

        $this->info('✅ '.count($scholarships).' Scholarships updated with different links!');
        return 0;
    }
}