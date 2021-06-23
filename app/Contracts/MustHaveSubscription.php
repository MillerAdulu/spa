<?php

namespace App\Contracts;

interface MustHaveSubscription
{
    /**
    * Record user sign up.
    *
    * @return bool
    */
    public function hasPaidInitialSubscription();

    /**
    * Record user as having signed up.
    *
    * @return bool
    */
    public function markInitialSubscriptionAsPaid();

    /**
    * Set the given user's subscription status to true.
    *
    * @return bool
    */
    public function setHasActiveSubscriptionToTrue();

    /**
    * Set the given user's subscription status to false.
    *
    * @return bool
    */
    public function setHasActiveSubscriptionToFalse();

    /**
    * Check if user has a currently active subscription.
    *
    * @return bool
    */
    public function hasActiveSubscription();

    /**
    * Set the given user's savings plan status to true.
    *
    * @return bool
    */
    public function setHasActiveSavingsPlanToTrue();

    /**
    * Set the given user's savings plan status to false.
    *
    * @return bool
    */
    public function setHasActiveSavingsPlanToFalse();

    /**
    * Check if user has a currently active plan savings plan.
    *
    * @return bool
    */
    public function hasActiveSavingsPlan();



}