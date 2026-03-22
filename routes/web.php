<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

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
});

Route::get('/signup', function () {
    return view('signup');
});

Route::post('/signup', function (Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'string', 'min:8'],
        'agree' => ['accepted'],
    ], [
        'name.required' => 'Fill the needed details before creating account.',
        'email.required' => 'Fill the needed details before creating account.',
        'password.required' => 'Fill the needed details before creating account.',
        'agree.accepted' => 'You must agree to the user agreement before registering.',
    ]);

    User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => $request->input('password'),
    ]);

    return redirect('/login')->with('success', 'Account created successfully. You can now log in.');
});

Route::get('/user-agreement', function () {
    return view('user-agreement');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

