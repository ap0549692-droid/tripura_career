<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\AdmitCardController;

Route::get('/', function () {
    $jobs = \App\Models\Job::latest()->take(4)->get();
    $scholarships = \App\Models\Scholarship::latest()->take(4)->get();
    $admitCards = \App\Models\AdmitCard::latest()->take(4)->get();
    return view('home', compact('jobs', 'scholarships', 'admitCards'));
})->name('home');

Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{id}', [JobController::class, 'show'])->whereNumber('id')->name('jobs.show');
Route::get('/scholarships', [ScholarshipController::class, 'index'])->name('scholarships.index');
Route::get('/scholarships/{id}', [ScholarshipController::class, 'show'])->whereNumber('id')->name('scholarships.show');
Route::get('/admit-cards', [AdmitCardController::class, 'publicIndex'])->name('admit-cards.public');
Route::view('/about', 'about')->name('about');

Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/scholarship/{id}/apply', [ApplicationController::class, 'create'])->name('application.create');
    Route::post('/scholarship/{id}/apply', [ApplicationController::class, 'store'])->name('application.store');
    Route::get('/my-applications', [ApplicationController::class, 'myApplications'])->name('my.applications');
});

// ===== ADMIN - Protected =====
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/fetch-jobs', [AdminController::class, 'fetchJobs'])->name('fetchJobs');
    Route::post('/fetch-scholarships', [AdminController::class, 'fetchScholarships'])->name('fetchScholarships');
    
    Route::get('/scholarships', [ScholarshipController::class, 'adminIndex'])->name('scholarships.index');
    Route::get('/scholarships/create', [ScholarshipController::class, 'create'])->name('scholarships.create');
    Route::post('/scholarships', [ScholarshipController::class, 'store'])->name('scholarships.store');
    Route::get('/scholarships/{id}/edit', [ScholarshipController::class, 'edit'])->name('scholarships.edit');
    Route::put('/scholarships/{id}', [ScholarshipController::class, 'update'])->name('scholarships.update');
    Route::delete('/scholarships/{id}', [ScholarshipController::class, 'destroy'])->name('scholarships.destroy');

    Route::get('/jobs', [JobController::class, 'adminIndex'])->name('jobs.index');
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{id}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{id}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{id}', [JobController::class, 'destroy'])->name('jobs.destroy');

    // ADMIT CARDS - FIXED - /admin ke andar sirf /admit-cards
    Route::get('/admit-cards', [AdmitCardController::class, 'adminIndex'])->name('admit-cards.index');
    Route::get('/admit-cards/create', [AdmitCardController::class, 'create'])->name('admit-cards.create');
    Route::post('/admit-cards', [AdmitCardController::class, 'store'])->name('admit-cards.store');
    Route::get('/admit-cards/{id}/edit', [AdmitCardController::class, 'edit'])->name('admit-cards.edit');
    Route::put('/admit-cards/{id}', [AdmitCardController::class, 'update'])->name('admit-cards.update');
    Route::delete('/admit-cards/{id}', [AdmitCardController::class, 'destroy'])->name('admit-cards.destroy');
    
    // Applications routes
    Route::get('/applications', [ApplicationController::class, 'adminIndex'])->name('applications.index');
    Route::post('/applications/{id}/status', [ApplicationController::class, 'updateStatus'])->name('applications.status');
});

require __DIR__.'/auth.php';