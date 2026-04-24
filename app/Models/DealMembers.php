<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealMembers extends Model
{

    public function member_details()
    {
        return $this->hasOne(Users::class, 'id', 'member_id');
    }
}
