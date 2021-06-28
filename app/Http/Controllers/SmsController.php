<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\SmsServiceProviders\TwilioSms;
use App\SmsServiceProviders\VonageSms;

class SmsController extends Controller
{
    public function createSms($phoneNumber, $message) 
    {
        // $sms = new TwilioSms();
        $sms = new VonageSms();
        $sms->sendSms($phoneNumber, $message);

    }
}
