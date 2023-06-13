<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //

    public function index()
    {
        return view('posts.index');
    }

    public function carts()
    {
        $companies = [
            ['name' => "appal", "price" => 50],
            ['name' => "samsung", "price" => 45],
            ['name' => "sony", "price" => 40],
            ['name' => "Huawei", "price" => 35],
        ];
        return view('carts.index')
            ->with('companies',$companies);
    }
}
