<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function allUser() //want to pass on only specific user details not all.
    {
        $users = User::where('role', 'user')
            ->get(['id', 'uuid', 'first_name', 'last_name', 'profile_updated_at']);

        return Inertia::render('AllUsers', [
            'users' => $users
        ]);
    }

      /**
     * Display the specified user profile to owner.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function showUserProfile(UserProfile $userProfile, $uuid)
    {
        $userProfile = UserProfile::where('uuid', $uuid)
        ->get(['id', 'user_id', 'uuid', 'first_name', 'last_name', 'mobile_phone_number', 'address', 
        'city', 'state', 'country','signature', 'photograph', 'means_of_identification', 'public_utility_bill']);

        return Inertia::render('AdminShowProfile', [
            'userprofile' => $userProfile
        ]);
    }

    public function impersonate($user_id)
    {
        $user = User::find($user_id);
        if ($user->canBeImpersonated()) {
            Auth::user()->impersonate($user);
            return redirect()->route('dashboard');
        }
    }

    public function impersonate_leave()
    {
        Auth::user()->leaveImpersonation();
            return redirect()->route('all-users');
    }

    public function download($filename = '')
    {
        // Check if file exists in app/storage/file folder
        $file_path = storage_path() . "/app/uploads/" . $filename;
       
        if ( file_exists( $file_path ) ) {
            // Send Download
            return Response::download($file_path, $filename);
        }
         else {
                // Error
                exit( 'Requested file does not exist on our server!' );
            }
    }

    public function displayImage($filename = '')
    {
    
    $file_path = storage_path() . '/app/uploads/' . $filename;

    if (!File::exists($file_path)) {
        abort(404);
    }

    $file = File::get($file_path);

    $type = File::mimeType($file_path);

    $response = Response::make($file, 200);

    $response->header("Content-Type", $type);

    return $response;

    }
}
