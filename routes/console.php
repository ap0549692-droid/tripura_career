<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Log;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// ===== AUTO UPDATE JOBS - Roj Subah 8 Baje =====
Schedule::call(function () {
    try {
        $controller = new \App\Http\Controllers\AdminController();
        // Tera wahi fetchJobs function call hoga jo admin button pe hai
        $request = new \Illuminate\Http\Request();
        app()->call([$controller, 'fetchJobs'], ['request' => $request]);
        Log::info('Auto Jobs Fetch Success - ' . now());
    } catch (\Exception $e) {
        Log::error('Auto Jobs Fetch Failed: ' . $e->getMessage());
    }
})->dailyAt('08:00')->timezone('Asia/Kolkata');

// ===== AUTO UPDATE SCHOLARSHIPS - Roj Subah 8:05 Baje =====
Schedule::call(function () {
    try {
        $controller = new \App\Http\Controllers\AdminController();
        $request = new \Illuminate\Http\Request();
        app()->call([$controller, 'fetchScholarships'], ['request' => $request]);
        Log::info('Auto Scholarships Fetch Success - ' . now());
    } catch (\Exception $e) {
        Log::error('Auto Scholarships Fetch Failed: ' . $e->getMessage());
    }
})->dailyAt('08:05')->timezone('Asia/Kolkata');