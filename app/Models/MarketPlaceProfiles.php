<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketPlaceProfiles extends Model
{
    protected $table = 'marketplace_profiles';

    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
      'company_id',
      'location_name',
      'phone',
      'email',
      'services_for',
      'description',
      'address',
      'apt',
      'district',
      'city',
      'region',
      'postcode',
      'country',
    ];

    public function openingHours()
    {
        return $this->hasMany(OpeningHours::class);
    }
    public function days()
    {
        return $this->hasMany(OpeningHours::class,'company_id', 'company_id');
    }
    public function photos()
    {
        return $this->hasMany(CompaniesPhotos::class, 'company_id', 'company_id');
    }
    public function services()
    {
        return $this->hasMany(CatelougeServices::class, 'company_id', 'company_id');
    }
    public function company()
    {
        return $this->hasOne(Companies::class, 'id', 'company_id');
    }
    public function teams()
    {
        return $this->hasMany(Users::class, 'company_id', 'company_id');
    }
}
