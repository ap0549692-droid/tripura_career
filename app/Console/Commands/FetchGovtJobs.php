<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Job;
use Symfony\Component\DomCrawler\Crawler;

class FetchGovtJobs extends Command
{
    protected $signature = 'jobs:fetch';
    protected $description = 'Auto fetch TPSC Jobs + FB + IG with Dynamic Poster';

    public function handle()
    {
        $response = Http::withHeaders([
    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
    'Accept-Language' => 'en-US,en;q=0.9',
    'Referer' => 'https://tpsc.tripura.gov.in/',
])->withoutVerifying()->timeout(60)->retry(5, 3000)->get('https://tpsc.tripura.gov.in/advertisement');

            if(!$response->successful()){
                $this->error('Failed: '.$response->status());
                return;
            }

            $crawler = new Crawler($response->body());
            $count = 0;

            $crawler->filter('a')->each(function (Crawler $node) use (&$count) {
                $text = trim($node->text(''));
                $href = $node->attr('href')?? '';
                if(strlen($text) < 20) return;
                $lower = strtolower($text);
                if(str_contains($lower,'answer key') || str_contains($lower,'provisional')) return;
                if(!preg_match('/\d{2}\/\d{4}|recruitment|vacancy|junior engineer|forest.*guard|police.*constable/i', $text)) return;

                $fullLink = str_starts_with($href, 'http')? $href : 'https://tpsc.tripura.gov.in'. (str_starts_with($href, '/')? $href : '/'.$href);

                $job = Job::firstOrCreate(
                    ['title' => $text],
                    [
                        'post_name' => $this->detectPost($text),
                        'total_vacancy' => rand(10, 500),
                        'salary_min' => '18000',
                        'salary_max' => '69100',
                        'level' => 'tripura_govt',
                        'sector' => $this->detectSector($text),
                        'qualification' => 'Graduate',
                        'job_location' => 'Tripura',
                        'department' => 'TPSC Tripura',
                        'location' => 'Tripura',
                        'last_date' => now()->addDays(30)->format('Y-m-d'),
                        'deadline' => now()->addDays(30)->format('Y-m-d'),
                        'apply_link' => $fullLink,
                        'official_link' => $fullLink,
                        'official_notification' => $fullLink,
                        'source_website' => 'tpsc.tripura.gov.in',
                        'description' => $text,
                        'is_verified' => true,
                    ]
                );

                if($job->wasRecentlyCreated){
                    $count++;
                    $this->info("Added: $text");
                    $posterPath = $this->generateJobPoster($job); // Local Path
                    $this->postToFacebook($job, $posterPath);
                    $this->postToInstagram($job, $posterPath);
                }
            });
            $this->info("Total $count jobs added!");
        } catch (\Exception $e) {
            $this->error('Error: '.$e->getMessage());
        }
    }

    private function generateJobPoster($job)
    {
        $W = 1080; $H = 1080;
        $img = imagecreatetruecolor($W, $H);

        $navy = imagecolorallocate($img, 11, 35, 84);
        $orange = imagecolorallocate($img, 255, 94, 0);
        $white = imagecolorallocate($img, 255, 255, 255);
        $lightGray = imagecolorallocate($img, 230, 230, 230);
        $textGray = imagecolorallocate($img, 80, 80, 80);

        for($y=0; $y<$H; $y++){
            $r = (int)(11 + $y*0.15);
            $g = (int)(35 + $y*0.08);
            $b = (int)(84 + $y*0.05);
            $c = imagecolorallocate($img, $r, $g, $b);
            imageline($img, 0, $y, $W, $y, $c);
        }

        $fontBold = public_path('fonts/Poppins-Bold.ttf');
        $fontRegular = public_path('fonts/Poppins-Regular.ttf');

        imagettftext($img, 58, 0, 215, 155, $white, $fontBold, "TRIPURA CAREER");
        imagettftext($img, 26, 0, 350, 225, $lightGray, $fontBold, "GOVT JOB ALERT 2026");

        imagefilledrectangle($img, 40, 280, 1040, 900, imagecolorallocate($img, 0,0,0));
        imagefilledrectangle($img, 30, 270, 1030, 890, $white);

        $title = strtoupper($job->title);
        $title = wordwrap($title, 30, "\n");
        $lines = array_slice(explode("\n", $title), 0, 5);
        $y = 400;
        foreach($lines as $line){
            $line = trim($line);
            $box = imagettfbbox(30, 0, $fontBold, $line);
            $w = $box[2] - $box[0];
            $x = (1080 - $w) / 2;
            imagettftext($img, 30, 0, (int)$x, $y, $navy, $fontBold, $line);
            $y += 70;
        }

        imageline($img, 80, $y+10, 1000, $y+10, $lightGray);
        $last = date('d M, Y', strtotime($job->last_date));
        $info = "Last Date: $last";
        $box = imagettfbbox(22, 0, $fontRegular, $info);
        $x = (1080 - ($box[2]-$box[0]))/2;
        imagettftext($img, 22, 0, (int)$x, $y+60, $textGray, $fontRegular, $info);

        imagefilledrectangle($img, 80, 930, 1000, 1020, $orange);
        $btn = "Apply at tripuracareer.com";
        $box = imagettfbbox(24, 0, $fontBold, $btn);
        $x = (1080 - ($box[2]-$box[0]))/2;
        imagettftext($img, 24, 0, (int)$x, 987, $white, $fontBold, $btn);

        $dir = storage_path('app/public/posters');
        if(!file_exists($dir)) mkdir($dir, 0777, true);
        $path = $dir.'/'.$job->id.'.jpg';
        imagejpeg($img, $path, 92);
        imagedestroy($img);

        return $path; // FIX: Local path return karenge
    }

    private function postToFacebook($job, $posterPath = null){
        try {
            $message = "🔥 NEW JOB ALERT 🔥\n\n".$job->title."\n\nDepartment: ".$job->department."\nLast Date: ".date('d M Y', strtotime($job->last_date))."\n\nApply: ".$job->apply_link."\n\n#TripuraJobs #GovtJobs";

            if($posterPath && file_exists($posterPath)){
                $response = Http::attach(
                    'source', file_get_contents($posterPath), $job->id.'.jpg'
                )->post("https://graph.facebook.com/v26.0/".env('FB_PAGE_ID')."/photos", [
                    'caption' => $message,
                    'access_token' => env('FB_PAGE_TOKEN')
                ]);
            } else {
                $response = Http::post("https://graph.facebook.com/v26.0/".env('FB_PAGE_ID')."/feed", [
                    'message' => $message,
                    'access_token' => env('FB_PAGE_TOKEN')
                ]);
            }
            Log::info("FB Response: ".$response->body());
            $this->info("-> FB Posted");
        } catch (\Exception $e) {
            $this->error("FB Failed: ".$e->getMessage());
        }
    }

    // FIXED FOR NO DOMAIN
    private function postToInstagram($job, $localPosterPath){
        try {
            $igUserId = env('IG_USER_ID');
            $token = env('IG_PAGE_TOKEN')?: env('FB_PAGE_TOKEN');
            if (!$igUserId ||!$token){
                $this->error("-> IG Error: IG_USER_ID ya Token.env me nahi hai");
                return;
            }

            if(!file_exists($localPosterPath)){
                $this->error("-> IG Error: Poster file nahi mila - ".$localPosterPath);
                return;
            }

            // 1. Local file ko free public server pe upload karo (0x0.st - no API key needed)
            $this->info("-> Uploading poster to public link...");
            $resPublic = Http::attach('fileToUpload', file_get_contents($localPosterPath), $job->id.'.jpg')
                ->post('https://catbox.moe/user/api.php', [
                    'reqtype' => 'fileupload'
                ]);

            if(!$resPublic->successful()){
                $this->error("-> Public Upload Failed: ".$resPublic->body());
                return;
            }
            $publicUrl = trim($resPublic->body()); // ex: https://0x0.st/xxxx.jpg
            $this->info("-> Public URL: ".$publicUrl);

            // 2. Ab is public URL se IG pe post
            $caption = "🔥 ".$job->title."\n\nDepartment: ".$job->department."\nLast Date: ".date('d M Y', strtotime($job->last_date))."\n\nApply: tripuracareer.com (Link in Bio)\n\n#TripuraJobs #GovtJobs #TPSC #TripuraCareer";

            $res1 = Http::post("https://graph.facebook.com/v26.0/{$igUserId}/media", [
                'image_url' => $publicUrl,
                'caption' => $caption,
                'access_token' => $token
            ]);

            if (!$res1->successful()) {
                $this->error("-> IG Container: ".$res1->body()); return;
            }

            $creationId = $res1->json()['id'];
            sleep(6);

            $res2 = Http::post("https://graph.facebook.com/v26.0/{$igUserId}/media_publish", [
                'creation_id' => $creationId,
                'access_token' => $token
            ]);

            if ($res2->successful()) $this->info("-> Posted to IG Success!");
            else $this->error("-> IG Publish: ".$res2->body());

        } catch (\Exception $e) { $this->error("-> IG Error: ".$e->getMessage()); }
    }

    private function detectSector($t){ $t=strtolower($t); if(str_contains($t,'forest')) return 'forest'; if(str_contains($t,'police')) return 'police'; if(str_contains($t,'teacher')||str_contains($t,'professor')) return 'teaching'; if(str_contains($t,'engineer')) return 'engineering'; if(str_contains($t,'defence')||str_contains($t,'army')) return 'defence'; return 'general'; }
    private function detectPost($t){ $t=strtolower($t); if(str_contains($t,'forest')) return 'Forest Guard'; if(str_contains($t,'gds')) return 'GDS'; return 'Multiple Posts'; }
}
