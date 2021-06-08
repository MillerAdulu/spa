<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    // /**
    //  * Get the login username to be used by the controller.
    //  *
    //  * @return string
    //  */
    // public function username()
    // {
    //     // $login = request()->input('username');

    //     // if(filter_var($login, FILTER_VALIDATE_EMAIL)) {

    //     //     return 'email';
            
    //     // } else {

    //     //     return 'mobile_phone_number';
    //     // }

    //     return 'email';
    //}

    /**
     *
     * @return array
     */
    public function rules()
    {

        return [
            'email' => 'required|string|email',
            //'email' || 'mobile_phone_number' => 'required|string',
            //'mobile_phone_number' => 'required|string',
            'password' => 'required|string',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->filled('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        // elseif (! Auth::attempt($this->only('mobile_phone_number', 'password'), $this->filled('remember'))) {
        //     RateLimiter::hit($this->throttleKey());

        //     throw ValidationException::withMessages([
        //         'mobile_phone_number' => __('auth.failed'),
        //     ]);
        // }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) { //and if used email, do for if use phone
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey() //account for if use phone
    {
        return Str::lower($this->input('email')).'|'.$this->ip();
    }
}
