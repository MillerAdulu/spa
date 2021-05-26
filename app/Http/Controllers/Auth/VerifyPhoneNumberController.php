<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\PhoneVerificationService;
use Inertia\Inertia;
use App\Http\Controllers\SmsController;

class TwilioVerificationService implements PhoneVerificationService
{
    public function createPhoneVerification(Request $request)
    {
        // Get user phone number to be verified.
        $formatedphonenumber = $request->user()->getPhoneNumberForVerification();

        /* Get credentials from .env */
        
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $account_sid = getenv("TWILIO_ACCOUNT_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFICATION_SID");
        
        $credentials = $account_sid . ":" . $auth_token;
        $encodedcredentials = base64_encode($credentials);
        $url ="https://verify.twilio.com/v2/Services/$twilio_verify_sid/Verifications";
        $postdata = array('To' => $formatedphonenumber, 'Channel' => 'sms');
        $headers = array("Authorization: Basic " . $encodedcredentials);
        $ch = curl_init();
        curl_setopt_array($ch, array(CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postdata,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers));
    
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if ($response) {

            $result = json_decode($response, true);

            return $result;        
        
        } else {

          return $err;

        }

    }

    public function verifyPhoneNumber(Request $request)
    {

        // Get user phone number to be verified.
        $formatedphonenumber = $request->user()->getPhoneNumberForVerification();

        /* Get credentials from .env */
        
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $account_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
       
        $credentials = $account_sid . ":" . $auth_token;
        $encodedcredentials = base64_encode($credentials);
        $url ="https://verify.twilio.com/v2/Services/$twilio_verify_sid/VerificationCheck";
        $postdata = array('To' => $formatedphonenumber, 'Code' => $request['verification_code']);
        $headers = array("Authorization: Basic " . $encodedcredentials);
        $ch = curl_init();
        curl_setopt_array($ch, array(CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postdata,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers));
     
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch); 
        if ($response) {

           $result = json_decode($response, true);

           return $result;

        if ($result->valid) {

            $request->user()->verifyPhoneNumber();
            $request->user()->markPhoneAsVerified();

           }
           
        } else {

            return $err;
        }
    }
}

class SmsVerificationService implements PhoneVerificationService
{
    public function createPhoneVerification(Request $request)
    {
        //Retrieve code to send to user from db
        $code = $request->user()->getVerificationCode();

        // Get user phone number to be verified.
        $formatedphonenumber = $request->user()->getPhoneNumberForVerification();

        $message = 'Your verification code is:' . $code;
        $phoneNumber = $formatedphonenumber;

        $sendverificationmessage = new SmsController;
        $sendverificationmessage->sendSms($phoneNumber, $message);
    }

    public function verifyPhoneNumber(Request $request)
    {
        //retrieve user's code from db and compare with what is provided.
        $verification_code = $request->user()->getVerificationCode();
        $userprovidedcode = $request['verification_code'];

        if ($userprovidedcode === $verification_code) {

            $request->user()->verifyPhoneNumber();
            $request->user()->markPhoneAsVerified();

        }
    }
}

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
        $formatedphonenumber = $request->user()->getPhoneNumberForVerification();

        // If using SmsVerificationService and it's a fresh request, create verification code to send to user
        // otherwise just redirect to page with message.
        if ($request->user()->getVerificationCode() === null) {

            $request->user()->createPhoneNumberVerificationCode();

            $createphoneverification = new SmsVerificationService;
            $createphoneverification->createPhoneVerification($request);
             
            return Inertia::render('Auth/VerifyPhoneNumber', ['status' => session('status'), 'phone' => $formatedphonenumber]);    
 
        }

        // If using TwilioVerificationService and its a fresh request, proceed, else redirect to page with message.
        
        // if ($request->header('referer') === 'http://127.0.0.1:8000/register') {
    
        //     $createphoneverification = new TwilioVerificationService;
        //     $createphoneverification->createPhoneVerification($request);
            
        //     return Inertia::render('Auth/VerifyPhoneNumber', ['status' => session('status'), 'phone' => $formatedphonenumber]);    

        // }
        
        else {

            return Inertia::render('Auth/VerifyPhoneNumber', ['status' => session('status'), 'phone' => $formatedphonenumber]);    

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
        ]);

        $formatedphonenumber = $request['mobile_phone_number'];
        //$verifyphonenumber = new TwilioVerificationService;
        $verifyphonenumber = new SmsVerificationService;
        $verifyphonenumber->verifyPhoneNumber($request);

        if ($request->user()->hasVerifiedPhoneNumber()) {

            return redirect('/dashboard');

        } else {

            //return redirect()->back()->flash('error', 'Invalid input');
            return redirect()->back()->with(['status' => session('status'),'phone' => $formatedphonenumber, 'error' => 'Invalid input']);
        }
        
    }
}