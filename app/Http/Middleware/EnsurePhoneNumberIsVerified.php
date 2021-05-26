<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use App\Contracts\MustVerifyPhoneNumber;

class EnsurePhoneNumberIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $redirectToRoute
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|null
     */
    public function handle(Request $request, Closure $next, $redirectToRoute = null)
    {
        $formatedphonenumber = $request->user()->getPhoneNumberForVerification();

        if (! $request->user() ||
            ($request->user() instanceof MustVerifyPhoneNumber &&
            ! $request->user()->hasVerifiedPhoneNumber())) {
            return $request->expectsJson()
                    ? abort(403, 'Your phone number is not verified.')
                    : Redirect::guest(URL::route($redirectToRoute ?: 'phoneverification.notice'))->with('phone', $formatedphonenumber);
        }

        return $next($request);
    }
}
