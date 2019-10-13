@extends('layouts.dashboard' , [ 'title' => 'Accounts - Add '  ,'active' => 'accounts' ])
@section('content')
    <div class="container p-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <form method="POST" action="/accounts/add" class="card">
                    @csrf
                    <div class="card-body">
                        <h1 class="card-title">Add Account</h1>
                    </div>
                    @if(session()->has('message'))
                        <div class="card-alert alert alert-icon alert-success">
                            <i class="fe fe-check mr-2" aria-hidden="true"></i> {!! session()->get('message') !!}
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h6 class="text-muted">Customer Info</h6>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="customer_id" class="">Customer ID</label>
                                    <input id="customer_id" type="text" class="form-control {{ $errors->has('customer_id') ? ' is-invalid' : '' }}" name="customer_id" value="{{ old('customer_id' , request()->get('customer') ) }}" required autofocus>
                                    @if ($errors->has('customer_id'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('customer_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <h6 class="text-muted">Account Info</h6>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="account" class="">Account</label>
                                    <input id="account" type="text" class="form-control{{ $errors->has('account') ? ' is-invalid' : '' }}" name="account" value="{{ old('account', request()->get('account')) }}" required autofocus>
                                    @if ($errors->has('account'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('account') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-primary btn-block">Create Account</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
