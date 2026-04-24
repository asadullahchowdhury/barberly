<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deals extends Model
{
    public function services()
    {
        return $this->hasMany(DealServices::class, 'deal_id', 'id')->with('service_details');
    }

    public function members()
    {
        return $this->hasMany(DealMembers::class, 'deal_id', 'id')->with('member_details');
    }

    protected $appends = ['created_at_formatted', 'start_date_formatted', 'end_date_formatted'];

    public function getCreatedAtFormattedAttribute()
    {
        if (isset($this->attributes['created_at'])) {
            return date('F j, Y', strtotime($this->attributes['created_at']));
        } else {
            return null;
        }
    }

    public function getStartDateFormattedAttribute()
    {
        if (isset($this->attributes['start_date'])) {
            return date('F j, Y', strtotime($this->attributes['start_date']));
        } else {
            return null;
        }
    }

    public function getEndDateFormattedAttribute()
    {
        if (isset($this->attributes['end_date'])) {
            return date('F j, Y', strtotime($this->attributes['end_date']));
        } else {
            return null;
        }
    }

}
