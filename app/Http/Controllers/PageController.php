<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use App\User;
use App\Comment;
use App\Reply;

class PageController extends Controller
{
    public function index(){
        $posts = Post::all();
        $populars = Post::orderBy('title', 'desc')->get();
        $recents = Post::orderBy('id', 'asc')->get();
        $categories = Category::all();
        $updates = Post::orderBy('updated_at', 'desc')->get();
        return view('pages.index', [
            'posts' => $posts,
            'populars' => $populars,
            'categories' => $categories,
            'recents' => $recents,
            'updates' => $updates
        ]);
    }
    
    public function single($slug){
        $posts = Post::where('slug', '=', $slug)->first();
        return view('pages.single',[
            'posts' => $posts
        ]);
    }
}
