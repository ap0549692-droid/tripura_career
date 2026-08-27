<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Scholarship;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;

class FetchScholarships extends Command
{
    protected $signature = 'scholarships:fetch';
    protected $description = 'Fetch and auto-add Tripura & Central Scholarships with Auto Poster';

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
                'category' => 'Central',
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
            $scholarship = Scholarship::updateOrCreate(
                ['title' => $data['title']],
                $data
            );

            if ($scholarship->wasRecentlyCreated) {
                $this->info("-> New Scholarship Found: {$data['title']}");
                try {
                    $posterPath = $this->generateScholarshipPoster($scholarship);
                    $this->postToSocials($scholarship, $posterPath);
                } catch (\Exception $e) {
                    Log::error("Scholarship Poster Error: " . $e->getMessage());
                    $this->error($e->getMessage());
                }
            }
        }

        $this->info('✅ '.count($scholarships).' Scholarships updated!');
        return 0;
    }

        private function generateScholarshipPoster($scholarship)
{
    $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
    $image = $manager->create(1080, 1350);
    $image->fill('#0f172a');

    // Header Blue
    $image->drawRectangle(0, 0, function($r){ $r->size(1080, 220); $r->background('#1e40af'); });

    $fontBold = public_path('fonts/Poppins-Bold.ttf');
    $fontRegular = public_path('fonts/Poppins-Regular.ttf');

    // TRIPURA CAREER
    $image->text('TRIPURA CAREER', 540, 50, function($f) use ($fontBold){
        $f->filename($fontBold); $f->size(50); $f->color('#ffffff'); $f->align('center'); $f->valign('top');
    });
    $image->text('SCHOLARSHIP ALERT', 540, 125, function($f) use ($fontBold){
        $f->filename($fontBold); $f->size(32); $f->color('#bfdbfe'); $f->align('center');
    });

    // White card
    $image->drawRectangle(50, 260, function($r){ $r->size(980, 850); $r->background('#ffffff'); });

    // Title
    $title = strtoupper($scholarship->title);
    $title = wordwrap($title, 28, "\n", true);
    $image->text($title, 540, 300, function($f) use ($fontBold){
        $f->filename($fontBold); $f->size(38); $f->color('#0f172a'); $f->align('center'); $f->valign('top'); $f->lineHeight(1.3);
    });

    // Amount Box Yellow
    $image->drawRectangle(140, 600, function($r){ $r->size(800, 110); $r->background('#facc15'); });
    $amt = 'Amount: Rs. ' . ($scholarship->amount ?? 'As per norms');
    $image->text($amt, 540, 660, function($f) use ($fontBold){
        $f->filename($fontBold); $f->size(34); $f->color('#000000'); $f->align('center');
    });

    // Eligibility
    $elig = 'Eligibility: ' . ($scholarship->eligibility ?? 'Check official notification');
    $elig = wordwrap($elig, 55, "\n", true);
    $image->text($elig, 540, 800, function($f) use ($fontRegular){
        $f->filename($fontRegular); $f->size(22); $f->color('#334155'); $f->align('center'); $f->lineHeight(1.4);
    });

    // Last Date RED
    $date = 'Last Date: ' . \Carbon\Carbon::parse($scholarship->last_date ?? now()->addDays(15))->format('d M, Y');
    $image->text($date, 540, 920, function($f) use ($fontBold){
        $f->filename($fontBold); $f->size(32); $f->color('#dc2626'); $f->align('center');
    });

    // Footer
    $image->text('Apply at: scholarships.gov.in', 540, 1160, function($f) use ($fontRegular){
        $f->filename($fontRegular); $f->size(24); $f->color('#ffffff'); $f->align('center');
    });
    $image->text('Follow @tripura_career for daily updates', 540, 1210, function($f) use ($fontRegular){
        $f->filename($fontRegular); $f->size(20); $f->color('#94a3b8'); $f->align('center');
    });

    $path = storage_path('app/public/scholarship_' . $scholarship->id . '.jpg');
    $image->toJpeg(95)->save($path);
    return $path;
}

    private function postToSocials($scholarship, $posterPath)
    {
        $caption = "🎓 {$scholarship->title}\n\nProvider: {$scholarship->provider}\nAmount: {$scholarship->amount}\nEligibility: {$scholarship->eligibility}\nLast Date: " . Carbon::parse($scholarship->last_date)->format('d M Y') . "\n\nApply Link in Bio / Visit scholarships.gov.in\n\n#TripuraScholarship #ScholarshipAlert #TripuraCareer";

        // Upload to Catbox for Public URL
        $response = Http::attach('fileToUpload', file_get_contents($posterPath), basename($posterPath))
            ->post('https://catbox.moe/user/api.php', ['reqtype' => 'fileupload']);
        
        $publicUrl = trim($response->body());
        $this->info("-> Public URL: $publicUrl");

        if (str_starts_with($publicUrl, 'https://')) {
            // FB Post
            $fbPageId = env('FB_PAGE_ID');
            $fbToken = env('FB_PAGE_TOKEN');
            if ($fbPageId && $fbToken) {
                Http::post("https://graph.facebook.com/{$fbPageId}/photos", [
                    'url' => $publicUrl,
                    'caption' => $caption,
                    'access_token' => $fbToken,
                ]);
                $this->info("-> FB Posted");
            }

            // IG Post
            $igUserId = env('IG_USER_ID');
            $igToken = env('IG_PAGE_TOKEN');
            if ($igUserId && $igToken) {
                $container = Http::post("https://graph.facebook.com/v20.0/{$igUserId}/media", [
                    'image_url' => $publicUrl,
                    'caption' => $caption,
                    'access_token' => $igToken,
                ])->json();

                if (isset($container['id'])) {
                    sleep(10);
                    Http::post("https://graph.facebook.com/v20.0/{$igUserId}/media_publish", [
                        'creation_id' => $container['id'],
                        'access_token' => $igToken,
                    ]);
                    $this->info("-> Posted to IG Success!");
                }
            }
        }
    }
}