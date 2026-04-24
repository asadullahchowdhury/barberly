<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingsItems extends Model
{
    use HasFactory;
    protected $table = 'booking_items';
    protected $fillable = [
        'company_id',
        'booking_id',
        'catalogue_id',
        'service_id',
        'pricing_id',
        'member_id',
        'start_time',
        'end_time',
        'duration',
        'price',
    ];
    protected $hidden = [
      'created_at',
      'updated_at',
      'deleted_at',
    ];
    public function service(){
        return $this->hasOne(CatelougeServices::class, 'id', 'service_id')->with(['pricing','catalogue']);
    }
}
