@extends('layouts.app')

@section('content')
    <div class="row justify-content-center main-wrapper">
        <div class="col-md-9 card">
            @include('partials._validate')
            <div class="row">
                <div class="col-md-8">
                    <h1>Categories Dashboard</h1>
                </div>
                <div class="col-md-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-md btn-block" data-toggle="modal" data-target="#exampleModal" style="margin-top:5px;">
                        Create New Category
                    </button>
                    {!! Form::open(['action'=> 'CategoryController@store', 'method' => 'POST', 'data-parsley-validate' => '' ]) !!}
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            {{form::text('name', '', ['class' => 'form-control', 'placeholder'=> 'Create Category Here', 'required' => '' ])}}
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
            </div>
        </div>
    </div>
@endsection
