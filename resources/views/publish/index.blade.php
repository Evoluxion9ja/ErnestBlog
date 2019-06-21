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
                    {!! Form::open(['action' => 'PostController@store', 'method' => 'POST', 'data-parsley-validate' => '']) !!}
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
                                            {{form::text('title', 'Article Title')}}
                                            {{form::text('title', '', ['class' => 'form-control', 'required' => '', 'minLength' => '3', 'maxLength' => '255'])}}
                                        </div>
                                        <div class="form-group">
                                            {{form::text('slug', 'Article Slug')}}
                                            {{form::text('slug', '', ['class' => 'form-control', 'required' => '', 'minLength' => '3', 'maxLength' => '255'])}}
                                        </div>
                                        <div class="form-group">
                                            {{form::text('category_id', 'Category')}}
                                            <select name="category_id" id="category_id">
                                                    <option value="Choose">Choose a category</option>
                                                @foreach ($posts->categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @section('javascripts')
                            {{Html::script('js/select2.min.js')}}
                            <script type="ext/javascriptt">
                                $(document).ready(){
                                    $('.select2-multi').select2();
                                }
                            </script>
                        @endsection
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
