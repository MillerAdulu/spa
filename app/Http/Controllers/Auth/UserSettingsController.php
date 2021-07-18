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

    public function enableDisableTwoFa($user_id) //if not enabled, do so, and if enabled, disable
    {        
        $user = User::find($user_id);
        if ($user->hasEnabledTwoFa()) {
            $this->user()->setEnabledTwoFaToTrue();
            Session::flash('success', 'Two Factor Authentication successfully enabled');
            return redirect()->back();
        } 
        
        elseif ($user->hasEnabledTwoFa()) {
            $this->user()->setEnabledTwoFaToFalse();
            Session::flash('success', 'Two Factor Authentication successfully disabled');
            return redirect()->back();
        }
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

    public function softDeleteUser($user_id) //notify admin with copy of dispatch, cascade and softdelete related data
    {   
        dispatch(new CreatePersonalDataExportJob(auth()->user()));
        User::find($user_id)->delete();
        Session::flash('success', 'Your account was successfully deleted');
        return redirect()->back(); 
    }
}
