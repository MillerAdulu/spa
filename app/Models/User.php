<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use App\Contracts\MustVerifyPhoneNumber;
use App\Contracts\MustAcceptTerms;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\PersonalDataExport\ExportsPersonalData;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail, MustVerifyPhoneNumber, MustAcceptTerms
{
    use HasFactory, Notifiable, Impersonate, SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'mobile_phone_number',
        'verification_code',
        'two_fa_token',
        'email',
        'password',
        'is_logged_in',
        'enabled_two_fa',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_code',
        'two_fa_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_number_verified_at' => 'datetime',
        'terms_accepted_at' => 'datetime',
        'profile_updated_at' => 'datetime',
        'last_login_at' => 'datetime',
        'user_two_fa_authenticated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function userprofile()
    {
        return $this->hasOne(UserProfile::class);
    }

    /**
     * Determine if the user has verified their phone number.
     *
     * @return bool
     */
    public function hasVerifiedPhoneNumber()
    {
        return ! is_null($this->phone_number_verified_at);
    }

    /**
     * Get the phone number that should be used for verification.
     *
     * @return string
     */
    public function getPhoneNumberForVerification()
    {
        return $this->mobile_phone_number;
    }

    /**
    * Create verification code to send to user.
    *
    * @return string
    */
    public function createPhoneNumberVerificationCode() //find a way to mask code before save to db. Hash/bcrypt
    {
        $code = random_int(100000, 999999);

        return $this->forceFill(['verification_code' => $code])->save();
    }

     /**
    * Create two-fa token to send to user.
    *
    * @return string
    */
    public function createTwoFaToken() //find a way to mask code before save to db. Hash/bcrypt
    {
        $token = random_int(100000, 999999);

        return $this->forceFill(['two_fa_token' => $token])->save();
    }

    /**
    * Get the verification that was sent to the user.
    *
    * @return string
    */
    public function getVerificationCode() //find way to decrypt db value before use/send to user
    {
        return $this->verification_code;
    }

    /**
    * Get the two-fa token that was sent to the user.
    *
    * @return string
    */
    public function getTwoFaToken() //find way to decrypt db value before use/send to user
    {
        return $this->two_fa_token;
    }

    /**
     * Mark the given user's phone number as verified.
     *
     * @return bool
     */
    public function markUserAsTwoFaAuthenticated()
    {
        return $this->forceFill([
            'user_two_fa_authenticated_at' => $this->freshTimestamp(),
        ])->save();
    }   

    /**
     * Determine if the user has verified their phone number.
     *
     * @return bool
     */
    public function hasTwoFaAuthenticated()
    {
        return ! is_null($this->user_two_fa_authenticated_at);
    }

    /**
     * Mark the given user's phone number as verified.
     *
     * @return bool
     */
    public function markPhoneAsVerified()
    {
        return $this->forceFill([
            'phone_number_verified_at' => $this->freshTimestamp(),
        ])->save();
    }   

    /**
     * Set 'terms' to true.
     *
     * @return bool
     */
    public function hasAcceptedTerms()
    {
        return ! is_null($this->terms_accepted_at);
    }

    /**
    * Mark user as having accepted terms.
    *
    * @return bool
    */
    public function markTermsAsAccepted()
    {
        return $this->forceFill([
            'terms_accepted_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Check 'profile_updated' status.
     *
     * @return bool
     */
    public function hasCompletedProfileUpdate()
    {
        return ! is_null($this->profile_updated_at);
    }

    /**
    * Mark the given user's profile as completely updated.
    *
    * @return bool
    */
    public function markProfileAsCompleted()
    {
        return $this->forceFill([
            'profile_updated_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
    * Set the given user's last login date & time.
    *
    * @return bool
    */
    public function userLastLogin()
    {
        return $this->forceFill([
            'last_login_at' => $this->freshTimestamp(),
        ])->save();
    }
   
    /**
    * Set the given user's currently logged in status to true.
    *
    * @return bool
    */
    public function setIsLoggedInToTrue()
    {
        return $this->forceFill([
            'is_logged_in' => true,
        ])->save();
    }
   
    /**
    * Set the given user's currently logged in status to false.
    *
    * @return bool
    */
    public function setIsLoggedInToFalse()
    {
        return $this->forceFill([
            'is_logged_in' => false,
        ])->save();
    }
   
    /**
    * Check if the given user is currently logged in.
    *
    * @return bool
    */
    public function isLoggedIn()
    {
        return $this->is_logged_in;
    }

     /**
    * Set the given user's two-fa status to true.
    *
    * @return bool
    */
    public function setEnabledTwoFaToTrue()
    {
        return $this->forceFill([
            'enabled_two_fa' => true,
        ])->save();
    }
   
    /**
    * Set the given user's two-fa status to false.
    *
    * @return bool
    */
    public function setEnabledTwoFaToFalse()
    {
        return $this->forceFill([
            'enabled_two_fa' => false,
        ])->save();
    }
   
    /**
    * Check if the given user has enabled two-fa.
    *
    * @return bool
    */
    public function hasEnabledTwoFa()
    {
        return ! is_null($this->enabled_two_fa);
    }

    /**
     * @return bool
     */
    public function canImpersonate()
    {
        // For example
        return $this->role == 'admin' || 'manager';
    }

    /**
     * @return bool
     */
    public function canBeImpersonated()
    {
        // For example
        return $this->role == 'user';
    }

    // // in your user model

    // public function selectPersonalData(PersonalDataSelection $personalData): void {
    // $personalData
    //     ->add('user.json', ['name' => $this->first_name, 'email' => $this->email])
    //     ->addFile(storage_path("avatars/{$this->id}.jpg"))
    //     ->addFile('other-user-data.xml', 's3');
    // }

    // // on your user

    // public function personalDataExportName(): string {
    // $userName = Str::slug($this->first_name);

    // return "personal-data-{$userName}.zip";
    // }

    /**
    * Route notifications for the Sms Notification channel.
    *
    * @param  \Illuminate\Notifications\Notification  $notification
    * @return string
    */
    public function routeNotificationForSms($notification)
    {
        return $this->mobile_phone_number;
    }

     /**
     * The channels the user receives notification broadcasts on.
     *
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        return 'users.'.$this->id;
    }

    protected  static  function  boot()
    {
    parent::boot();
    
    static::creating(function  ($model)  {
        $model->uuid = (string) Str::uuid();
    });
    }

}
