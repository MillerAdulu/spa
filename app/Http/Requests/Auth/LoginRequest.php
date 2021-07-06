<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Auth\TwoFaController;

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

    /**
     * Set login input to what user provided.
     *
     * @return string
     */
    public function username()
    {
        $login = request()->input('username');

        if(filter_var($login, FILTER_VALIDATE_EMAIL)) {

          $field = 'email';
            
        } else {

            $field = 'mobile_phone_number';
        }

        request()->merge([$field => $login]);

        return $field;
    }

    /**
     *
     * @return array
     */
    public function rules()
    {

        return [
            'email' => 'sometimes|required|email',
            'mobile_phone_number' => 'sometimes|required|string',
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

        if ( $this->username() === 'email') {

            $credentials = ['email', 'password'];

        } else {

            $credentials = ['mobile_phone_number', 'password'];
        }

        if (! Auth::attempt($this->only($credentials), $this->filled('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'username' => __('auth.failed'),
            ]);

        // check if user enabled 2fa, if yes, initiate 2fa step, else, login user normally 
        // if ($this->user()->enabledTwoFa() === true) {
        //     $initiatetwofa = new TwoFaController();
        //     $initiatetwofa->createTwoFaAuth(request());
        // }

        }

        RateLimiter::clear($this->throttleKey());

        $this->user()->userLastLogin();

        $this->user()->setIsLoggedInToTrue();
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
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'username' => trans('auth.throttle', [
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
    public function throttleKey()
    {
        return Str::lower($this->input('username')).'|'.$this->ip();
    }
}
