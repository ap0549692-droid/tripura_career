<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Job;
use App\Models\Scholarship;
use App\Models\Application;
use App\Services\SocialPoster;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard', [
            'totalJobs' => Job::count(),
            'totalScholarships' => Scholarship::count(),
            'totalApplications' => Application::count(),
            'recentJobs' => Job::latest()->take(10)->get(),
            'recentScholarships' => Scholarship::latest()->take(10)->get(),
        ]);
    }

        public function fetchJobs(Request $request){
        $count = 0;
        try{
            $rssUrl = 'https://news.google.com/rss/search?q=Tripura+government+job+OR+Tripura+recruitment+OR+TPSC+when:7d&hl=en-IN&gl=IN&ceid=IN:en';
            $response = Http::timeout(15)->get($rssUrl);

            if($response->failed()){
                return back()->with('error', 'Failed to connect to Google RSS. Please try again.');
            }

            $xml = simplexml_load_string($response->body());

            foreach($xml->channel->item as $item){
                $rawTitle = trim((string)$item->title);
                $title = str_replace([' - Investment Guru India',' - Northeast Today',' - TRIPURAINFO',' - Tripuratimes',' - India Today NE',' - The Indian Express',' - EastMojo',' - MyGov Tripura'], '', $rawTitle);

                $link = (string)$item->link;
                $date = Carbon::parse((string)$item->pubDate);

                // ===== SMART OFFICIAL LINK FIX =====
                $officialLink = $link;
                if(Str::contains(strtolower($title), ['gds','post office','india post'])){
                    $officialLink = 'https://indiapostgdsonline.cept.gov.in';
                } elseif(Str::contains(strtolower($title), ['gramin bank','tripura gramin'])){
                    $officialLink = 'https://www.tripuragraminbank.co.in';
                } elseif(Str::contains(strtolower($title), ['railway','rrb','ntpc','group d'])){
                    $officialLink = 'https://www.rrbguwahati.gov.in';
                } elseif(Str::contains(strtolower($title), ['tpsc','tripura public'])){
                    $officialLink = 'https://tpsc.tripura.gov.in';
                } elseif(Str::contains(strtolower($title), ['police','constable'])){
                    $officialLink = 'https://tripurapolice.gov.in';
                }

                if(!Job::where('title', $title)->exists() && strlen($title) > 15){
                    $job = Job::create([
                        'title' => $title,
                        'department' => 'Tripura Govt (Auto-Fetched)',
                        'location' => 'Tripura',
                        'qualification' => 'As per Notification',
                        'last_date' => now()->addDays(30),
                        'deadline' => now()->addDays(30),
                        'apply_link' => $officialLink, // <-- AB SAHI LINK JAYEGA
                        'pdf_link' => $officialLink,
                        'description' => strip_tags((string)$item->description),
                        'is_verified' => true,
                        'created_at' => $date,
                        'updated_at' => now(),
                    ]);
                    $count++;

                    try {
                        $msg = "🔥 NEW TRIPURA JOB ALERT\n\n📌 {$job->title}\n🏢 Dept: {$job->department}\n\n👇 Full Details & Apply:\n" . url('/jobs');
                        SocialPoster::postToFacebook($msg, url('/jobs'));
                        SocialPoster::postToWhatsApp($msg);
                    } catch (\Exception $e) {
                        Log::error('Social Post Failed: '.$e->getMessage());
                    }
                }
            }
        }catch(\Exception $e){
            return back()->with('error', 'Fetch Error: '.$e->getMessage());
        }
        return back()->with('success', $count.' New Jobs Fetched & Auto-Posted to Facebook/WhatsApp!');
    }

    public function fetchScholarships(Request $request){
        $count = 0;
        try{
            $rssUrl = 'https://news.google.com/rss/search?q=Tripura+scholarship+OR+Northeast+scholarship+when:7d&hl=en-IN&gl=IN&ceid=IN:en';
            $xml = simplexml_load_string(Http::timeout(15)->get($rssUrl)->body());
            foreach($xml->channel->item as $item){
                $title = trim((string)$item->title);
                $link = (string)$item->link;
                if(!Scholarship::where('title', $title)->exists()){
                    $scholarship = Scholarship::create([
                        'title' => $title,
                        'amount' => 'As per Scheme',
                        'eligibility' => 'Tripura Student',
                        'last_date' => now()->addDays(30),
                        'apply_link' => $link,
                        'description' => strip_tags((string)$item->description),
                    ]);
                    $count++;

                    try {
                        $msg = "🎓 NEW SCHOLARSHIP ALERT\n\n📌 {$scholarship->title}\n\n👇 Apply Now:\n" . url('/scholarships');
                        SocialPoster::postToFacebook($msg, url('/scholarships'));
                        SocialPoster::postToWhatsApp($msg);
                    } catch (\Exception $e) {
                        Log::error('Social Post Failed: '.$e->getMessage());
                    }
                }
            }
        }catch(\Exception $e){
            return back()->with('error', 'Scholarship Fetch Error: '.$e->getMessage());
        }
        return back()->with('success', $count.' Scholarships Fetched & Auto-Posted!');
    }

    public function fetchAdmitCardsAuto(){
        $count = 0;
        try{
            $rssUrl = 'https://news.google.com/rss/search?q=Tripura+admit+card+OR+TPSC+admit+card+OR+Tripura+police+admit+when:7d&hl=en-IN&gl=IN&ceid=IN:en';
            $xml = simplexml_load_string(Http::timeout(15)->get($rssUrl)->body());
            
            foreach($xml->channel->item as $item){
                $title = trim((string)$item->title);
                $link = (string)$item->link;
                
                $allJobs = Job::latest()->take(100)->get();
                foreach($allJobs as $job){
                    $jobKeywords = explode(' ', $job->title);
                    $matched = false;
                    foreach($jobKeywords as $word){
                        if(strlen($word) > 4 && Str::contains(strtolower($title), strtolower($word))){
                            $matched = true;
                            break;
                        }
                    }
                    
                    if($matched && empty($job->admit_card_link)){
                        $job->update([
                            'admit_card_link' => $link,
                            'admit_card_date' => now(),
                        ]);
                        $count++;
                        break;
                    }
                }
            }
        }catch(\Exception $e){
            Log::error('Admit Auto Error: '.$e->getMessage());
        }
        return back()->with('success', $count.' Admit Cards Auto-Linked!');
    }

    public function fetchResultsAuto(){
        $count = 0;
        try{
            $rssUrl = 'https://news.google.com/rss/search?q=Tripura+result+OR+TPSC+result+OR+Tripura+govt+result+when:7d&hl=en-IN&gl=IN&ceid=IN:en';
            $xml = simplexml_load_string(Http::timeout(15)->get($rssUrl)->body());
            foreach($xml->channel->item as $item){
                $title = trim((string)$item->title);
                $link = (string)$item->link;
                
                $allJobs = Job::latest()->take(100)->get();
                foreach($allJobs as $job){
                    if(strlen($job->title) > 10 && Str::contains(strtolower($title), strtolower(Str::words($job->title, 2, ''))) && empty($job->result_link)){
                        $job->update(['result_link' => $link, 'result_date' => now()]);
                        $count++;
                        break;
                    }
                }
            }
        }catch(\Exception $e){
            Log::error('Result Auto Error: '.$e->getMessage());
        }
        return back()->with('success', $count.' Results Auto-Linked!');
    }
}