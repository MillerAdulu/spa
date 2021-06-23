<?php

namespace App\VerificationServiceProviders;

use App\Http\Controllers\SmsController;
use Illuminate\Http\Request;
use App\Contracts\PhoneVerificationService;
use Propaganistas\LaravelPhone\PhoneNumber;


class SpaVerification implements PhoneVerificationService
{
    public function sendPhoneVerificationCode(Request $request)
    {
        //Retrieve code to send to user from db
        $code = $request->user()->getVerificationCode(); //what send is decrypted value.
        
        // Get user phone number to be verified and format it.
        $userphoneNumber = $request['mobile_phone_number'];
        $formatedphonenumber = PhoneNumber::make($userphoneNumber, 'NG')->formatE164();

        $message = 'Your verification code is:' . $code;
        $phoneNumber = $formatedphonenumber;

        $sendverificationmessage = new SmsController;
        $sendverificationmessage->createSms($phoneNumber, $message);       
    }

    public function verifyCode(Request $request)
    {
        //retrieve user's code from db and compare with what is provided.
        $verification_code = $request->user()->getVerificationCode(); //what use here is decrypted value.
        $userprovidedcode = $request['verification_code'];

        if ($userprovidedcode === $verification_code) {
            $request->user()->markPhoneAsVerified(); //return back to function that called.
        }
    }
}
