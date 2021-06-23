<?php

namespace App\Contracts;


interface MustVerifyPhoneNumber 
{
    /**
    * Determine if the user has verified their phone number.
    *
    * @return bool
    */
    public function hasVerifiedPhoneNumber();

    /**
    * Get the phone number that should be used for verification.
    *
    * @return string
    */
    public function getPhoneNumberForVerification();

    /**
    * Create verification code to send to user.
    *
    * @return string
    */
    public function createPhoneNumberVerificationCode();

    /**
    * Get the verification that was sent to the user.
    *
    * @return string
    */
    public function getVerificationCode();

    /**
    * Mark the given user's phone number as verified.
    *
    * @return bool
    */
    public function markPhoneAsVerified();
    
}

