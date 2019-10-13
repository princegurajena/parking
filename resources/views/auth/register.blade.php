@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-login mx-auto">
                <div class="text-center mb-6">
                    <h2></h2>
                </div>
                <div class="card rounded-0 shadow-lg border-0">
                    <div class="card-body">
                        <div class="card-title">Create new account</div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email" class="">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="password" class="">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group ">
                                <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>

                            <div class="form-group ">
                                <button type="submit" class="btn btn-primary btn-block shadow-lg rounded-0">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center text-muted">
                    Already have account? <a href="{{ route('login') }}">Sign in</a>
                </div>
            </div>
        </div>
    </div>
@endsection
