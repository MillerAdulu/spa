<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Twilio\Rest\Client;
use App\Contracts\SmsService;

class TwilioSmsService implements SmsService
{
    public function sendSms($phoneNumber, $message)
    {
        /* Get credentials from .env */

        try {

            $auth_token = getenv("TWILIO_AUTH_TOKEN");
            $account_sid = getenv("TWILIO_ACCOUNT_SID");
            $twilio_number = getenv("TWILIO_SEND_FROM");
            $messageParams = array('from' => $twilio_number, 'body' => $message);
            $client =New Client($account_sid, $auth_token);

            $client->messages->create($phoneNumber, $messageParams);
            
        } catch (Exception $e) {
        
            echo "Error: " . $e->getMessage();
        }

    }
}

class SmsController extends Controller
{
    public function sendSms($phoneNumber, $message) 
    {
        $smsservice = new TwilioSmsService();
        $smsservice->sendSms($phoneNumber, $message);

    }
}
