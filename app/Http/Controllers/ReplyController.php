<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use App\User;
use App\Comment;
use App\Reply;

class ReplyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $comment_id)
    {
        $comments = Comment::find($comment_id);

        if(isset(auth()->user()->id)){
            $this->validate($request, [
                'message' => 'required|max:2000'
            ]);
        }else{
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'message' => 'required|string|max:255'
            ]);
        }

        $replies = new Reply;
        if(isset(auth()->user()->id)){
            $replies->name = auth()->user()->name;
        }else{
            $replies->name = $request->input('name');
        }

        if(isset(auth()->user()->id)){
            $replies->email = auth()->user()->email;
        }else{
            $replies->email = $request->input('email');
        }

        $replies->message = $request->input('message');
        $replies->comment()->associate($comments);
        $replies->save();

        return redirect()->route('single.index', $comments->post->slug)->withSuccess('Reply has been received');
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
        $this->validate($request, [
            'message' => 'required|max:255'
        ]);

        $posts_slug = $comments->post->slug;
        $replies = Reply::find($id);
        $replies->message = $request->input('message');
        $replies->save();

        return redirect()->route('single.index', $posts_slug )->withSuccess('Updated reply successfully');
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
