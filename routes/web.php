<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\VerifyPhoneNumberController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\UserSettingsController;
use App\Http\Controllers\Auth\TwoFaController;

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

Route::get('/verify-phone-number', [VerifyPhoneNumberController::class, 'createPhoneVerification'])
->middleware('auth', 'verified')
->name('phoneverification.notice');

Route::post('/verify-phone-number', [VerifyPhoneNumberController::class, 'verifyPhoneNumber'])
->middleware('auth', 'verified')
->name('phoneverification.verify');

Route::post('/pusher/auth', [PusherController::class, 'pusherAuth'])
->middleware('auth');

Route::get('/all-users', [AdminController::class, 'allUser'])
->middleware(['auth', 'verified', 'verifiedphonenumber'])
->name('all-users');

Route::get('/impersonate/{user_id}', [AdminController::class, 'impersonate'])
->middleware(['auth', 'verified', 'verifiedphonenumber'])
->name('impersonate');

Route::get('/impersonate_leave', [AdminController::class, 'impersonate_leave'])
->middleware(['auth', 'verified', 'verifiedphonenumber'])
->name('impersonate_leave');

Route::get('/settings', [UserSettingsController::class, 'index'])
->middleware(['auth', 'verified', 'verifiedphonenumber'])
->name('settings');

Route::get('/two-fa/{user_id}', [UserSettingsController::class, 'twofa'])
->middleware(['auth', 'verified', 'verifiedphonenumber', 'password.confirm'])
->name('two-fa');

Route::post('/two-fa/{user_id}', [UserSettingsController::class, 'enableTwoFa'])
->middleware(['auth', 'verified', 'verifiedphonenumber'])
->name('two-fa.enable');

Route::post('/two-fa/{user_id}', [UserSettingsController::class, 'disableTwoFa'])
->middleware(['auth', 'verified', 'verifiedphonenumber'])
->name('two-fa.disable');

Route::get('/pde/{user_id}', [UserSettingsController::class, 'pde'])
->middleware(['auth', 'verified', 'verifiedphonenumber', 'password.confirm'])
->name('pde');

Route::get('/close-account/{user_id}', [UserSettingsController::class, 'closeAccount'])
->middleware(['auth', 'verified', 'verifiedphonenumber', 'password.confirm'])
->name('close-account');

Route::get('/verify-two-fa', [TwoFaController::class, 'createTwoFaAuth'])
->middleware('auth', 'verified', 'verifiedphonenumber')
->name('two-fa.notice');

Route::post('/verify-two-fa', [TwoFaController::class, 'verifyTwoFaAuth'])
->middleware('auth', 'verified', 'verifiedphonenumber')
->name('two-fa.verify');

require __DIR__.'/auth.php';
