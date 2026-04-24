<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealServices extends Model
{
    public function service_details()
    {
        return $this->hasOne(CatelougeServices::class, 'id', 'service_id');
    }
}
