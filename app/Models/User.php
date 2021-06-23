<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use App\Contracts\MustVerifyPhoneNumber;
use App\Contracts\MustAcceptTerms;
use App\Contracts\MustHaveSubscription;
use Lab404\Impersonate\Models\Impersonate;

class User extends Authenticatable implements MustVerifyEmail, MustVerifyPhoneNumber, MustAcceptTerms, MustHaveSubscription
{
    use HasFactory, Notifiable;
    
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
        'email',
        'password',
        'has_active_subscription',
        'has_active_savings_plan',
        'is_logged_in',
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
        'initial_subscription_paid_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

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
    * Get the verification that was sent to the user.
    *
    * @return string
    */
    public function getVerificationCode() //find way to decrypt db value before use/send to user
    {
        return $this->verification_code;
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
     * Set 'profile_updated' to true.
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
    * Record user sign up.
    *
    * @return bool
    */
    public function hasPaidInitialSubscription()
    {
        return ! is_null($this->initial_subscription_paid_at);
    }

    /**
    * Record user as having signed up.
    *
    * @return bool
    */
    public function markInitialSubscriptionAsPaid()
    {
        return $this->forceFill([
            'initial_subscription_paid_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
    * Set the given user's subscription status to true.
    *
    * @return bool
    */
    public function setHasActiveSubscriptionToTrue()
    {
        return $this->forceFill([
            'has_active_subscription' => true,
        ])->save();
    }

    /**
    * Set the given user's subscription status to false.
    *
    * @return bool
    */
    public function setHasActiveSubscriptionToFalse()
    {
        return $this->forceFill([
            'has_active_subscription' => false,
        ])->save();

    }

    /**
    * Check if user has a currently active subscription.
    *
    * @return bool
    */
    public function hasActiveSubscription()
    {
        return $this->has_active_subscription;
    }

    /**
    * Set the given user's savings plan status to true.
    *
    * @return bool
    */
    public function setHasActiveSavingsPlanToTrue()
    {
        return $this->forceFill([
            'has_active_savings_plan' => true,
        ])->save();

    }

    /**
    * Set the given user's savings plan status to false.
    *
    * @return bool
    */
    public function setHasActiveSavingsPlanToFalse()
    {
        return $this->forceFill([
            'has_active_savings_plan' => false,
        ])->save();
    }
    /**
    * Check if user has a currently active plan savings plan.
    *
    * @return bool
    */
    public function hasActiveSavingsPlan()
    {
        return $this->has_active_savings_plan;
    }

     /**
    * Check if given user is active.
    *
    * @return bool
    */
    public function isActiveUser() //test if both are correct
    {
        return ! empty($this->has_active_subscription && $this->has_active_savings_plan);
        // return ! is_null($this->has_active_subscription && $this->has_active_savings_plan);
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
