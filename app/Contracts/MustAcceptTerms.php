<?php

namespace App\Contracts;

interface MustAcceptTerms
{
    /**
    * Record user acceptance of terms.
    *
    * @return bool
    */
    public function hasAcceptedTerms();

    /**
    * Mark user as having accepted terms.
    *
    * @return bool
    */
    public function markTermsAsAccepted();
   
     /**
    * Record user completion of profile update.
    *
    * @return bool
    */
    public function hasCompletedProfileUpdate();

    /**
    * Mark the given user's profile as completely updated.
    *
    * @return bool
    */
    public function markProfileAsCompleted();

    /**
    * Set the given user's last log in date & time.
    *
    * @return bool
    */
    public function userLastLogin();

    /**
    * Set the given user's current logged in status to true.
    *
    * @return bool
    */
    public function setIsLoggedInToTrue();

    /**
    * Set the given user's currently logged in status to false.
    *
    * @return bool
    */
    public function setIsLoggedInToFalse();
   
    /**
    * Check if the given user is currently logged in.
    *
    * @return bool
    */
    public function isLoggedIn();
   
}