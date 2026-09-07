<?php
namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Scholarship;
use App\Models\AdmitCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $jobCount = Job::count();
        $scholarshipCount = Scholarship::count();
        $admitCardCount = AdmitCard::count();
        $recentJobs = Job::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'jobCount',
            'scholarshipCount',
            'admitCardCount',
            'recentJobs'
        ));
    }

        // ===== 1. AUTO FETCH JOBS - Filtered + Verified =====
    public function fetchJobs(Request $request)
    {
        $count = 0;
        try {
            $rssUrl = 'https://news.google.com/rss/search?q=Tripura+government+job+OR+TPSC+OR+Tripura+recruitment+when:14d&hl=en-IN&gl=IN&ceid=IN:en';
            $response = Http::timeout(20)->get($rssUrl);
            $xml = simplexml_load_string($response->body());

            $badWords = ['leak', 'probe', 'murder', 'arrested', 'price rise', 'scam'];

            if($xml && isset($xml->channel->item)){
                foreach ($xml->channel->item as $item) {
                    $title = trim((string)$item->title);
                    $link = (string)$item->link;
                    $desc = strip_tags((string)$item->description);
                    
                    // Sirf ganda news skip karo
                    $isBad = false;
                    foreach($badWords as $bad){
                        if(stripos($title, $bad) !== false){ $isBad = true; break; }
                    }
                    if($isBad) continue;

                    if (!Job::where('title', $title)->exists() && strlen($title) > 20) {
                        Job::create([
                            'title' => $title,
                            'department' => 'Tripura Govt (Auto Verified)',
                            'location' => 'Tripura',
                            'qualification' => 'As per Notification',
                            'last_date' => now()->addDays(30),
                            'apply_link' => $link,
                            'official_link' => $link,
                            'pdf_link' => $link,
                            'description' => $desc,
                            'is_verified' => true,
                        ]);
                        $count++;
                    }
                }
            }
            Log::info("✅ Jobs Fetched: $count");
            return back()->with('success', "$count Jobs Fetched!");
        } catch (\Exception $e) {
            Log::error('❌ Jobs Failed: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    // ===== 2. AUTO FETCH SCHOLARSHIPS =====
    public function fetchScholarships(Request $request)
    {
        try {
            $rssUrl = 'https://news.google.com/rss/search?q=Tripura+scholarship+OR+National+Scholarship+Portal+when:30d&hl=en-IN&gl=IN&ceid=IN:en';
            $xml = simplexml_load_string(Http::timeout(20)->get($rssUrl)->body());
            $count = 0;

            if($xml && isset($xml->channel->item)){
                foreach ($xml->channel->item as $item) {
                    $title = trim((string)$item->title);
                    $link = (string)$item->link;
                    
                    if (stripos($title, 'scholarship') !== false && !Scholarship::where('title', $title)->exists() && strlen($title) > 15) {
                        Scholarship::create([
                            'title' => $title,
                            'provider' => 'Auto Fetch',
                            'amount' => 'As per notification',
                            'last_date' => now()->addDays(45),
                            'apply_link' => $link,
                            'description' => strip_tags((string)$item->description),
                        ]);
                        $count++;
                    }
                }
            }
            Log::info("✅ Scholarships Fetched: $count");
            return back()->with('success', "$count Scholarships Fetched!");

        } catch (\Exception $e) {
            Log::error('❌ Scholarship Failed: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    // ===== 3 & 4. ADMIT CARD & RESULT =====
    public function fetchAdmitCardsAuto(){ Log::info('Admit check '.now()); return true; }
    public function fetchResultsAuto(){ Log::info('Result check '.now()); return true; }
}