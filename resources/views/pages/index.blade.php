@extends('layouts.app')

@section('content')
    <div class="row justify-content-center main-wrapper">
        <div class="col-md-10 card main-wrapper">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="slider card">
                        <figure class="slider-figure">
                            @foreach ($posts->take(1) as $post)
                                <img src="/storage/blog_images/{{$post->image}}" width="100%" alt="">
                                <figcaption>
                                    <div class="major-small">
                                        <span>Category: <strong>{{strtoupper($post->category->name)}}</strong></span> &ensp;|&ensp;
                                        <span>Written By: <strong>{{strtoupper($post->user->name)}}</strong></span> &ensp;|&ensp;
                                        <span>Written On: <strong>{{date('M j, Y', strtotime($post->created_at))}} | {{$post->created_at->diffForHumans()}}</strong></span>
                                    </div><hr>
                                    <h3>{{strtoupper($post->title)}}</h3>
                                    <p class="text-justify">{{str_limit($post->content, 400)}}</p>
                                    <a href="" class="btn btn-primary btn-md">Continue Reading</a>
                                </figcaption>
                            @endforeach
                        </figure>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="major-small">{{__(strtoupper('Most Read Articles'))}}</h3>
                        </div>
                        <div class="col-md-12 recent-scroll">
                            <div class="row">
                                @foreach ($posts as $post)
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4 col-padding-left">
                                                <a href=""><img src="/storage/blog_images/{{$post->image}}" width="100%" alt=""></a>
                                            </div>
                                            <div class="col-md-8 col-padding-right">
                                                <span><h5><small><strong>{{$post->title}}</strong></small></h5></span>
                                                <a href="">
                                                    <p class="post text-justify">
                                                        {{str_limit($post->content, 100)}}
                                                    </p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div><hr>
                    <div class="row">
                        
                    </div>
                </div>
                <div class="col-md-3">

                </div>
            </div>
        </div>
    </div>
@endsection
