<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// authentication pages
Route::get('/login', function () {
    return view('login');
});

Route::get('/signup', function () {
    return view('signup');
});

// Optional: handle form submissions (dummy closures for now)
Route::post('/login', function () {
    // authenticate user...
    return redirect('/signup');
});

Route::post('/signup', function () {
    // create user...
    return redirect('/login');
});
