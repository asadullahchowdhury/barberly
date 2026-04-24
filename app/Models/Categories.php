<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;


    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function services(){
        return $this->hasMany(CatelougeServices::class, 'category_id', 'id')->orderBy('sort', 'asc')->with('pricing');
    }
}
