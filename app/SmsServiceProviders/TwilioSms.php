<?php

namespace App\SmsServiceProviders;

use Twilio\Rest\Client;
use App\Contracts\SmsService;
use Twilio\Exceptions\TwilioException;

class TwilioSms implements SmsService
{
    public function sendSms($phoneNumber, $message)
    {
        /* Get credentials from .env */

        try {//get successful outcome and log to admin

            $auth_token = getenv("TWILIO_AUTH_TOKEN");
            $account_sid = getenv("TWILIO_ACCOUNT_SID");
            $twilio_number = getenv("TWILIO_SEND_FROM");
            $messageParams = array('from' => $twilio_number, 'body' => $message);

            $client = New Client($account_sid, $auth_token);

            $result = $client->messages->create($phoneNumber, $messageParams);

            if ($result->status == 'queued') { //if this is successful, don't need to return json. login to admin and pass on, else resend
                return true;
            } else {
                return;
            }
            
        } catch (TwilioException $e) { //catch errors or failed send and log to admin
        
            echo "Error: " . $e->getMessage();
        } 

    }
}