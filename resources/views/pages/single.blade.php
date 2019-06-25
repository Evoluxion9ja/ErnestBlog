@extends('layouts.app')

@section('content')
    <div class="row justify-content-center main-wrapper">
        <div class="col-md-11">
            <div class="row justify-content-center">
                <div class="col-sm-9">
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
            </div>
        </div>
    </div>
@endsection