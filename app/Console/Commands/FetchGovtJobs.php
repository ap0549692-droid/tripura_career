<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Job;
use Symfony\Component\DomCrawler\Crawler;

class FetchGovtJobs extends Command
{
    protected $signature = 'jobs:fetch';
    protected $description = 'Auto fetch TPSC Jobs';

    public function handle()
    {
        $this->info('Fetching from TPSC...');
        try {
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language' => 'en-US,en;q=0.9',
                'Referer' => 'https://tpsc.tripura.gov.in/',
            ])->withoutVerifying()->timeout(30)->retry(3, 1000)->get('https://tpsc.tripura.gov.in/advertisement');
            
            if(!$response->successful()){
                $this->error('Failed with status: '.$response->status());
                return;
            }

            $html = $response->body();
            file_put_contents(storage_path('app/tpsc.html'), $html);
            $this->info('HTML saved - size: '.strlen($html));

            $crawler = new Crawler($html);
            
            $this->info('Links found: '.$crawler->filter('a')->count());

            $count = 0;
            $crawler->filter('a')->each(function (Crawler $node) use (&$count) {
                $text = trim($node->text(''));
                $href = $node->attr('href') ?? '';
                
                if(strlen($text) > 20 && preg_match('/advertisement|recruitment|vacancy/i', $text)) {
                    
                    // Filter OMR/Answer Key
                    if(preg_match('/omr|answer key|syllabus/i', $text)) return;

                    if(!Job::where('title', $text)->exists()){
                        Job::create([
                            'title' => $text,
                            'department' => 'TPSC Tripura',
                            'qualification' => 'As per Notification',
                            'last_date' => now()->addDays(30),
                            'apply_link' => str_starts_with($href, 'http') ? $href : 'https://tpsc.tripura.gov.in'. (str_starts_with($href, '/') ? $href : '/'.$href),
                            'pdf_link' => str_starts_with($href, 'http') ? $href : 'https://tpsc.tripura.gov.in'. (str_starts_with($href, '/') ? $href : '/'.$href),
                        ]);
                        $count++;
                        $this->info("Added: $text");
                    }
                }
            });
            
            $this->info("Total $count jobs added!");
            
        } catch (\Exception $e) {
            $this->error('Error: '.$e->getMessage());
        }
    }
}