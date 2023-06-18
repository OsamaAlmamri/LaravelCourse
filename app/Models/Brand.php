<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $guarded=['id','created_at'];

    public function products()
    {
        return $this->hasMany(Product::class,'brand_id');
    }
}
