<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JobController;

Route::get('/', [JobController::class, 'overview'])->name('overview');

Route::get('/find_job', [JobController::class, 'findJob'])->name('find_job');

Route::get('/post_job', function () {
    return view('post_job_pages.post_job');
})->name('post_job');

Route::get('/postjob/step1', function () {
    return view('post_job_pages.form_postjob_1');
})->name('form_postjob_1');

Route::get('/post_job/form', function () {
    return view('post_job_pages.form_postjob_2');
})->name('form_postjob_2');

Route::get('/sign_in', function () {
    return view('auth.sign_in'); // path: resources/views/auth/login.blade.php
})->name('sign_in');

Route::get('/sign_up', function () {
    return view('auth.sign_up');
})->name('sign_up');

Route::get('admin', function () {
    return view('admin');
})->name('admin');

use App\Http\Controllers\FeedbackController;

Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.submit');
