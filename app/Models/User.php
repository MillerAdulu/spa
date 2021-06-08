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

class User extends Authenticatable implements MustVerifyEmail, MustVerifyPhoneNumber, MustAcceptTerms
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
        'phone_number_isVerified',
        'email',
        'password',
        'terms',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_number_verified_at' => 'datetime',
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
    public function createPhoneNumberVerificationCode()
    {
        $code = random_int(100000, 999999);

        return $this->forceFill(['verification_code' => $code])->save();
    }

    /**
    * Get the verification that was sent to the user.
    *
    * @return string
    */
    public function getVerificationCode()
    {
        return $this->verification_code;
    }

    /**
     * Set 'phone_number_isVerified' to true.
     *
     * @return bool
     */
    public function verifyPhoneNumber()
    {
        return  $this->forceFill(['phone_number_isVerified' => true])->save();
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
     * Set 'phone_number_isVerified' to true.
     *
     * @return bool
     */
    public function hasAcceptedTerms()
    {
        return  $this->forceFill(['terms' => true])->save();
    }

    protected  static  function  boot()
    {
    parent::boot();
    
    static::creating(function  ($model)  {
        $model->uuid = (string) Str::uuid();
    });
    }

}
