<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Propaganistas\LaravelPhone\PhoneNumber;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|min:2|max:255',
            'last_name' => 'required|string|min:2|max:255',
            'mobile_phone_number' => 'required|string|min:11|max:15|unique:users|phone:NG,mobile',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:12',
        ]);

        $formatedphonenumber = PhoneNumber::make($request['mobile_phone_number'], 'NG')->formatE164();

        Auth::login($user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile_phone_number' => $formatedphonenumber,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]));

        event(new Registered($user));
        return redirect('/verify-phone-number')->with(['status' => session('status'), 'phone' => $formatedphonenumber]);
        
    }
}
