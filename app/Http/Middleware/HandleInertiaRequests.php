<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user() ? $request->user()->only('first_name', 'last_name') : null,
            ],

            'flash' => [
                'message' => $request->session()->get('message') ? $request->session()->get('message') : null,
            ],

            // 'status' => [
            //     'mobile_phone_number' => $request->session()->get('mobile_phone_numbee') ? $request->session()->get('mobile_phone_number') : null,
            // ],

            // 'broadcast' => [
            //     'message' => $request->session()->get('message') ? $request->session()->get('message') : null,
            // ],

        ]);
    }
}
