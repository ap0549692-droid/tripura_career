<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;

class SocialPoster {
    // Facebook Page pe post
    public static function postToFacebook($message, $link) {
        $pageId = env('FB_PAGE_ID');
        $token = env('FB_PAGE_ACCESS_TOKEN');
        
        return Http::post("https://graph.facebook.com/{$pageId}/feed", [
            'message' => $message . "\n\nApply Now: " . $link,
            'link' => $link,
            'access_token' => $token
        ]);
    }

    // Instagram pe post (Photo ke saath)
    public static function postToInstagram($message, $imageUrl) {
        $igUserId = env('IG_USER_ID');
        $token = env('FB_PAGE_ACCESS_TOKEN');

        // Step 1: Create container
        $container = Http::post("https://graph.facebook.com/v19.0/{$igUserId}/media", [
            'image_url' => $imageUrl,
            'caption' => $message,
            'access_token' => $token
        ])->json();

        // Step 2: Publish
        if(isset($container['id'])) {
            return Http::post("https://graph.facebook.com/v19.0/{$igUserId}/media_publish", [
                'creation_id' => $container['id'],
                'access_token' => $token
            ]);
        }
    }
    
    // WhatsApp Group/Channel pe (via WATI / Ultramsg)
    public static function postToWhatsApp($message) {
        $instanceId = env('WHATSAPP_INSTANCE_ID');
        $token = env('WHATSAPP_TOKEN');
        
        return Http::post("https://api.ultramsg.com/{$instanceId}/messages/chat", [
            'token' => $token,
            'to' => env('WHATSAPP_GROUP_ID'), // Group ID
            'body' => $message,
        ]);
    }
}