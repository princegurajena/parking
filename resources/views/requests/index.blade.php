@extends('layouts.dashboard' , [ 'title' => 'Home' , 'name' => 'Home' ])
@section('content')
    <div class="container pt-5">
        <form class="page-header row px-0" method="GET">
            <div class="input-group col-lg-6 ml-auto">
                <input type="text" class="form-control" name="search" placeholder="Search" value="{{ old('search' , request('search')) }}">
                <span class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
            </span>
            </div>
        </form>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Requests</h3>
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
                                <th width="10"></th>
                                <th>User</th>
                                <th>Location</th>
                                <th>Info</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($requests as $request)
                                <tr>
                                    <td>
                                        <span class="avatar avatar-{{ $request->status === 'init' ? 'green' : 'blue' }}">{{ $request->status === 'init' ? 'I' : 'C' }}</span>
                                    </td>
                                    <td>
                                        <div><span class="text-muted">name :</span> {{ $request->user->name }} </div>
                                        <div><span class="text-muted">email :</span> {{ $request->user->email }} </div>
                                        <div><span class="text-muted">number :</span> {{ $request->vehicle->number }} </div>
                                    </td>
                                    <td>
                                        <div><span class="text-muted">name :</span> {{ $request->location->name }} </div>
                                        <div><span class="text-muted">road :</span> {{ $request->location->road }} </div>
                                        <div><span class="text-muted">city :</span> {{ $request->location->city }} </div>
                                    </td>
                                    <td>
                                        <div><span class="text-muted">amount :</span> {{ $request->amount}} </div>
                                        <div><span class="text-muted">number :</span> {{ $request->number }} </div>
                                        <div><span class="text-muted">type :</span> {{ $request->type }} </div>
                                    </td>

                                    <td class="">
                                        <div><span class="text-muted">created :</span> {{ $request->created_at }} </div>
                                        <div><span class="text-muted">updated :</span> {{ $request->updated_at->diffForHumans() }} </div>
                                    </td>

                                    <td class="text-right">
                                        <a href="/parking/{{ $request->id }}/view" class="icon mr-2 text-info"><i class="fe fe-eye"></i></a>
                                        @can('admin', \App\System::class)
                                            <a href="/parking/{{ $request->id }}/override" class="icon mr-2 text-info"><i class="fe fe-zap"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer pt-6 d-flex justify-content-center">
                        {{ $requests->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
