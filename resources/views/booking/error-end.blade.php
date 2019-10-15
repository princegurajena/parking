@extends('layouts.dashboard' , [ 'title' => 'Accounts - Add '  ,'active' => 'accounts' ])
@section('content')
    <div class="container p-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <span class="avatar avatar-red avatar-xxl"><i class="fe fe-x"></i></span>
                        </div>
                    </div>
                    <div class="card-alert alert alert-danger text-center">
                        Something is wrong with your payment reference
                    </div>
                    <div class="card-body"></div>
                </div>
            </div>
        </div>
    </div>
@endsection


