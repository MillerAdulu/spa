<?php

namespace App\Contracts;
use Illuminate\Http\Request;

interface PhoneVerificationService
{
    /**
    * Initiate the phone verification process.
    *
    * @return void
    */
    public function createPhoneVerification(Request $request);

   /**
    * Verify phone from the create phone verification step.
    *
    * @return void
    */
    public function verifyPhoneNumber(Request $request);
 
}