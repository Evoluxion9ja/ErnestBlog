@extends('layouts.app')

@section('content')
    <div class="row justify-content-center main-wrapper">
        <div class="col-md-9 card">
            <div class="row">
                <div class="col-md-8">
                    <h1>Publication Page  <span class="divide-line"></span><small class="major-small">{{$posts->count()}}<small> Articles</small></small></h1>
                </div>
                <div class="col-md-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                        Start Writing Here
                    </button>
                    {!! Form::open(['action' => 'PostController@store', 'method' => 'POST', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
                        @section('stylesheets')
                            {{Html::style('css/select2.min.css')}}
                        @endsection
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create Article</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            {{form::label('title', 'Article Title')}}
                                            {{form::text('title', '', ['class' => 'form-control', 'required' => '', 'minLength' => '3', 'maxLength' => '255'])}}
                                        </div>
                                        <div class="form-group">
                                            {{form::label('slug', 'Article Slug')}}
                                            {{form::text('slug', '', ['class' => 'form-control', 'required' => '', 'minLength' => '3', 'maxLength' => '255'])}}
                                        </div>
                                        <div class="form-group">
                                            {{form::label('category_id', 'Category')}}
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                  <label class="input-group-text" for="category_id">Options</label>
                                                </div>
                                                <select class="custom-select" id="category_id" name="category_id">
                                                    <option selected>Choose a Category</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{form::label('tags', 'Artcle Tags')}}
                                            <div class="input-group mb-3">
                                                <select class="custom-select select2-multi" id="tags[]" name="tags[]" multiple="multiple" style="width:100%">
                                                    @foreach ($tags as $tag)
                                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{form::label('content', 'Article Content')}}
                                            {{form::textarea('content', '', ['class' => 'form-control', 'required' => '', 'placeholder' => 'Start to write here'])}}
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
                </div>
            </div>
            @include('partials._validate')
        </div>
    </div>
    <div class="row justify-content-center main-wrapper" style="margin-top:5px;">
        <div class="col-md-9 card">
            <table class="table table-bordered table-dark">
                <thead>
                    <th><small><strong>Id</strong></small></th>
                    <th><small><strong>Title</strong></small></th>
                    <th><small><strong>Category</strong></small></th>
                    <th><small><strong>Tags</strong></small></th>
                    <th><small><strong>Date</strong></small></th>
                    <th><small><strong>Action</strong></small></th>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <th><strong>{{$post->id}}</strong></th>
                            <td>{{$post->title}}</td>
                            <td>{{$post->category->name}}</td>
                            <td>
                                @foreach ($post->tags as $tag)
                                    {{$tag->name}}
                                @endforeach
                            </td>
                            <td>{{date('M j, Y H:i a', strtotime($post->created_at))}}</td>
                            <td>{{Html::linkroute('publish.show', 'Details', [$post->id], ['class' => 'btn btn-outline-light btn-sm'])}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
