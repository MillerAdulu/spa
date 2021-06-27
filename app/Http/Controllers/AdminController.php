<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function allUser() //want to pass on only specific user details not all.
    {
        $users = User::where('role', 'user')
            ->get(['id', 'first_name', 'last_name']);

        return Inertia::render('AllUsers', [
            'users' => $users
        ]);
    }

    public function impersonate($user_id)
    {
        $user = User::find($user_id);
        if ($user->canBeImpersonated()) {
            Auth::user()->impersonate($user);
            return redirect()->route('dashboard');
        }
    }

    public function impersonate_leave()
    {
        Auth::user()->leaveImpersonation();
            return redirect()->route('all-users');
    }
}
