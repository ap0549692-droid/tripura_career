<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\AdmitCardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AIController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

Route::post('/api/ai-chat', [AIController::class, 'chat']);

// Public Routes
Route::get('/login', [AuthController::class,'showLogin'])->name('login');
Route::get('/register', [AuthController::class,'showRegister']);
Route::get('/verify-otp', [AuthController::class,'showOtp']);
Route::post('/register', [AuthController::class,'register']);
Route::post('/verify-otp', [AuthController::class,'verifyOtp']);
Route::post('/login', [AuthController::class,'login']);
Route::get('/logout', [AuthController::class,'logout']);

Route::get('/', function () {
    if (!\Illuminate\Support\Facades\Cache::has('last_job_fetch')) {
        try { \Illuminate\Support\Facades\Artisan::call('jobs:fetch-latest'); \Illuminate\Support\Facades\Cache::put('last_job_fetch', now(), now()->addHours(6)); } catch (\Exception $e) {}
    }
    $jobs = \App\Models\Job::latest()->take(6)->get();
    $scholarships = \App\Models\Scholarship::latest()->take(6)->get();
    $results = collect([]); $admitCards = collect([]);
    try { $results = \App\Models\ExamResult::latest()->take(3)->get(); } catch (\Throwable $e) {}
    try { $admitCards = \App\Models\AdmitCard::latest()->take(3)->get(); } catch (\Throwable $e) {}
    return view('home', compact('jobs','scholarships','results','admitCards'));
});

// JOBS - PUBLIC
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{id}', [JobController::class, 'show'])->whereNumber('id')->name('jobs.show');

// SCHOLARSHIPS - PUBLIC
Route::get('/scholarships', [ScholarshipController::class, 'index'])->name('scholarships.index');
Route::get('/scholarships/{id}', [ScholarshipController::class, 'show'])->whereNumber('id')->name('scholarships.show');

Route::get('/admit-cards', [AdmitCardController::class, 'publicIndex'])->name('admit-cards.public');
Route::view('/about', 'about')->name('about');

Route::get('/check-eligibility', function () {
    $jobs = \App\Models\Job::latest()->get();
    return view('eligibility', compact('jobs'));
})->name('eligibility');

Route::get('/sitemap.xml', function(){
    $jobs = \App\Models\Job::latest()->get();
    $scholarships = \App\Models\Scholarship::latest()->get();
    return response()->view('sitemap', compact('jobs','scholarships'))->header('Content-Type','text/xml');
});

Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');

// MANUAL TRIGGER - Tu kabhi bhi is link se update kar sakta hai
Route::get('/run-auto-jobs', function() {
    Artisan::call('jobs:fetch-latest');
    return 'Jobs Auto Updated Successfully! Time: '.now();
});

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    Route::get('/scholarship/{id}/apply', [ApplicationController::class, 'create'])->name('application.create');
    Route::post('/scholarship/{id}/apply', [ApplicationController::class, 'store'])->name('application.store');
    Route::get('/my-applications', [ApplicationController::class, 'myApplications'])->name('my.applications');
});

// Admin Protected
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/fetch-jobs', [AdminController::class, 'fetchJobs'])->name('fetchJobs');
    Route::post('/fetch-scholarships', [AdminController::class, 'fetchScholarships'])->name('fetchScholarships');
    Route::post('/fetch-admit-cards', [AdminController::class, 'fetchAdmitCardsAuto'])->name('fetchAdmitCards');
    Route::post('/fetch-results', [AdminController::class, 'fetchResultsAuto'])->name('fetchResults');
    
    Route::get('/scholarships', [ScholarshipController::class, 'adminIndex'])->name('scholarships.index');
    Route::get('/scholarships/create', [ScholarshipController::class, 'create'])->name('scholarships.create');
    Route::post('/scholarships', [ScholarshipController::class, 'store'])->name('scholarships.store');
    Route::get('/scholarships/{id}/edit', [ScholarshipController::class, 'edit'])->name('scholarships.edit');
    Route::put('/scholarships/{id}', [ScholarshipController::class, 'update'])->name('scholarships.update');
    Route::delete('/scholarships/{id}', [ScholarshipController::class, 'destroy'])->name('scholarships.destroy');
    Route::post('/scholarships/bulk-delete', [ScholarshipController::class, 'bulkDelete'])->name('scholarships.bulkDelete');

    Route::get('/jobs', [JobController::class, 'adminIndex'])->name('jobs.index');
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{id}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{id}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{id}', [JobController::class, 'destroy'])->name('jobs.destroy');
    Route::post('/jobs/bulk-delete', [JobController::class, 'bulkDelete'])->name('jobs.bulkDelete');

    Route::get('/admit-cards', [AdmitCardController::class, 'adminIndex'])->name('admit-cards.index');
    Route::get('/admit-cards/create', [AdmitCardController::class, 'create'])->name('admit-cards.create');
    Route::post('/admit-cards', [AdmitCardController::class, 'store'])->name('admit-cards.store');
    Route::get('/admit-cards/{id}/edit', [AdmitCardController::class, 'edit'])->name('admit-cards.edit');
    Route::put('/admit-cards/{id}', [AdmitCardController::class, 'update'])->name('admit-cards.update');
    Route::delete('/admit-cards/{id}', [AdmitCardController::class, 'destroy'])->name('admit-cards.destroy');

    Route::get('/applications', [ApplicationController::class, 'adminIndex'])->name('applications.index');
    Route::post('/applications/{id}/status', [ApplicationController::class, 'updateStatus'])->name('applications.status');
});

Route::get('/prtc-check', function(){ return view('prtc-checker'); });

require __DIR__.'/auth.php';
