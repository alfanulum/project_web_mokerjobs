<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JobController;

Route::get('/', [JobController::class, 'overview'])->name('overview');

Route::get('/find_job', [JobController::class, 'findJob'])->name('find_job');

Route::get('post_job', function () {
    return view('post_job');
})->name('post_job');

Route::get('sign_in', function () {
    return view('sign_in');
})->name('sign_in');

Route::get('sign_up', function () {
    return view('sign_up');
})->name('sign_up');

Route::get('admin', function () {
    return view('admin');
})->name('admin');

use App\Http\Controllers\FeedbackController;

Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.submit');
