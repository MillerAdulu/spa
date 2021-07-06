<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\TwoFaServiceProviders\SpaTwoFa;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;
use App\Providers\RouteServiceProvider;

class TwoFaController extends Controller
{
      /**
     * Initiate Two-fa authentication.
     *
     * 
     */
    public function createTwoFaAuth(Request $request)
    {
        // Get user phone number to be verified.
        $request['mobile_phone_number'] = $request->user()->getPhoneNumberForVerification();
    
        $request->user()->createTwoFaToken();

        $sendtwofatoken = new SpaTwoFa;
        $sendtwofatoken->sendTwoFaToken($request);
             
        return Inertia::render('Auth/VerifyTwoFa', ['phone' => $request['mobile_phone_number']]);
    }

    public function verifyTwoFaAuth(Request $request)
    {
        $request->validate([
            'two_fa_token' => ['required', 'numeric'],
            'mobile_phone_number' => ['required', 'string'],
        ]);

        $verifytoken = new SpaTwoFa;
        $verifytoken->verifyTwoFaToken($request);

        if ($request->user()->hasTwoFaAuthenticated()) {

            return redirect()->intended(RouteServiceProvider::HOME);
            // return redirect('/dashboard'); //return back to login request

        } else {
            Session::flash('error', 'Invalid token!');
            return redirect()->back()->with(['phone' => $request['mobile_phone_number']]); 
        }
        
    }
}
