<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;

class Customers extends Authenticatable
{

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


    protected $appends = ['created_at_formatted','dob_formatted' ];

    public function getCreatedAtFormattedAttribute(){
        if(isset($this->attributes['created_at'])){
            return date('F j, Y', strtotime($this->attributes['created_at']));
        }else{
            return null;
        }
    }

    public function getDobFormattedAttribute(){
        if(isset($this->attributes['dob'])){
            return date('F j, Y', strtotime($this->attributes['dob']));
        }else{
            return null;
        }
    }

}
