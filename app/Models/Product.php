<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id', 'created_at'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public  function  user()
    {
       return $this->belongsTo(User::class);
    }
    public  function  userWhoDelete()
    {
       return $this->belongsTo(User::class,'deleted_by');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,
            'product_categories');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
