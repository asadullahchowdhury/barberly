<?php

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use SoftDeletes;

    /*
     * We will use these 4 const for checking account type.
     * */
    const GOOGLE = 'google';
    const FACEBOOK = 'facebook';
    const APPLE = 'apple';
    const EMAIL = 'email';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];


    protected $appends = ['created_at_formatted' ];

    public function getCreatedAtFormattedAttribute(){
        if(isset($this->attributes['created_at'])){
            return date('F j, Y', strtotime($this->attributes['created_at']));
        }else{
            return null;
        }
    }

    public function bookings()
    {
        return $this->hasMany(Bookings::class, 'team_member_id', 'id');
    }

}
