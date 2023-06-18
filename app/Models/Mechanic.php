<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    use HasFactory;


    protected $primaryKey='mechanic_id';

    public  function car()
    {

        return $this->hasOne(Car::class,'mechanic_id');
    }

    public function carOwner()
    {
        return $this->hasOneThrough(Owner::class, Car::class,'mechanic_id','car_id');
    }


}
