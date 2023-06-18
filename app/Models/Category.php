<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

//   protected $fillable=['name','description'];

    protected $table='categories';
    public $timestamps =false;
    protected $guarded=['id','created_at'];

    public function g()
    {
        return $this->hasOneThrough(Post::class,Post::class,);
    }

    public  function  products()
    {
        return $this->belongsToMany(Product::class,'product_categories');
    }

}
