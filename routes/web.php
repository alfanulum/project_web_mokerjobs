<?php

use App\Http\Controllers\Admin\ApprovedController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProcessedController;
use App\Http\Controllers\Admin\RejectedController;
use App\Http\Controllers\JobfairController;
use App\Http\Controllers\Admin\JobfairEventController;
use App\Http\Controllers\Admin\JobfairCompanyController;


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

//Rute Jobfair
Route::get('/jobfairs', [JobfairController::class, 'index'])->name('jobfair.index');
Route::get('/jobfairs/{event:slug}', [JobfairController::class, 'showEvent'])->name('jobfair.event');
Route::get('/jobfairs/{event:slug}/companies/{company:slug}', [JobfairController::class, 'showCompany'])->name('jobfair.company');
Route::get('jobfairs/{event:slug}/companies/{company:slug}/jobs/{job}', [JobfairController::class, 'show'])->name('job.show');



// Rute Autentikasi Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    // Rute yang dilindungi (membutuhkan login admin)
    Route::middleware('auth:admin')->group(function () {
        // Ganti dengan controller dashboard admin Anda
        // routes/web.php
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // Misalnya, route untuk halaman processed di admin
        Route::get('processed', [ProcessedController::class, 'index'])->name('processed');
        Route::get('approved', [ApprovedController::class, 'index'])->name('approved');
        Route::get('rejected', [RejectedController::class, 'index'])->name('rejected');
        Route::patch('lowongan/{lowongan}/update-status', [ProcessedController::class, 'updateStatus'])->name('processed.update_status');
        Route::get('lowongan/{lowongan}/detail', [ProcessedController::class, 'show'])->name('lowongan.show_detail');

        //Admin Jobfair
        Route::prefix('jobfairs')->name('jobfairs.')->group(function () {
            Route::get('/', [JobfairEventController::class, 'index'])->name('index');
            Route::get('/create', [JobfairEventController::class, 'create'])->name('create');
            Route::get('/{jobfair}/edit', [JobfairEventController::class, 'edit'])->name('edit');
            Route::post('/', [JobfairEventController::class, 'store'])->name('store');
            Route::put('/{jobfair}', [JobfairEventController::class, 'update'])->name('update');
            Route::delete('/{jobfair}', [JobfairEventController::class, 'destroy'])->name('destroy');
            Route::get('/{jobfair}/companies', [JobfairCompanyController::class, 'index'])->name('companies.index');
        });

        Route::prefix('jobfairs/{jobfair}')->group(function () {
            Route::get('/companies', [\App\Http\Controllers\Admin\JobfairCompanyController::class, 'index'])->name('jobfairs.companies.index');
            Route::get('/companies/create', [\App\Http\Controllers\Admin\JobfairCompanyController::class, 'create'])->name('jobfairs.companies.create');
            Route::post('/companies', [\App\Http\Controllers\Admin\JobfairCompanyController::class, 'store'])->name('jobfairs.companies.store');
            Route::delete('/companies/{company}', [\App\Http\Controllers\Admin\JobfairCompanyController::class, 'destroy'])->name('jobfairs.companies.destroy');
        });

        Route::prefix('companies/{company}')->group(function () {
            Route::get('/jobs', [\App\Http\Controllers\Admin\JobController::class, 'index'])->name('jobs.index');
            Route::get('/jobs/create', [\App\Http\Controllers\Admin\JobController::class, 'create'])->name('jobs.create');
            Route::post('/jobs', [\App\Http\Controllers\Admin\JobController::class, 'store'])->name('jobs.store');
        });

        Route::get('/jobs/{job}/edit', [\App\Http\Controllers\Admin\JobController::class, 'edit'])->name('jobs.edit');
        Route::put('/jobs/{job}', [\App\Http\Controllers\Admin\JobController::class, 'update'])->name('jobs.update');
        Route::delete('/jobs/{job}', [\App\Http\Controllers\Admin\JobController::class, 'destroy'])->name('jobs.destroy');
    });
});


use App\Http\Controllers\FeedbackController;

Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.submit');
