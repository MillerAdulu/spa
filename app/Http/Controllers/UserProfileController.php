<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new user profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return Inertia::render('CreateProfile');
    }

    /**
     * Store a newly created user profile in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'uuid' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_phone_number' => 'required',
            'address' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|min:5|max:255',
            'city' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:55',
            'state' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:55',
            'country' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:155',
            'signature' => 'required|mimes:jpg,jpeg,bmp,png,pdf|max:512',
            'photograph' => 'required|mimes:jpg,jpeg,bmp,png,pdf|max:512',
            'means_of_identification' => 'required|mimes:jpg,jpeg,bmp,png,pdf|max:512',
            'public_utility_bill' => 'required|mimes:jpg,jpeg,bmp,png,pdf|max:512',
            
        ]);
        
        $files = [];

        foreach ($request->file() as $key => $val) {
            $fileName = time().'.'.$val->getClientOriginalName();
            $val->storeAs('/uploads/', $fileName);
            $request[$key]=$fileName;
            array_push($files, $fileName);

        }

        $userProfile = [
            'user_id' => $request->user_id,
            'uuid' => $request->uuid,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile_phone_number' => $request->mobile_phone_number,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'signature' => $files[0],
            'photograph' => $files[1],
            'means_of_identification' => $files[2],
            'public_utility_bill' => $files[3]
        ];

        UserProfile::create($userProfile);
      
        $request->user()->markProfileAsCompleted();
        
        Session::flash('success', 'Your profile was successfully created!');
        return redirect('/dashboard');
    }

    /**
     * Display the specified user profile to owner.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $userProfile)
    {
        $userProfile = UserProfile::where('user_id', Auth::id())
        ->get(['id', 'user_id', 'uuid', 'first_name', 'last_name', 'mobile_phone_number', 'address', 
        'city', 'state', 'country', 'signature', 'photograph', 'means_of_identification', 'public_utility_bill']);

        return Inertia::render('ShowProfile', [
            'userprofile' => $userProfile
        ]);
    }

    /**
     * Show the form for editing the specified user profilee.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfile $userProfile, $uuid)
    {
        $userProfile = UserProfile::where('uuid', $uuid)
        ->get(['id', 'user_id', 'uuid', 'first_name', 'last_name', 'mobile_phone_number', 'address', 
        'city', 'state', 'country', 'signature', 'photograph', 'means_of_identification', 'public_utility_bill']);

        return Inertia::render('EditProfile', [
            'userprofile' => $userProfile
        ]);
    }

    /**
     * Update the specified user profile in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserProfile  $userProfile
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, UserProfile $userProfile)
    {
        $request->validate([
            'user_id' => 'required',
            'uuid' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_phone_number' => 'required',
            'address' => 'regex:/(^[-0-9A-Za-z.,\/ ]+$)/|min:5|max:255',
            'city' => 'regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:55',
            'state' => 'regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:55',
            'country' => 'regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:155',
            'signature' => 'mimes:jpg,jpeg,bmp,png,pdf|max:512|nullable',
            'photograph' => 'mimes:jpg,jpeg,bmp,png,pdf|max:512|nullable',
            'means_of_identification' => 'mimes:jpg,jpeg,bmp,png,pdf|max:512|nullable',
            'public_utility_bill' => 'mimes:jpg,jpeg,bmp,png,pdf|max:512|nullable',
            
        ]);
    
        $userProfile = [
            'user_id' => $request->user_id,
            'uuid' => $request->uuid,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile_phone_number' => $request->mobile_phone_number,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
        ];

        UserProfile::where('user_id', Auth::id())->update($userProfile);

        $files = UserProfile::where('user_id', Auth::id())->get(['signature', 'photograph', 
        'means_of_identification', 'public_utility_bill']);

        // $newfiles = [];
        
        if ($request->signature || $request->photograph || $request->means_of_identification || 
        $request->public_utility_bill) {

            // for each file that changes, delete path to old one
            foreach ($request->file() as $val) {
                foreach ($files as $value) {
                    if ($value->signature) {
                        $file_path = storage_path() . "/app/uploads/" . $value->signature; //find way to variablerise original filename
                        File::delete($file_path);
                        $fileName = time().'.'.$val->getClientOriginalName();
                        $val->storeAs('/uploads/', $fileName);
                        UserProfile::where('user_id', Auth::id())->update(['signature' => $fileName]);
                    }
                 
                    elseif ($value->photograph) {
                        $file_path = storage_path() . "/app/uploads/" . $value->photograph; //find way to variablerise original filename
                        File::delete($file_path);
                        $fileName = time().'.'.$val->getClientOriginalName();
                        $val->storeAs('/uploads/', $fileName);
                        UserProfile::where('user_id', Auth::id())->update(['photograph' => $fileName]);
                    }

                    elseif ($value->means_of_identification) {
                        $file_path = storage_path() . "/app/uploads/" . $value->means_of_identification; //find way to variablerise original filename
                        File::delete($file_path);
                        $fileName = time().'.'.$val->getClientOriginalName();
                        $val->storeAs('/uploads/', $fileName);
                        UserProfile::where('user_id', Auth::id())->update(['means_of_identification' => $fileName]);
                    }

                    elseif ($value->public_utility_bill) {
                        $file_path = storage_path() . "/app/uploads/" . $value->public_utility_bill; //find way to variablerise original filename
                        File::delete($file_path);
                        $fileName = time().'.'.$val->getClientOriginalName();
                        $val->storeAs('/uploads/', $fileName);
                        UserProfile::where('user_id', Auth::id())->update(['public_utility_bill' => $fileName]);
                    }
                }  
            }
        }

        Session::flash('success', 'Your profile was successfully updated!');
        return redirect('/dashboard');
    }

    /**
     * Remove the specified user profile from storage.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }
}
