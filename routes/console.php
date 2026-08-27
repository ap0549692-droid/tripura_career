<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Log;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// ===== AUTO UPDATE JOBS - Har 6 Ghante Me =====
Schedule::call(function () {
    try {
        $controller = new \App\Http\Controllers\AdminController();
        $request = new \Illuminate\Http\Request();
        app()->call([$controller, 'fetchJobs'], ['request' => $request]);
        Log::info('Auto Jobs Fetch Success - ' . now());
    } catch (\Exception $e) {
        Log::error('Auto Jobs Fetch Failed: ' . $e->getMessage());
    }
})->everySixHours()->timezone('Asia/Kolkata');

// ===== AUTO UPDATE SCHOLARSHIPS - Har 6 Ghante Me =====
Schedule::call(function () {
    try {
        $controller = new \App\Http\Controllers\AdminController();
        $request = new \Illuminate\Http\Request();
        app()->call([$controller, 'fetchScholarships'], ['request' => $request]);
        Log::info('Auto Scholarships Fetch Success - ' . now());
    } catch (\Exception $e) {
        Log::error('Auto Scholarships Fetch Failed: ' . $e->getMessage());
    }
})->everySixHours()->timezone('Asia/Kolkata');

// ===== AUTO-LINK ADMIT CARDS - Har 6 Ghante Me =====
Schedule::call(function () {
    try {
        $controller = new \App\Http\Controllers\AdminController();
        app()->call([$controller, 'fetchAdmitCardsAuto']);
        Log::info('Auto Admit Link Success - ' . now());
    } catch (\Exception $e) {
        Log::error('Auto Admit Link Failed: ' . $e->getMessage());
    }
})->everySixHours()->timezone('Asia/Kolkata');

// ===== AUTO-LINK RESULTS - Har 6 Ghante Me =====
Schedule::call(function () {
    try {
        $controller = new \App\Http\Controllers\AdminController();
        app()->call([$controller, 'fetchResultsAuto']);
        Log::info('Auto Result Link Success - ' . now());
    } catch (\Exception $e) {
        Log::error('Auto Result Link Failed: ' . $e->getMessage());
    }
})->everySixHours()->timezone('Asia/Kolkata');

// ===== NEW AUTO FETCH - DIRECT OFFICIAL WEBSITE LINK =====
Schedule::command('jobs:fetch-latest')->everySixHours()->timezone('Asia/Kolkata');