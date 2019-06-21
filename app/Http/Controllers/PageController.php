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
        return view('pages.index');
    }
}
