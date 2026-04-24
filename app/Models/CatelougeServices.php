<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatelougeServices extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function pricing(){
        return $this->hasMany(Pricing::class, 'service_id', 'id');
    }
    public function catalogue(){
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }
}
