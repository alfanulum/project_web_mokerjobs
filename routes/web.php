<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JobController;

Route::get('/', [JobController::class, 'overview'])->name('overview');

Route::get('/find_job', [JobController::class, 'findJob'])->name('find_job');

Route::get('/post-job/step1', [JobController::class, 'formPostJobStep1'])->name('form_postjob_step1');
Route::post('/post-job/step1', [JobController::class, 'storeStep1'])->name('store_step1');
Route::get('/post-job/step2', [JobController::class, 'formPostJobStep2'])->name('form_postjob_step2');
Route::post('/post-job/step2', [JobController::class, 'storeStep2'])->name('store_step2');

Route::get('/apply/{id}', [JobController::class, 'apply'])->name('apply.job');


Route::get('/post_job', function () {
    return view('post_job_pages.post_job');
})->name('post_job');

Route::get('/sign_in', function () {
    return view('auth.sign_in'); // path: resources/views/auth/login.blade.php
})->name('sign_in');

Route::get('/sign_up', function () {
    return view('auth.sign_up');
})->name('sign_up');

Route::get('admin', function () {
    return view('admin');
})->name('admin');

//form3
Route::get('/post-job/step3', [JobController::class, 'formPostJobStep3'])->name('form_postjob_step3');
Route::post('/post-job/step3', [JobController::class, 'storeStep3'])->name('store_step3');

use App\Http\Controllers\FeedbackController;

Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.submit');