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
                <a href="{{ url('/vehicles/create') }}" class="btn btn-primary"><i class="fe fe-plus mr-2"></i> Add Vehicles</a>
            </div>
        </form>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Vehicles</h3>
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
                                <th>Info</th>
                                <th>User</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vehicles as $vehicle)
                                <tr>
                                    <td>
                                        <div><span class="text-muted">name :</span> {{ $vehicle->name }} </div>
                                        <div><span class="text-muted">number  :</span> {{ $vehicle->number }} </div>
                                        <div><span class="text-muted">description :</span> {{ $vehicle->description }} </div>
                                    </td>
                                    <td>
                                        <div><span class="text-muted">name :</span> {{ $vehicle->user->name }} </div>
                                        <div><span class="text-muted">email :</span> {{ $vehicle->user->email }} </div>
                                    </td>
                                    <td class="text-nowrap">
                                        <div><span class="text-muted">created :</span> {{ $vehicle->created_at }} </div>
                                        <div><span class="text-muted">updated :</span> {{ $vehicle->updated_at->diffForHumans() }} </div>
                                    </td>
                                    <td class="text-right">
                                        <a href="/vehicles/{{ $vehicle->id }}/edit" class="icon mr-2 text-info"><i class="fe fe-edit"></i></a>
                                        <a href="/vehicles/{{ $vehicle->id }}/view" class="icon mr-2 text-info"><i class="fe fe-eye"></i></a>
                                        <a href="/vehicles/{{ $vehicle->id }}/delete" class="icon mr-2 text-danger"><i class="fe fe-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer pt-6 d-flex justify-content-center">
                        {{ $vehicles->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
