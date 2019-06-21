@extends('layouts.app')

@section('content')
    <div class="row justify-content-center main-wrapper">
        <div class="col-md-8 card">
            <div class="row">
                <div class="col-md-8">
                    <h1>{{$tags->name}}</h1>
                    <h5>{{$tags->posts()->count()}}
                        @if (count($tags->posts) > 0)
                            Articles
                            @else Article
                        @endif
                    </h5>
                </div>
                <div class="col-md-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-md btn-block" data-toggle="modal" data-target="#exampleModalEdit" style="margin-top:5px;">
                        Modify {{$tags->name}}
                    </button>
                    {!! Form::open(['action'=> ['TagController@update', $tags->id], 'method' => 'PUT', 'data-parsley-validate' => '' ]) !!}
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">You are modifying <strong>{{$tags->name}}</strong> Tag</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            {{form::text('name', $tags->name, ['class' => 'form-control', 'required' => '' ])}}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {{form::submit('Update', ['class' => 'btn btn-success btn-md'])}}
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
            @include('partials._validate')
        </div>
    </div>
@endsection
