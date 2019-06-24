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
        $recents = Post::orderBy('updated_at', 'desc')->get();
        $categories = Category::all();
        return view('pages.index', [
            'posts' => $posts,
            'populars' => $populars,
            'categories' => $categories,
            'recents' => $recents
        ]);
    }
}
