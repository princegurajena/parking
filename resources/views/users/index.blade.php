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
                        <h3 class="card-title">Users</h3>
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
                                <th>Info</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <span class="avatar avatar-{{ $user->role === 'admin' ? 'green' : 'blue' }}">{{ $user->role === 'admin' ? 'A' : 'D' }}</span>
                                    </td>
                                    <td>
                                        <div><span class="text-muted">name :</span> {{ $user->name }} </div>
                                    </td>
                                    <td>
                                        <div><span class="text-muted">email :</span> {{ $user->email }} </div>
                                    </td>

                                    <td class="">
                                        <div><span class="text-muted">created :</span> {{ $user->created_at }} </div>
                                        <div><span class="text-muted">updated :</span> {{ $user->updated_at->diffForHumans() }} </div>
                                    </td>

                                    <td class="text-right">
                                        @can('admin', \App\System::class)
                                            @if($user->role != 'admin')
                                                <a href="/users/{{ $user->id }}/admin" class="icon mr-2 text-success"><i class="fe fe-zap"></i></a>
                                            @else
                                                <a href="/users/{{ $user->id }}/remove" class="icon mr-2 text-danger"><i class="fe fe-zap-off"></i></a>
                                            @endif
                                            <a href="/parking-space/{{ $user->id }}/view" class="icon mr-2 text-info"><i class="fe fe-eye"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer pt-6 d-flex justify-content-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
