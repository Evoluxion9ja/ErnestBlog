<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use App\User;
use App\Comment;
use App\Reply;

class CommentController extends Controller
{
   
    public function store(Request $request, $post_id)
    {
        
        if(isset(auth()->user()->id)){
            $this->validate($request, [
                'message' => 'required|max:2000'
            ]);
        }else{
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'message' => 'required|max:2000'
            ]);
        }
        $posts = Post::find($post_id);
        $comments = new Comment;

        if(isset(auth()->user()->id)){
            $comments->name = auth()->user()->name;
        }else{
            $comments->name = $request->input('name');
        }

        if(isset(auth()->user()->id)){
            $comments->email = auth()->user()->email;
        }else{
            $comments->email = $request->input('email');
        }

        $comments->message = $request->input('message');
        $comments->post()->associate($posts);
        $comments->save();

        return redirect()->route('single.index', $posts->slug)->withSuccess('Comment posted successfully');
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
