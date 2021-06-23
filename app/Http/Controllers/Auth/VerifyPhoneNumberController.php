<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\Verified;
use App\VerificationServiceProviders\SpaVerification;
use App\VerificationServiceProviders\TwilioVerification;
use App\VerificationServiceProviders\VonageVerification;


class VerifyPhoneNumberController extends Controller
{
    /**
     * Initiate authenticated user's phone number verification.
     *
     * 
     */
    public function createPhoneVerification(Request $request)
    {
        // Get user phone number to be verified.
        $request['mobile_phone_number'] = $request->user()->getPhoneNumberForVerification();
        
        // Check if call to @createPhoneVerification is a new request.
        // Create a verification code if one doesn't exist
        
        if ($request->user()->getVerificationCode() === null) {

            $request->user()->createPhoneNumberVerificationCode();

            $createphoneverification = new SpaVerification;
            $createphoneverification->sendPhoneVerificationCode($request);
             
            return Inertia::render('Auth/VerifyPhoneNumber', ['phone' => $request['mobile_phone_number'], 'id' => $request['request_Id']]);    
        }

        // Check if call to @createPhoneVerification is a new request.
        // Create a request only if it is. 

        // if ($request->header('referer') !== 'http://127.0.0.1:8000/verify-phone-number') {
        
        //     $createphoneverification = new TwilioVerification;
        //     $createphoneverification->sendPhoneVerificationCode($request);
            
        //     return Inertia::render('Auth/VerifyPhoneNumber', ['phone' => $request['mobile_phone_number'], 'id' => $request['request_Id']]);

        // }

        // Check if call to @createPhoneVerification is a new request.
        // Create a request only if it is. 

        // if ($request->header('referer') !== 'http://127.0.0.1:8000/verify-phone-number') {
        
        //     $createphoneverification = new VonageVerification;
        //     $createphoneverification->sendPhoneVerificationCode($request);
        //     $request['request_Id'] = $createphoneverification->request_Id;
            
        //     return Inertia::render('Auth/VerifyPhoneNumber', ['phone' => $request['mobile_phone_number'], 'id' => $request['request_Id']]);

        // }

        else {
            return Inertia::render('Auth/VerifyPhoneNumber', ['phone' => $request['mobile_phone_number'], 'id' => $request['request_Id']]);
        }
        
    }
    
    /**
     * Mark the authenticated user's phone number as verified
     * if phone verification checks out.
     */
    public function verifyPhoneNumber(Request $request)
    {
        $request->validate([
            'verification_code' => ['required', 'numeric'],
            'mobile_phone_number' => ['required', 'string'],
            'request_Id' => ['nullable', 'alpha_num'],
        ]);

        // $verifyphonenumber = new VonageVerification;
        // $verifyphonenumber->verifyCode($request);      
        
        // $verifyphonenumber = new TwilioVerification;
        // $verifyphonenumber->verifyCode($request);

        $verifyphonenumber = new SpaVerification;
        $verifyphonenumber->verifyCode($request);

        if ($request->user()->hasVerifiedPhoneNumber()) {

            event(new Verified($request->user()));
            Session::flash('success', 'Your registration, email and phone verifications were successful!');
            return redirect('/dashboard');

        } else {

            Session::flash('error', 'Invalid input!');
            return redirect()->back()->with(['phone' => $request['mobile_phone_number'], 'id' => $request['request_Id']]); 
        }
        
    }
}