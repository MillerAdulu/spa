<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\VerifyPhoneNumberController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\UserSettingsController;
use App\Http\Controllers\Auth\TwoFaController;
use App\Http\Controllers\UserProfileController;

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

Route::get('/two-fa/{uuid}', [UserSettingsController::class, 'twoFa'])
->middleware(['auth', 'verified', 'verifiedphonenumber', 'password.confirm'])
->name('two-fa');

Route::post('/two-fa/{uuid}', [UserSettingsController::class, 'enableDisableTwoFa'])
->middleware(['auth', 'verified', 'verifiedphonenumber'])
->name('two-fa.enable');

Route::get('/pde/{uuid}', [UserSettingsController::class, 'pde'])
->middleware(['auth', 'verified', 'verifiedphonenumber', 'password.confirm'])
->name('pde');

Route::post('/pde/{uuid}', [UserSettingsController::class, 'dispatchPde'])
->middleware(['auth', 'verified', 'verifiedphonenumber'])
->name('pde.dispatch');

Route::get('/close-account/{uuid}', [UserSettingsController::class, 'closeAccount'])
->middleware(['auth', 'verified', 'verifiedphonenumber', 'password.confirm'])
->name('close-account');

Route::post('/close-account/{uuid}', [UserSettingsController::class, 'softDeleteUser'])
->middleware(['auth', 'verified', 'verifiedphonenumber'])
->name('close-account.softdelete');

Route::get('/verify-two-fa', [TwoFaController::class, 'createTwoFaAuth'])
->middleware('auth', 'verified', 'verifiedphonenumber')
->name('two-fa.notice');

Route::post('/verify-two-fa', [TwoFaController::class, 'verifyTwoFaAuth'])
->middleware('auth', 'verified', 'verifiedphonenumber')
->name('two-fa.verify');

Route::personalDataExports('personal-data-exports');

Route::get('/profile', [UserProfileController::class, 'create'])
->middleware(['auth', 'verified', 'verifiedphonenumber'])
->name('profile.create');

Route::post('/profile', [UserProfileController::class, 'store'])
->middleware(['auth', 'verified', 'verifiedphonenumber'])
->name('profile.store');

Route::get('/profile/{uuid}/edit', [UserProfileController::class, 'edit'])
->middleware(['auth', 'verified', 'verifiedphonenumber', 'password.confirm'])
->name('profile.edit');

Route::put('/profile/{uuid}', [UserProfileController::class, 'update'])
->middleware(['auth', 'verified', 'verifiedphonenumber'])
->name('profile.update');

Route::get('/profile/{uuid}/show', [UserProfileController::class, 'show'])
->middleware(['auth', 'verified', 'verifiedphonenumber'])
->name('profile.show');

Route::get('/profile/{uuid}/adminshow', [AdminController::class, 'showUserProfile'])
->middleware(['auth', 'verified', 'verifiedphonenumber'])
->name('profile.adminshow');

Route::get('/download/{filename}', [AdminController::class, 'download'])
->middleware(['auth', 'verified', 'verifiedphonenumber'])
->name('download');

Route::get('display-image/{filename}', [AdminController::class, 'displayImage'])
->middleware(['auth', 'verified', 'verifiedphonenumber'])
->name('display-image');

require __DIR__.'/auth.php';
