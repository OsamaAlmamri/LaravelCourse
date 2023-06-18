<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //

    public function index()
    {

        $post=Post::find(1);
        $comment=Comment::with(['post'])->find(1);

        $user=User::find(1);
       // return  dd($post->comments);
        return  dd($user->posts);
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
