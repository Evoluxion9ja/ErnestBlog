@extends('layouts.app')

@section('content')
    <div class="row justify-content-center main-wrapper">
        <div class="col-md-11">
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <div class="card">
                        <figure class="intro-image">
                            <img src="/storage/blog_images/{{$posts->image}}" width="100%" alt="">
                            <figcaption>
                                <span>
                                    <small class="major-small">
                                        {{$posts->category->name}}
                                    </small>&ensp;
                                    <small class="major-small">
                                        Written By: {{$posts->user->name}}
                                    </small>
                                </span><hr>
                                <h1>{{strtoupper($posts->title)}}</h1>
                                <p class="text-justify">{{str_limit($posts->content, 400)}}</p>
                                @foreach ($posts->tags as $tag)
                                    <a href="{{route('tags.show', $tag->id)}}" class="badge badge-pill badge-primary">{{$tag->name}}</a>
                                @endforeach
                            </figcaption>
                        </figure>
                        <div class="row justify-content-center">
                            <div class="col-md-9">
                                <p class="text-justify">{!! nl2br($posts->content) !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <button class="btn btn-outline-primary btn-block btn-md" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            <h3>Leave A Comment</h3>
                        </button>
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        {!! Form::open(['action' => ['CommentController@store', $posts->id], 'method' => 'POST', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-date']) !!}
                                            <div class="form-group">
                                                {{form::label('name', 'Full Name')}}
                                                @if (!Auth::guest())
                                                {{form::text('name', $posts->user->name, ['class' => 'form-control', 'required' => '', 'disabled' => ''])}}
                                                    @else 
                                                    {{form::text('name', '', ['class' => 'form-control', 'required' => ''])}}
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                {{form::label('email', 'E-mail')}}
                                                @if (!Auth::guest())
                                                {{form::text('email', $posts->user->email, ['class' => 'form-control', 'required' => '', 'disabled' => ''])}}
                                                @else 
                                                {{form::text('email', '', ['class' => 'form-control', 'required'])}}
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                {{form::label('message', 'Your Comment')}}
                                                {{form::textarea('message', '', ['class' => 'form-control', 'required' => ''])}}
                                            </div>
                                            {{form::submit('Submit', ['class' => 'btn btn-outline-primary btn-md'])}}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="major-small">{{strtoupper(__('Readers Comment' ))}}</div>
                        <div class="col-md-12 card my-comments">
                            @include('partials._validate')
                            @foreach ($posts->comments as $comment)
                                <div class="col-md-12 personal-info col-padding-right">
                                    <div class="author-info">
                                        <div class="author-image">
                                            <img src="" alt="">
                                        </div>
                                        <div class="author-name">
                                            <h4>{{$comment->name}}</h4>
                                            <p class="author-time">{{date('j / m / Y h:i a', strtotime($comment->created_at))}}</p>
                                        </div>
                                    </div>
                                    <div class="comment-content">
                                        <p class="comment-text text-justify">
                                            {{str_limit($comment->message, 150)}} 
                                            <span class="author-time">
                                                <a href="" class="btn-link" data-toggle="collapse" data-target="#view_collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                    @if (count($comment->replies) <= 1)
                                                        {{$comment->replies->count()}} Reply
                                                        @else 
                                                        {{$comment->replies->count()}} Replies
                                                    @endif
                                                </a>
                                            </span>
                                        </p>
                                        @if (!Auth::guest())
                                            <a href="" class="btn btn-outline-success btn-sm" data-toggle="collapse" data-target="#reply_collapseExample" aria-expanded="false" aria-controls="collapseExample">Reply</a>
                                            <a href="" class="btn btn-outline-primary btn-sm"  data-toggle="collapse" data-target="#edit_collapseExample" aria-expanded="false" aria-controls="collapseExample">Edit</a>
                                            <a href="" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Delete</a>
                                            @else
                                        @endif
                                    </div>
                                </div>

                                <!--Reply Form comes here-->
                                    <div class="collapse reply-collapse" id="reply_collapseExample">
                                        <div class="card card-body">
                                            {!! Form::open(['action' => ['ReplyController@store', $comment->id], 'method' => 'POST', 'data-parsley-validate' => '']) !!}
                                                <div class="form-group">
                                                    {{form::label('name', 'Full Name')}}
                                                    @if (!Auth::guest())
                                                    {{form::text('name', $posts->user->name, ['class' => 'form-control', 'required' => '', 'disabled' => ''])}}
                                                        @else 
                                                        {{form::text('name', '', ['class' => 'form-control', 'required' => ''])}}
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    {{form::label('email', 'E-mail')}}
                                                    @if (!Auth::guest())
                                                    {{form::text('email', $posts->user->email, ['class' => 'form-control', 'required' => '', 'disabled' => ''])}}
                                                    @else 
                                                    {{form::text('email', '', ['class' => 'form-control', 'required'])}}
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    {{form::label('message', 'Your Comment')}}
                                                    {{form::textarea('message', '', ['class' => 'form-control', 'required' => ''])}}
                                                </div>
                                                {{form::submit('Submit', ['class' => 'btn btn-outline-primary btn-md'])}}
                                            {!! Form::close() !!}
                                        </div>
                                    </div><!--Reply Form ends here-->

                                    <!--Comment Update form starts here-->
                                    <div class="collapse reply-collapse" id="edit_collapseExample">
                                        <div class="card card-body">
                                            {!! Form::open(['action' => ['CommentController@update', $comment->id], 'method' => 'PUT', 'data-parsley-validate' => '']) !!}
                                                <div class="form-group">
                                                    {{form::label('name', 'Full Name')}}
                                                    @if (!Auth::guest())
                                                    {{form::text('name', $posts->user->name, ['class' => 'form-control', 'required' => '', 'disabled' => ''])}}
                                                        @else 
                                                        {{form::text('name', '', ['class' => 'form-control', 'required' => ''])}}
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    {{form::label('email', 'E-mail')}}
                                                    @if (!Auth::guest())
                                                    {{form::text('email', $posts->user->email, ['class' => 'form-control', 'required' => '', 'disabled' => ''])}}
                                                    @else 
                                                    {{form::text('email', '', ['class' => 'form-control', 'required'])}}
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    {{form::label('message', 'Your Comment')}}
                                                    {{form::textarea('message', $comment->message, ['class' => 'form-control', 'required' => ''])}}
                                                </div>
                                                {{form::submit('Update', ['class' => 'btn btn-outline-primary btn-md'])}}
                                            {!! Form::close() !!}
                                        </div>
                                    </div><!--Comment update form ends here-->

                                    <!--Reply View collapse starts here-->
                                    <div class="collapse view-collapse" id="view_collapseExample">
                                        <div class="card card-body">
                                            @foreach ($comment->replies as $reply)
                                                <div class="col-md-12 personal-info col-padding-right">
                                                    <div class="author-info">
                                                        <div class="author-image">
                                                            <img src="" alt="">
                                                        </div>
                                                        <div class="author-name">
                                                            <h4>{{$reply->name}}</h4>
                                                            <p class="author-time">{{date('j / m / Y h:i a', strtotime($reply->created_at))}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="comment-content">
                                                        <p class="comment-text text-justify">
                                                            {{str_limit($reply->message, 150)}} 
                                                        </p>
                                                    </div>
                                                </div><hr>
                                            @endforeach
                                        </div>
                                    </div><!--Reply view Collapse ends here-->

                                    <!-- Reply Update form starts here-->
                                    <div class="collapse reply-collapse" id="reply-edit_collapseExample">
                                        <div class="card card-body">
                                            
                                        </div>
                                    </div><!--Reply Update form ends here-->

                                    <!--Delete Modal and form comes Here-->
                                    @foreach ($posts->comments as $comment)
                                        {!! Form::open(['action' => ['CommentController@destroy',$comment->id], 'method' => 'DELETE']) !!}
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Deleting Comment</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><h5>Are you sure you want to delete this comment?</h5></p>
                                                            <span>Written By : {{$comment->name}}</span><br>
                                                            <span>Posted On : {{date('j / m / Y H:i a', strtotime($comment->created_at))}}</span><br>
                                                            <span>Comment: <br>{{$comment->message}}</span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {{form::submit('Confirm Delete', ['class' => 'btn btn-danger btn-md'])}}
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection