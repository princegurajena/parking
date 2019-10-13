@extends('layouts.dashboard' , [ 'title' => 'numbers - Add '  ,'active' => 'numbers' ])
@section('content')
    <div class="container p-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <form method="POST" class="card">
                    @csrf
                    <div class="card-body">
                        <h1 class="card-title">Add Vehicle</h1>
                    </div>
                    @if(session()->has('message'))
                        <div class="card-alert alert alert-icon alert-success">
                            <i class="fe fe-check mr-2" aria-hidden="true"></i> {!! session()->get('message') !!}
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name" class="">Name</label>
                                    <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name' , request()->get('customer') ) }}">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="number" class="">Number</label>
                                    <input id="number" type="text" class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}" name="number" value="{{ old('number', request()->get('number')) }}">
                                    @if ($errors->has('number'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="description" class="">Description</label>
                                    <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description', request()->get('description')) }}">
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-primary btn-block">Create Vehicle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
