<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified', 'verifiedphonenumber'])->name('dashboard');

Route::get('/verify-phone-number', 'App\Http\Controllers\Auth\VerifyPhoneNumberController@createPhoneVerification')->middleware('auth')
->name('phoneverification.notice');

Route::post('/verify-phone-number', 'App\Http\Controllers\Auth\VerifyPhoneNumberController@verifyPhoneNumber')->middleware('auth')
->name('phoneverification.verify');

Route::get('pusher/auth', 'PusherController@pusherAuth');

require __DIR__.'/auth.php';
