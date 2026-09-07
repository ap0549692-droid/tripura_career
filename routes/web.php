<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\AdmitCardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AiController;

/*
|--------------------------------------------------------------------------
| Public Routes - Bina Login Ke Khulenge
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// --- TOOLS ROUTES ---
Route::get('/check-eligibility', function(){
    return view('tools.check-eligibility');
})->name('check.eligibility');

Route::get('/tools/age-calculator', function(){
    return view('tools.age');
})->name('tools.age');

Route::get('/prtc-check', function(){
    return redirect()->route('check.eligibility');
})->name('prtc.check');

Route::get('/age-calculator', function(){
    return redirect()->route('tools.age');
});

// --- JOBS - YE PUBLIC HAI, LOGIN NAHI MANGEGA ---
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');

// --- SCHOLARSHIPS ---
Route::get('/scholarships', [ScholarshipController::class, 'index'])->name('scholarships.index');
Route::get('/scholarships/{id}', [ScholarshipController::class, 'show'])->name('scholarships.show');

// --- ADMIT CARDS ---
Route::get('/admit-cards', [AdmitCardController::class, 'index'])->name('admitCards.index');
Route::get('/admit-cards/{id}', [AdmitCardController::class, 'show'])->name('admitCards.show');

/*
|--------------------------------------------------------------------------
| Authentication - Sirf Guest Ke Liye
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
});

Route::match(['get', 'post'], '/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD - Sirf Login Ke Baad
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    })->name('home');

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Jobs CRUD
    Route::get('/jobs', [JobController::class, 'adminIndex'])->name('jobs.index');
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{id}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{id}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{id}', [JobController::class, 'destroy'])->name('jobs.destroy');

    // Scholarships CRUD
    Route::get('/scholarships', [ScholarshipController::class, 'adminIndex'])->name('scholarships.index');
    Route::get('/scholarships/create', [ScholarshipController::class, 'create'])->name('scholarships.create');
    Route::post('/scholarships', [ScholarshipController::class, 'store'])->name('scholarships.store');
    Route::get('/scholarships/{id}/edit', [ScholarshipController::class, 'edit'])->name('scholarships.edit');
    Route::put('/scholarships/{id}', [ScholarshipController::class, 'update'])->name('scholarships.update');
    Route::delete('/scholarships/{id}', [ScholarshipController::class, 'destroy'])->name('scholarships.destroy');

    // Admit Cards CRUD
    Route::get('/admit-cards', [AdmitCardController::class, 'adminIndex'])->name('admitCards.index');
    Route::get('/admit-cards/create', [AdmitCardController::class, 'create'])->name('admitCards.create');
    Route::post('/admit-cards', [AdmitCardController::class, 'store'])->name('admitCards.store');
    Route::get('/admit-cards/{id}/edit', [AdmitCardController::class, 'edit'])->name('admitCards.edit');
    Route::put('/admit-cards/{id}', [AdmitCardController::class, 'update'])->name('admitCards.update');
    Route::delete('/admit-cards/{id}', [AdmitCardController::class, 'destroy'])->name('admitCards.destroy');

    // Auto Fetch
    Route::get('/auto-fetch-jobs', [App\Http\Controllers\JobFetchController::class, 'fetch'])->name('autofetch');
    Route::get('/auto-fetch-scholarships', [App\Http\Controllers\ScholarshipFetchController::class, 'fetch'])->name('autofetch.scholarship');
    Route::get('/auto-fetch-admitcards', [App\Http\Controllers\AdmitCardFetchController::class, 'fetch'])->name('autofetch.admitcard');

    Route::get('/ai-chat', [AiController::class, 'chat']);
});

require __DIR__.'/auth.php';