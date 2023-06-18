<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $guarded=['id','created_at'];

    public  function mechanic()
    {
        return $this->belongsTo(Mechanic::class,'mechanic_id');
    }

    public  function owner()
    {
        return $this->hasOne(Owner::class,'car_id');
    }

    public function colors()
    {

        return $this->belongsToMany(Color::class,'car_colors')->withPivot(['name']);
    }
}
