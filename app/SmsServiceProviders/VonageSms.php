<?php

namespace App\SmsServiceProviders;

use Vonage\Client\Credentials\Basic;
use Vonage\Client;
use Vonage\SMS\Message\SMS;
use Vonage\Client\Exception\Exception;

class VonageSms 
{
    public function sendSms($phoneNumber, $message)
    {
    try { //get outcome and log to admin
        
        $account_key = getenv("VONAGE_API_KEY");
        $account_secret = getenv("VONAGE_API_SECRET");

        $basic  = new Basic($account_key, $account_secret);
        $client = new Client($basic);

        $result = $client->sms()->send(new SMS($phoneNumber,'Spa', $message));

        $response = $result->current();
      
        if ($response->getstatus() == 0) { //if this is successful log to admin and pass on, else resend
            return true;
        } else {
            return;
        }

    } catch (Exception $e) { //catch errors or failed send and log to admin
        
        echo "Error: " . $e->getMessage();
    }


    }
}