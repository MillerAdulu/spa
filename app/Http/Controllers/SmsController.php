<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\SmsServiceProviders\TwilioSms;
use App\SmsServiceProviders\VonageSms;

class SmsController extends Controller
{
    public function createSms($phoneNumber, $message) 
    {
        // $smsservice = new TwilioSms();
        $smsservice = new VonageSms();
        $smsservice->sendSms($phoneNumber, $message);

    }
}
