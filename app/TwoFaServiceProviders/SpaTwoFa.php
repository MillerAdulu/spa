<?php

namespace App\TwoFaServiceProviders;

use App\Http\Controllers\SmsController;
use Illuminate\Http\Request;
use Propaganistas\LaravelPhone\PhoneNumber;

class SpaTwoFa
{
    public function sendTwoFaToken(Request $request)
    {
        //Retrieve token to send to user from db
        $token = $request->user()->getTwoFaToken(); //what send is decrypted value.
        
        // Get user phone number to be verified and format it.
        $userphoneNumber = $request['mobile_phone_number'];
        $formatedphonenumber = PhoneNumber::make($userphoneNumber, 'NG')->formatE164();

        $message = 'Your two-fa token is:' . $token;
        $phoneNumber = $formatedphonenumber;

        $sendtwofamessage = new SmsController;
        $sendtwofamessage->createSms($phoneNumber, $message);       
    }

    public function verifyTwoFaToken(Request $request)
    {
        //retrieve user's code from db and compare with what is provided.
        $two_fa_token = $request->user()->getTwoFaToken(); //what use here is decrypted value.
        $userprovidedtoken = $request['two_fa_token'];

        if ($userprovidedtoken === $two_fa_token) {
            $request->user()->markUserAsTwoFaAuthenticated(); //return back to function that called.
        }
    }
}

