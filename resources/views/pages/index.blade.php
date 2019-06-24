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
            <div class="row preview-content" style="margin-top:10px;">
                <div class="col-md-9">
                        <div class="major-small"><h3>{{__('Most Read Articles')}}</h3></div>
                    <div class="row">
                        @foreach ($posts->slice(6, 6) as $post)
                            <div class="col-md-6"><hr>
                                <div class="row">
                                    <div class="col-md-4 sub-popular-left">
                                        <img src="/storage/blog_images/{{$post->image}}" width="100%" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <small><strong>{{strtoupper($post->title)}}</strong></small>
                                        <p class="text-justify my-posts">{{str_limit($post->content, 250)}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        @foreach ($categories as $category)
                            <div class="col-md-12"> <hr/>
                                <h3 class="major-small">
                                    {{strtoupper($category->name)}}
                                </h3>
                                <div class="row">
                                    @foreach ($category->posts as $post)
                                        <div class="col-md-4">
                                            <img src="/storage/blog_images/{{$post->image}}" width="100%" alt="">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="major-small">{{$post->title}}</div>
                                            <p class="text-justify">{{str_limit($post->content, 600)}}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3 my-sidebar">
                    <div class="major-small text-center">
                        <h4>Popular Articles</h4>
                    </div>
                    <ul class="list-group my-list-group">
                        @foreach ($populars->take(10) as $popular)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4 recent-images">
                                        <img src="/storage/blog_images/{{$popular->image}}" width="100%" alt="">
                                    </div>
                                    <div class="col-md-8 text-left recent-text">
                                        <span><small><strong>{{$popular->title}}</strong></small></span>
                                        <p class="text-justify"><small>{{str_limit($popular->content, 80)}}</small></p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul><hr>

                    <div class="major-small text-center">
                        <h4>Recently Updated Articles</h4>
                    </div>
                    <ul class="list-group my-list-group">
                        @foreach ($recents->take(10) as $recent)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4 recent-images">
                                        <img src="/storage/blog_images/{{$recent->image}}" width="100%" alt="">
                                    </div>
                                    <div class="col-md-8 text-left recent-text">
                                        <span><small><strong>{{$recent->title}}</strong></small></span>
                                        <p class="text-justify"><small>{{str_limit($recent->content, 80)}}</small></p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
