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
                'user' => $request->user() ? $request->user()->only('id', 'first_name', 'last_name', 'role') : null,
            ],

            'flash' => [
                'success' => $request->session()->get('success') ? $request->session()->get('success') : null,
                'error' => $request->session()->get('error') ? $request->session()->get('error') : null,
            ],

            'impersonation' => [
                'impersonated_by' => $request->session()->get('impersonated_by') ? $request->session()->get('impersonated_by') : null,
            ],

        ]);
    }
}
