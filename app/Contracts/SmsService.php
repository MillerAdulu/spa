<?php

namespace App\Contracts;

interface SmsService
{
    /**
    * Implement sending an sms via one of any provider.
    *
    * @return void
    */
    public function sendSms($phoneNumber, $message);
}