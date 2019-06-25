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
                </div>
                <div class="col-md-4">
                    <div class="major-small">{{strtoupper(__('Readers Comment' ))}}</div>
                    <div class="col-md-12 card">
                        
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-8">
                    <div class="card comment-Bg">
                        <p>
                            <button class="btn btn-outline-primary btn-block btn-md" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                <h3>Leave A Comment</h3>
                            </button>
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="collapse" id="collapseExample">
                                        <div class="card card-body">
                                            {!! Form::open(['action' => ['CommentController@store', $posts->id], 'method' => 'POST', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-date']) !!}
                                                @include('partials._validate')
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
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection