<?php

use Illuminate\Support\Facades\Route;

Route::get('/master', function () {
    return view('layouts.master');
});

Route::get('/', function () {
    return view('pages.home');
    })->name('pages.home');
