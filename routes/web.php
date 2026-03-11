<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
=======
>>>>>>> 0b12bf4 (Initial commit)

Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
// simple login page for Computer Laboratory Management System
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
=======
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
>>>>>>> 0b12bf4 (Initial commit)
});
