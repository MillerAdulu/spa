<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'uuid',
        'first_name',
        'last_name',
        'mobile_phone_number',
        'address',
        'city',
        'state',
        'country',
        'signature',
        'photograph',
        'means_of_identification',
        'public_utility_bill',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'signature',
        // 'photograph',
        // 'means_of_identification',
        // 'public_utility_bill',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
