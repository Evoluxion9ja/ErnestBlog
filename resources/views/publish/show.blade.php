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
                            <div class="col-md-4">
                                @if (!Auth::guest())
                                    @if (Auth::user()->id == $posts->user->id)
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn major-small badge-pill btn-md" data-toggle="modal" data-target="#exampleModal">
                                            Edit Blog
                                        </button>
                                        <button type="button" class="btn major-small badge-pill btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                                            Delete Blog
                                        </button>
                                        {!! Form::open(['action' => ['PostController@update', $posts->id], 'method' => 'PUT', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
                                            @section('stylesheets')
                                                {{Html::style('css/select2.min.css')}}
                                            @endsection
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update Article</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                {{form::label('title', 'Article Title')}}
                                                                {{form::text('title', $posts->title, ['class' => 'form-control', 'required' => '', 'minLength' => '3', 'maxLength' => '255'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{form::label('slug', 'Article Slug')}}
                                                                {{form::text('slug', $posts->slug, ['class' => 'form-control', 'required' => '', 'minLength' => '3', 'maxLength' => '255'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{form::label('category_id', 'Category')}}
                                                                {{form::select('category_id', $categories, $posts->category->id, ['class' => 'form-control'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{form::label('tags', 'Artcle Tags')}}
                                                                {{ form::select('tags[]', $tags, $posts->tags, ['class' => 'form-control custom-slelct select2-multi', 'multiple' => 'multiple', 'style' => 'width:100%']) }}
                                                            </div>
                                                            <div class="form-group">
                                                                {{form::label('content', 'Article Content')}}
                                                                {{form::textarea('content', $posts->content, ['class' => 'form-control', 'required' => '', 'placeholder' => 'Start to write here'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{form::label('image', 'Article Image')}}
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="image">Upload</span>
                                                                    </div>
                                                                    <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" name="image" id="image" aria-describedby="inputGroupFileAddon01">
                                                                    <label class="custom-file-label" for="image">Choose file</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            {{form::submit('publish', ['class' => 'btn btn-primary'])}}
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @section('javascripts')
                                                {{Html::script('js/select2.min.js')}}
                                                <script type="text/javascript">
                                                    $(document).ready(function(){
                                                        $('.select2-multi').select2();
                                                    });
                                                </script>
                                            @endsection
                                        {!! Form::close() !!}
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">You are about to delete an article</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span><h4>Are you sure you want to delete this Article</h4></span>
                                                        <div class="row">
                                                            <div class="col-md-4 col-sm-4">
                                                                <img src="storage/blog_images/{{$posts->image}}" width="100%" alt="">
                                                            </div>
                                                            <div class="col-md-8 col-sm-8">
                                                                <p style="color: #000">{{strtoupper($posts->title)}}</p>
                                                                <p>{{str_limit($posts->content, 300)}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {!! Form::open(['action' => ['PostController@destroy', $posts->id], 'method' => 'DELETE']) !!}
                                                            {{form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                                        {!! Form::close() !!}
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection