<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('overview');
})->name('overview');

Route::get('find_job', function () {
    return view('find_job');
})->name('find_job');

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
