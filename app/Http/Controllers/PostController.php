<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $this->validate($request,[
            'title' => 'required|max:255',
            'slug' => 'required|max:255|alpha_dash',
            'category_id' => 'required|integer',
            'content' => 'required|min:20',
            'image' => 'image|nullable|max:2000'
        ]);

        //Upload of image

        if($request->hasFile('image')){
            $imageNameWithExt = $request->file('image')->getClientOriginalName();
            $imageName = pathinfo($imageNameWithExt, PATHINFO_FILENAME);
            $imageExtension = $request->file('image')->getClientOriginalExtension();
            $imageFullName = $imageName.'_'.time().'.'.$imageExtension;
            $location = $request->file('image')->storeAs('public/blog_images', $imageFullName);
        }
        else{
            $imageFullName = 'no_image.jpg';
        }

        $posts = new Post;
        $posts->title = $request->input('title');
        $posts->slug = $request->input('slug');
        $posts->category_id = $request->input('category_id');
        $posts->content = $request->input('content');
        $posts->image = $imageFullName;
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
        $posts = Post::find($id);
        $categories = Category::all();
        $main_category = [];
        foreach($categories as $category){
            $main_category[$category->id] = $category->name;
        }

        $tags = Tag::all();
        $main_tags = [];
        foreach($tags as $tag){
            $main_tags[$tag->id] = $tag->name;
        }
        return view('publish.show', [
            'posts' => $posts,
            'categories' => $main_category,
            'tags' => $main_tags
        ]);
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
        $posts = Post::find($id);

        if($request->input('slug') == $posts->slug){
            $this->validate($request,[
                'title' => 'required|max:255',
                'category_id' => 'required|integer',
                'content' => 'required|min:20',
                'image' => 'image|nullable|max:2000'
            ]);
        }else{
            $this->validate($request,[
                'title' => 'required|max:255',
                'slug' => 'required|max:255|alpha_dash|unique:post, slug',
                'category_id' => 'required|integer',
                'content' => 'required|min:20',
                'image' => 'image|nullable|max:2000'
            ]);
        }

        //Upload of image

        if($request->hasFile('image')){
            $imageNameWithExt = $request->file('image')->getClientOriginalName();
            $imageName = pathinfo($imageNameWithExt, PATHINFO_FILENAME);
            $imageExtension = $request->file('image')->getClientOriginalExtension();
            $imageFullName = $imageName.'_'.time().'.'.$imageExtension;
            $location = $request->file('image')->storeAs('public/blog_images', $imageFullName);
        }

        $posts = Post::find($id);
        $posts->title = $request->input('title');
        $posts->slug = $request->input('slug');
        $posts->category_id = $request->input('category_id');
        $posts->content = $request->input('content');
        if($request->hasFile('image')){
            $posts->image = $imageFullName;
        }
        $posts->user_id = auth()->user()->id;
        $posts->save();

        if(isset($request->tags)){
            $posts->tags()->sync($request->tags);
        }else{
            $posts->tags()->sync([]);
        }

        return redirect()->route('publish.show', $posts->id)->withSuccess('Article updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Post::find($id);

        if($posts->image !== 'no_image.jpg'){
            Storage::delete('public/blog_images', $posts->image);
        }

        $posts->delete();

        return redirect()->route('publish.index')->withSuccess('Article successfully deleted');
    }
}
