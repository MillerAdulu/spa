<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Spatie\PersonalDataExport\Jobs\CreatePersonalDataExportJob;


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

    public function dispatchPde()
    {
        dispatch(new CreatePersonalDataExportJob(auth()->user()));
        Session::flash('success', 'Your personal data has been emailed to you');
        return redirect()->back();
    }

    public function closeAccount()
    {
        return Inertia::render('CloseAccount'); 
    }
}
