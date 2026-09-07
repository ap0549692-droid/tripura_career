<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Log;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// 1. AUTO JOBS - Har 6 ghante me
Schedule::command('jobs:fetch-all')
    ->everySixHours()
    ->timezone('Asia/Kolkata')
    ->withoutOverlapping()
    ->onSuccess(function () {
        Log::info('✅ Jobs Auto Success - '.now());
    })
    ->onFailure(function () {
        Log::error('❌ Jobs Auto Failed - '.now());
    });

// 2. AUTO SCHOLARSHIP - Har 6 ghante me
Schedule::command('scholarships:fetch')
    ->everySixHours()
    ->timezone('Asia/Kolkata')
    ->withoutOverlapping()
    ->onSuccess(function () {
        Log::info('✅ Scholarship Auto Success - '.now());
    })
    ->onFailure(function () {
        Log::error('❌ Scholarship Auto Failed - '.now());
    });