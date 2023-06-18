<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;


    public function cars()
    {

        return $this->belongsToMany(Car::class,'car_colors')->withPivot(['name']);
    }
}
