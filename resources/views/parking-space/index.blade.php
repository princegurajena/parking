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
        <div class="col-lg-2 pr-0 text-right">
            <a href="{{ url('/parking-space/create') }}" class="btn btn-primary"><i class="fe fe-plus mr-2"></i> Add Parking Space </a>
        </div>
    </form>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Parking Spaces</h3>
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
                            <th>Info</th>
                            <th>Marker</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>User</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($locations as $location)
                            <tr>
                                <td>
                                    <span class="avatar avatar-{{ $location->occupied ? 'red' : ( $location->reserved ? 'orange' : 'green' ) }}">{{ $location->occupied ? 'O' : ( $location->reserved ? 'R' : 'A' ) }}</span>
                                </td>
                                <td>
                                    <div><span class="text-muted">name :</span> {{ $location->name }} </div>
                                    <div><span class="text-muted">country :</span> {{ $location->country }} </div>
                                    <div><span class="text-muted">status :</span> {{ $location->status }} </div>
                                </td>
                                <td>
                                    <div><span class="text-muted">lat :</span> {{ $location->lat }} </div>
                                    <div><span class="text-muted">long :</span> {{ $location->long }} </div>
                                </td>
                                <td>
                                    <div><span class="text-muted">road :</span> {{ $location->road }} </div>
                                    <div><span class="text-muted">city :</span> {{ $location->city }} </div>
                                    <div><span class="text-muted">province :</span> {{ $location->province }} </div>
                                </td>
                                <td class="text-nowrap">
                                    <div><span class="text-muted">created :</span> {{ $location->created_at }} </div>
                                    <div><span class="text-muted">updated :</span> {{ $location->updated_at->diffForHumans() }} </div>
                                </td>
                                <td>
                                    @if ($location->occupier || $location->reserver)
                                            @if ($location->occupier)
                                                <div><span class="text-muted">name :</span> {{ $location->occupier->name }} </div>
                                                <div><span class="text-muted">email :</span> {{ $location->occupier->email }} </div>
                                            @endif
                                            @if ($location->reserver)
                                                <div><span class="text-muted">name :</span> {{ $location->reserver->name }} </div>
                                                <div><span class="text-muted">email :</span> {{ $location->reserver->email }} </div>
                                            @endif
                                        @else
                                        <div class="text-center">
                                            <span class="px-3 py-1 border border-{{ $location->occupied ? 'danger' : ( $location->reserved ? 'warning' : 'success' ) }}  text-{{ $location->occupied ? 'danger' : ( $location->reserved ? 'warning' : 'success' ) }} ">{{ $location->occupied ? 'occupied' : ( $location->reserved ? 'reserved' : 'available' ) }}</span>
                                        </div>
                                       @endif
                                </td>
                                <td class="text-right">
                                    @if($location->status != 'active')
                                        <a href="/parking-space/{{ $location->id }}/activate" class="icon mr-2 text-success"><i class="fe fe-zap"></i></a>
                                    @else
                                        <a href="/parking-space/{{ $location->id }}/block" class="icon mr-2 text-danger"><i class="fe fe-zap-off"></i></a>
                                    @endif
                                    <a href="/parking-space/{{ $location->id }}/edit" class="icon mr-2 text-info"><i class="fe fe-edit"></i></a>
                                    <a href="/parking-space/{{ $location->id }}/view" class="icon mr-2 text-info"><i class="fe fe-eye"></i></a>
                                    <a href="/parking-space/{{ $location->id }}/delete" class="icon mr-2 text-danger"><i class="fe fe-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="card-footer pt-6 d-flex justify-content-center">
                    {{ $locations->links() }}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
