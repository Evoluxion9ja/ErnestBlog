<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use App\User;
use App\Comment;
use App\Reply;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        $categories = Category::all();
        $tags = Tag::all();
        return view('publish.index',[
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:10|max:255',
            'slug' => 'required|min:10|max:255',
            'category_id' => 'required|string',
            'content' => 'required|min:10',
            'image' => 'image|nullable|max:2000'
        ]);

        //Upload of image

        if($request->hasFile('image')){
            $imageNameWithExtension = $request->file('image')->getClientOriginalName;
            $imageNameNoExtension = pathinfo($imageNameWithExtension, PATHINFO_FILENAME);
            $imageExtension = $request->file('image')->getClientOriginalExtension;
            $imageNameToStore = $imageNameNoExtension.'_'.time().'.'.$imageExtension;
            $location = $request->file('image').storeAs('public/blog_images', $imageNameToStore);
        }else{
            $imageNameToStore = 'no_image.jpg';
        }

        $posts = new Post;
        $posts->title = $request->input('title');
        $posts->slug = $request->input('slug');
        $posts->category_id = $request->input('category_id');
        $posts->content = $request->input('content');
        $posts->image = $imageNameToStore;
        $posts->user_id = auth()->user()->id;
        $posts->save();

        $posts->tags()->sync($request->tags, false);

        return redirect()->route('publish.index')->withSuccess('Article Posted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('publish.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
