<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['chat'];

    /**
    * A chat belong to a user
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user()
    {
    return $this->belongsTo(User::class);
    }

}
