<?php

namespace App\VerificationServiceProviders;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;
use App\Contracts\PhoneVerificationService;
use Propaganistas\LaravelPhone\PhoneNumber;


class TwilioVerification implements PhoneVerificationService
{
    public function sendPhoneVerificationCode(Request $request)
    {
        //Format phone number that came with request and send code.
        $userphoneNumber = $request['mobile_phone_number'];
        $formatedphonenumber = PhoneNumber::make($userphoneNumber, 'NG')->formatE164();
        
        /* Get credentials from .env */
        try {

            $auth_token = getenv("TWILIO_AUTH_TOKEN");
            $account_sid = getenv("TWILIO_ACCOUNT_SID");
            $twilio_verify_sid = getenv("TWILIO_VERIFICATION_SID");

            $twilio = new Client($account_sid, $auth_token);
            $verification = $twilio->verify->v2->services($twilio_verify_sid)
                ->verifications
                ->create($formatedphonenumber, "sms");
            
            if ($verification->status == 'pending') { // Log to admin and pass on, else resend
                return true;
            }

        } catch (TwilioException $e) {//catch errors or failed send and log to admin
            echo "Error: " . $e->getMessage();
        }
    }

    public function verifyCode(Request $request)    
    {
        // Format phone number that came with request and send code.
        $userphoneNumber = $request['mobile_phone_number'];
        $userprovidedcode = $request['verification_code'];
        $formatedphonenumber = PhoneNumber::make($userphoneNumber, 'NG')->formatE164();
        
        /* Get credentials from .env */ 
        
        try {

            $auth_token = getenv("TWILIO_AUTH_TOKEN");
            $account_sid = getenv("TWILIO_ACCOUNT_SID");
            $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");

            $twilio = new Client($account_sid, $auth_token);        
            $verification_check = $twilio->verify->v2->services($twilio_verify_sid)
                ->verificationChecks
                ->create($userprovidedcode, ["to" => $formatedphonenumber]);
           
            if ($verification_check->status == 'approved') { //or if status === 'approved'
                $request->user()->markPhoneAsVerified(); // Return back to function that called. Log to admin.
            }

        } catch (TwilioException $e) {//catch errors or failed send and log to admin
            echo "Error: " . $e->getMessage();
        }
    }
}
