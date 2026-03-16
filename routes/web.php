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

    return redirect('/login');
})->name('logout');

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::post('/signup', function (Request $request) {
    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8'],
    ]);

    // Ensure there is a 'user' role and get its ID to assign to the new account.
    $roleId = null;

    if (Schema::hasTable('roles') && Schema::hasColumn('roles', 'role_name')) {
        try {
            $roleId = DB::table('roles')
                ->where('role_name', 'user')
                ->value('id');

            if (! $roleId) {
                $roleId = DB::table('roles')->insertGetId([
                    'role_name' => 'user',
                ]);
            }
        } catch (\Exception $e) {
            // Ignore issues creating/finding the role so registration can continue.
        }
    }

    $userData = [
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => $data['password'],
    ];

    if ($roleId) {
        $userData['role_id'] = $roleId;
    }

    User::create($userData);

    return redirect()->route('login')->with('success', 'Account created! Please log in.');
});
