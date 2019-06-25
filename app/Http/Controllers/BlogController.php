<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function article(){
        return view('pages.article');
    }

    public function single($slug){
        $posts = Post::where('slug', '=', $slug)->first();
        return view('pages.single',[
            'posts' => $posts
        ]);
    }
}
