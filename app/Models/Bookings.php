<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'team_member_id',
        'customer_id',
        'booking_date',
        'created_by',
        'created_by_type',
        'status',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'created_by_type',
    ];
    public function bookingItems(){
        return $this->hasMany(BookingsItems::class, 'booking_id', 'id')->orderBy('id', 'asc')->with('service');
    }
    public function items()
    {
        return $this->hasMany(BookingsItems::class, 'booking_id', 'id')->with('service');
    }
    public function team_member(){
        return $this->hasMany(Users::class, 'id', 'team_member_id')->select('id','first_name','last_name','email','mobile','company_id','avatar','color');
    }
    public function customer(){
        return $this->hasOne(Customers::class, 'id', 'customer_id')->select('id','first_name','last_name','email','mobile','company_id','avatar');
    }
}
