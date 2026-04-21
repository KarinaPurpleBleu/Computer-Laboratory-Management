<?php

use App\Models\User;
use App\Models\AccountRequest;
use App\Models\PC;
use App\Models\AdminLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

        $user = Auth::user();

        // Redirect based on role_id
        if ($user->role_id == 0 || $user->role_id == 1) {
            return redirect('/admindashboard');
        } elseif ($user->role_id == 2) {
            return redirect('/userdashboard');
        } else {
            return redirect()->intended('/');
        }
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
});

Route::get('/signup', function () {
    return view('signup');
});

Route::post('/signup', function (Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:account_requests,email|unique:users,email'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'password_confirmation' => ['required', 'string', 'min:8'],
        'agree' => ['accepted'],
    ], [
        'name.required' => 'Fill the needed details before creating account.',
        'email.required' => 'Fill the needed details before creating account.',
        'email.unique' => 'This email has already been registered or is pending approval.',
        'password.required' => 'Fill the needed details before creating account.',
        'password.confirmed' => 'The password confirmation does not match.',
        'password_confirmation.required' => 'Please confirm your password.',
        'agree.accepted' => 'You must agree to the user agreement before registering.',
    ]);

    // Store account request for admin approval
    AccountRequest::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
    ]);

    return redirect('/login')->with('success', 'Account request submitted successfully. Please wait for admin approval.');
});

Route::get('/user-agreement', function () {
    return view('user-agreement');
});

Route::middleware('auth')->group(function () {
    Route::get('/admindashboard', function () {
        $user = Auth::user();
        if (!in_array($user->role_id, [0, 1])) {
            abort(403);
        }
        return view('admindashboard');
    })->name('admindashboard');

    Route::get('/userdashboard', function () {
        $user = Auth::user();
        if ($user->role_id != 2) {
            abort(403);
        }
        return view('userdashboard');
    })->name('userdashboard');

    Route::get('/dashboard', function () {
        $user = Auth::user();
        if (in_array($user->role_id, [0, 1])) {
            return redirect('/admindashboard');
        } elseif ($user->role_id == 2) {
            return redirect('/userdashboard');
        } else {
            abort(403);
        }
    })->name('dashboard');

    Route::post('/manage-users/update', function (Request $request) {
        $user = Auth::user();
        if ($user->role_id !== 0) {
            abort(403);
        }

        $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'role' => ['required', 'in:0,1,2'],
        ]);

        $targetUser = User::findOrFail($request->input('user_id'));
        $targetUser->role_id = $request->input('role');
        $targetUser->save();

        return redirect()->back()->with('success', 'User role updated successfully.');
    })->name('manage-users.update');

    // Remove user route
    Route::post('/manage-users/remove', function (Request $request) {
        $user = Auth::user();
        if (!in_array($user->role_id, [0, 1])) {
            abort(403);
        }

        $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        $targetUser = User::findOrFail($request->input('user_id'));

        // Log the action
        AdminLog::create([
            'admin_id' => Auth::id(),
            'action' => 'remove_user',
            'description' => 'Removed user: ' . $targetUser->name . ' (' . $targetUser->email . ')',
            'created_at' => now(),
        ]);

        $targetUser->delete();

        return redirect()->back()->with('success', 'User removed successfully.');
    })->name('manage-users.remove');

    // Account request approval
    Route::post('/account-requests/approve', function (Request $request) {
        $user = Auth::user();
        if (!in_array($user->role_id, [0, 1])) {
            abort(403);
        }

        $request->validate([
            'request_id' => ['required', 'integer', 'exists:account_requests,id'],
        ]);

        $accountRequest = AccountRequest::findOrFail($request->input('request_id'));

        // Create the user
        User::create([
            'name' => $accountRequest->name,
            'email' => $accountRequest->email,
            'password' => $accountRequest->password,
            'role_id' => 2, // Default to regular user
        ]);

        // Log the action
        AdminLog::create([
            'admin_id' => Auth::id(),
            'action' => 'approve_account_request',
            'description' => 'Approved account request: ' . $accountRequest->name . ' (' . $accountRequest->email . ')',
            'created_at' => now(),
        ]);

        // Delete the request
        $accountRequest->delete();

        return redirect()->back()->with('success', 'Account request approved.');
    })->name('account-requests.approve');

    // Account request rejection
    Route::post('/account-requests/reject', function (Request $request) {
        $user = Auth::user();
        if (!in_array($user->role_id, [0, 1])) {
            abort(403);
        }

        $request->validate([
            'request_id' => ['required', 'integer', 'exists:account_requests,id'],
        ]);

        $accountRequest = AccountRequest::findOrFail($request->input('request_id'));

        // Log the action
        AdminLog::create([
            'admin_id' => Auth::id(),
            'action' => 'reject_account_request',
            'description' => 'Rejected account request: ' . $accountRequest->name . ' (' . $accountRequest->email . ')',
            'created_at' => now(),
        ]);

        // Delete the request
        $accountRequest->delete();

        return redirect()->back()->with('success', 'Account request rejected.');
    })->name('account-requests.reject');

    // Add PC
    Route::post('/pcs/add', function (Request $request) {
        $user = Auth::user();
        if (!in_array($user->role_id, [0, 1])) {
            abort(403);
        }

        $request->validate([
            'pc_name' => ['required', 'string', 'max:50', 'unique:pcs,pc_name'],
        ]);

        PC::create([
            'pc_name' => $request->input('pc_name'),
            'status' => 'ready',
        ]);

        // Log the action
        AdminLog::create([
            'admin_id' => Auth::id(),
            'action' => 'add_pc',
            'description' => 'Added new PC: ' . $request->input('pc_name'),
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success', 'PC added successfully.');
    })->name('pcs.add');

    // Remove PC
    Route::post('/pcs/remove', function (Request $request) {
        $user = Auth::user();
        if (!in_array($user->role_id, [0, 1])) {
            abort(403);
        }

        $request->validate([
            'pc_id' => ['required', 'integer', 'exists:pcs,id'],
        ]);

        $pc = PC::findOrFail($request->input('pc_id'));

        // Log the action
        AdminLog::create([
            'admin_id' => Auth::id(),
            'action' => 'remove_pc',
            'description' => 'Removed PC: ' . $pc->pc_name,
            'created_at' => now(),
        ]);

        $pc->delete();

        return redirect()->back()->with('success', 'PC removed successfully.');
    })->name('pcs.remove');

    // Update PC status
    Route::post('/pcs/update-status', function (Request $request) {
        $user = Auth::user();
        if (!in_array($user->role_id, [0, 1])) {
            abort(403);
        }

        $request->validate([
            'pc_id' => ['required', 'integer', 'exists:pcs,id'],
            'status' => ['required', 'in:ready,occupied,maintenance'],
        ]);

        $pc = PC::findOrFail($request->input('pc_id'));
        $oldStatus = $pc->status;
        $pc->status = $request->input('status');
        $pc->save();

        // Log the action
        AdminLog::create([
            'admin_id' => Auth::id(),
            'action' => 'update_pc_status',
            'description' => 'Changed PC ' . $pc->pc_name . ' status from ' . $oldStatus . ' to ' . $pc->status,
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success', 'PC status updated successfully.');
    })->name('pcs.update-status');
});

