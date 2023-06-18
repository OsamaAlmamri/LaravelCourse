<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $guarded=['id','created_at'];

    public  function car()
    {
        return $this->belongsTo(Car::class,'car_id');
    }
}
