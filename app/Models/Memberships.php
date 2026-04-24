<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memberships extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'company_id',
        'sessions',
        'session_no',
        'valid_for',
        'start_date',
        'end_date',
        'color',
        'price',
        'terms_conditions',
        'created_by',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function services(){
        return $this->hasMany(MembershipServices::class, 'membership_id', 'id');
    }
}
