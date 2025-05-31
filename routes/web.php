<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JobController;

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProcessedController;

Route::get('/', [JobController::class, 'overview'])->name('overview');

Route::get('/find_job', [JobController::class, 'findJob'])->name('find_job');

// In your routes/web.php
Route::get('/jobs/{id}', [JobController::class, 'show'])->name('detail_job');

//form 1
Route::get('/post-job/step1', [JobController::class, 'formPostJobStep1'])->name('form_postjob_step1');
Route::post('/post-job/step1', [JobController::class, 'storeStep1'])->name('store_step1');
//form 2
Route::get('/post-job/step2', [JobController::class, 'formPostJobStep2'])->name('form_postjob_step2');
Route::post('/post-job/step2', [JobController::class, 'storeStep2'])->name('store_step2');
//form 3
Route::get('/post-job/step3', [JobController::class, 'formPostJobStep3'])->name('form_postjob_step3');
Route::post('/post-job/step3', [JobController::class, 'storeStep3'])->name('store_step3');
// form 4
Route::get('/post-job/step4', [JobController::class, 'formPostJobStep4'])->name('form_postjob_step4');
Route::post('/post-job/step4', [JobController::class, 'storeStep4'])->name('store_postjob_step4');
// form 5
Route::get('/post-job/step5', [JobController::class, 'formPostJobStep5'])->name('form_postjob_step5');
Route::post('/post-job/step5', [JobController::class, 'storeStep5'])->name('store_postjob_step5');
// form 6
Route::get('/post-job/step6', [JobController::class, 'formPostJobStep6'])->name('form_postjob_step6');
Route::post('/submit-job', [JobController::class, 'submitJob'])->name('submit_job');

Route::get('/job-submission-success', [JobController::class, 'jobSubmissionSuccess'])->name('job_submission_success');


Route::get('/apply/{id}', [JobController::class, 'apply'])->name('apply.job');


Route::get('/post_job', function () {
    return view('post_job_pages.post_job');
})->name('post_job');

// Route login form
Route::get('/sign_in', function () {
    return view('auth.sign_in');
})->name('sign_in');


// Route untuk handle proses login (dummy example)
Route::post('/login', function () {
    // logika login manual kamu di sini
})->name('login.attempt');

Route::get('/dashboard', function () {
    return view('dashboard');
});



// Rute Autentikasi Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    // Rute yang dilindungi (membutuhkan login admin)
    Route::middleware('auth:admin')->group(function () {
        // Ganti dengan controller dashboard admin Anda
        Route::get('dashboard', function () {
            return view('admin.dashboard'); // Contoh view dashboard
        })->name('dashboard');
        // Misalnya, route untuk halaman processed di admin
        Route::get('processed', [ProcessedController::class, 'index'])->name('processed');
    });
});


use App\Http\Controllers\FeedbackController;

Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.submit');
