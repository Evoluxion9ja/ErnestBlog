@extends('layouts.app')

@section('content')
    <div class="row justify-content-center main-wrapper">
        <div class="col-md-9 card">
            @include('partials._validate')
            <div class="row">
                <div class="col-md-8">
                    <h1>Blog Tags Dashboard</h1>
                </div>
                <div class="col-md-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-md btn-block" data-toggle="modal" data-target="#exampleModal" style="margin-top:5px;">
                        Create New Tag
                    </button>
                    {!! Form::open(['action'=> 'TagController@store', 'method' => 'POST', 'data-parsley-validate' => '' ]) !!}
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Creat Blog Tag</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            {{form::text('name', '', ['class' => 'form-control', 'placeholder'=> 'Create tag Here', 'required' => '' ])}}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {{form::submit('Create', ['class' => 'btn btn-primary btn-md'])}}
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-md-12">
                    <hr>
                    <table class="table table-bordered table-dark">
                        <thead>
                            <th><small><strong>Id</strong></small></th>
                            <th><small><strong>Tag Name</strong></small></th>
                            <th><small><strong>Post Count</strong></small></th>
                            <th><small><strong>Created AT</strong></small></th>
                            <th><small><strong>Action</strong></small></th>
                        </thead>
                        <tbody>
                            @foreach ($tags as $tag)
                                <tr>
                                    <th><small><strong>{{$tag->id}}</strong></small></th>
                                    <td><small>{{$tag->name}}</small></td>
                                    <td><small>{{$tag->posts()->count()}}
                                        @if (count($tag->posts) > 0)
                                            {{(__('Articles'))}}
                                            @else {{(__('Article'))}}
                                        @endif
                                    </small></td>
                                    <td><small>{{date('M j, Y H:i a', strtotime($tag->created_at))}}</small></td>
                                    <td>
                                        {{Html::linkroute('tags.show', 'Details', [$tag->id], ['class' => 'btn btn-outline-light btn-sm', 'style' => 'float: left; margin-right:5px;'])}}
                                        {!! Form::open(['action' => ['TagController@destroy', $tag->id], 'method' => 'DELETE']) !!}
                                            {{form::submit('Delete', ['class' => 'btn btn-outline-danger btn-sm'])}}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
