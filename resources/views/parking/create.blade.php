@extends('layouts.dashboard' , [ 'title' => 'Accounts - Add '  ,'active' => 'accounts' ])
@section('content')
    <div class="container p-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <form method="POST" class="card">
                    @csrf
                    <div class="card-body">
                        <h1 class="card-title">Create Parking Space</h1>
                    </div>

                    @if(session()->has('message'))
                        <div class="card-alert alert alert-icon alert-success">
                            <i class="fe fe-check mr-2" aria-hidden="true"></i> {!! session()->get('message') !!}
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h6 class="text-muted">Location</h6>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name" class="">Name</label>
                                    <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('lat' , request()->get('name') ) }}">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="lat" class="">Latitude</label>
                                    <input id="lat" type="text" class="form-control {{ $errors->has('lat') ? ' is-invalid' : '' }}" name="lat" value="{{ old('lat' , request()->get('lat') ) }}">
                                    @if ($errors->has('lat'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lat') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="long" class="">Longitude</label>
                                    <input id="long" type="text" class="form-control {{ $errors->has('long') ? ' is-invalid' : '' }}" name="long" value="{{ old('long' , request()->get('long') ) }}">
                                    @if ($errors->has('long'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('long') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="road" class="">Road</label>
                                    <input id="road" type="text" class="form-control {{ $errors->has('road') ? ' is-invalid' : '' }}" name="road" value="{{ old('road' , request()->get('road') ) }}">
                                    @if ($errors->has('road'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('road') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="city" class="">City</label>
                                    <input id="city" type="text" class="form-control {{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city' , request()->get('city') ) }}">
                                    @if ($errors->has('city'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="province" class="">Province</label>
                                    <input id="province" type="text" class="form-control {{ $errors->has('province') ? ' is-invalid' : '' }}" name="province" value="{{ old('province' , request()->get('province') ) }}">
                                    @if ($errors->has('province'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('province') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="country" class="">Country</label>
                                    <input id="country" type="text" class="form-control {{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" value="{{ old('country' , request()->get('country') ) }}">
                                    @if ($errors->has('country'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="rate" class=""> Rate Per Hour </label>
                                    <input id="rate" type="number" class="form-control {{ $errors->has('rate') ? ' is-invalid' : '' }}" name="rate" value="{{ old('rate' , request()->get('rate') ) }}">
                                    @if ($errors->has('rate'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rate') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-primary btn-block">Create Parking Space</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
