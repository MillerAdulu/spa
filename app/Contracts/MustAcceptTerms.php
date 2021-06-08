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

}