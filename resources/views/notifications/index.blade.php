@extends('layouts.dashboard' , [ 'title' => 'Home' , 'name' => 'Home' ])
@section('content')
    <div class="container pt-5">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Notifications</h3>
                    </div>
                    @if(session()->has('message'))
                        <div class="card-alert alert alert-icon alert-success">
                            <i class="fe fe-check mr-2" aria-hidden="true"></i> {!! session()->get('message') !!}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table card-table table-striped table-vcenter">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Message</th>
                                <th>Time</th>
                                <th>Type</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($notifications as $notification)
                                    <tr>
                                        <td>{{ $notification->id }}</td>
                                        <td>{{ $notification->message }}</td>
                                        <td>{{ $notification->created_at }}</td>
                                        <td>{{ $notification->type }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer pt-6 d-flex justify-content-center">
                        {{ $notifications->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
