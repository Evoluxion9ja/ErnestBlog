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
                                                <a href="">
                                                    <img src="/storage/blog_images/{{$post->image}}" width="100%" alt="">
                                                </a>
                                            </div>
                                            <div class="col-md-8 col-padding-right">
                                                <a href="">
                                                    <strong>{{strtoupper($post->title)}}</strong>
                                                    <p class="post text-justify">
                                                        {{str_limit($post->content, 400)}}
                                                    </p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($categories as $category)
                            <div class="col-md-12"><hr>
                                <h3 class="major-small">{{__(strtoupper($category->name))}}</h3>
                            </div>
                            <div class="col-md-12 category-scroll">
                                <div class="row">
                                    @foreach ($category->posts as $post)
                                        <div class="col-md-12" style="margin-bottom: 20px;">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <a href=""><img src="/storage/blog_images/{{$post->image}}" width="100%" alt=""></a>
                                                </div>
                                                <div class="col-md-8 col-padding-right">
                                                    <span><strong><a href="">{{strtoupper($post->title)}}</a></strong></span><hr>
                                                    <p class="post text-justify">
                                                        <a href="">{{str_limit($post->content, 400)}}</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="major-small">
                        <span><strong>{{__('Recent Articles')}}</strong></span>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="list-group sidebar-list">
                                @foreach ($recents as $recent)
                                    <a href="">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-4" style="padding-right:5px; padding-left:0;padding-top:0">
                                                    <img src="/storage/blog_images/{{$recent->image}}" width="100%" alt="">
                                                </div>
                                                <div class="col-md-8 col-padding-right">
                                                    <small><strong>{{$recent->title}}</strong></small>
                                                    <p class="sidebar-post text-justify">{{str_limit($recent->content, 70)}}</p>
                                                </div>
                                            </div>
                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        </div>
                    </div><hr>

                    <!--Recently updated Post-->
                        <div class="major-small">
                            <span><strong>{{__('Recenty Updated Articles')}}</strong></span>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="list-group sidebar-list">
                                    @foreach ($updates as $update)
                                        <a href="">
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-md-4" style="padding-right:5px; padding-left:0;padding-top:0">
                                                        <img src="/storage/blog_images/{{$update->image}}" width="100%" alt="">
                                                    </div>
                                                    <div class="col-md-8 col-padding-right">
                                                        <small><strong>{{$update->title}}</strong></small>
                                                        <p class="sidebar-post text-justify">{{str_limit($update->content, 70)}}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </a>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
