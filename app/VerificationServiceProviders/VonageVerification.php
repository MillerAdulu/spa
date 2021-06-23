<?php

namespace App\VerificationServiceProviders;

use Illuminate\Http\Request;
use App\Contracts\PhoneVerificationService;
use Propaganistas\LaravelPhone\PhoneNumber;
use Vonage\Client\Credentials\Basic;
use Vonage\Client;
use Vonage\Client\Credentials\Container;
// use Vonage\Verify\Request;
use Vonage\Client\Exception\Exception;


class VonageVerification implements PhoneVerificationService
{
    public $request_Id;

    public function sendPhoneVerificationCode(Request $request)
    {
        //Format phone number that came with request and send code.
        $userphoneNumber = $request['mobile_phone_number'];
        $formatedphonenumber = PhoneNumber::make($userphoneNumber, 'NG')->formatE164();

        try {

            $account_key = getenv("VONAGE_API_KEY");
            $account_secret = getenv("VONAGE_API_SECRET");

            $basic  = new Basic($account_key, $account_secret);
            $client = new Client(new Container($basic));

            $request = new \Vonage\Verify\Request($formatedphonenumber, "Spa");
            $response = $client->verify()->start($request);

            $response->getResponseData();

            $request_Id = $response->getRequestId(); //pass back to calling function to pass to view for next step to use or pass directly to next step
            $this->request_Id = $request_Id;

        } catch (Exception $e) { //catch errors or failed send and log to admin
        
            echo "Error: " . $e->getMessage();
        }
    }

    public function verifyCode(Request $request)
    {
        $request_id = $request['request_Id'];
        $userprovidedcode = $request['verification_code'];

        try {

            $account_key = getenv("VONAGE_API_KEY");
            $account_secret = getenv("VONAGE_API_SECRET");

            $basic  = new Basic($account_key, $account_secret);
            $client = new Client(new Container($basic));

            $response = $client->verify()->check($request_id, $userprovidedcode);
            
            $response->getResponseData();
            
            $result = $response->getStatus();
           
            if($result->status == 0) {
                $request->user()->markPhoneAsVerified(); // Return back to function that called. Log to admin.
            }

        }catch (Exception $e) { //catch errors or failed send and log to admin
        
            echo "Error: " . $e->getMessage();
        }
    
    }
}