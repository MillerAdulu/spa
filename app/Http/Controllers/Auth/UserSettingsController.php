<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserSettingsController extends Controller
{
    public function index()
    {
        return Inertia::render('Settings'); 
    }

    public function twoFa()
    {
        return Inertia::render('TwoFa');
    }

    public function enableTwoFa($user_id)
    {        
        User::find($user_id);
        $this->user()->setEnabledTwoFaToTrue();
        Session::flash('success', 'Two Factor Authentication successfully enabled');
        return redirect()->back();
    }

    public function disableTwoFa($user_id)
    {
        User::find($user_id);
        $this->user()->setEnabledTwoFaToFalse();
        Session::flash('success', 'Two Factor Authentication successfully disabled');
        return redirect()->back();
    }

    public function pde()
    {
        return Inertia::render('Pde'); 
    }

    public function closeAccount()
    {
        return Inertia::render('CloseAccount'); 
    }
}
