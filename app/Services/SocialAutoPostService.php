<?php
namespace App\Services;
use App\Models\Job;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SocialAutoPostService
{
    public static function postLatestJob()
    {
        $job = Job::where('is_posted_fb', false)->latest()->first();
        if (!$job) {
            return "Koi job nahi mila";
        }
        $message = $job->title . " - " . url("/jobs/".$job->slug);
        $pageId = config('services.facebook.page_id');
        $token = config('services.facebook.page_token');
        try {
            $response = Http::post("https://graph.facebook.com/{$pageId}/feed", [
                'message' => $message,
                'access_token' => $token,
            ]);
            $data = $response->json();
            Log::info("FB Response: ", $data);
            if (isset($data['error'])) {
                return "FB ERROR: " . $data['error']['message'];
            }
            if (isset($data['id'])) {
                $job->update(['is_posted_fb' => true]);
                return "SUCCESS: " . $data['id'];
            }
            return "Response: " . json_encode($data);
        } catch (\Exception $e) {
            return "EXCEPTION: " . $e->getMessage();
        }
    }
}