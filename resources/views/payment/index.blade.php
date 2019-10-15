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
                        <h3 class="card-title">Payments</h3>
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
                            @foreach($payments as $payment)
                                <tr>
                                    <td>
                                        <span class="avatar avatar-{{ $payment->request->status === 'init' ? 'green' : 'blue' }}">{{ $payment->request->status === 'init' ? 'I' : 'C' }}</span>
                                    </td>
                                    <td>
                                        <div><span class="text-muted">name :</span> {{ $payment->request->user->name }} </div>
                                        <div><span class="text-muted">email :</span> {{ $payment->request->user->email }} </div>
                                        <div><span class="text-muted">number :</span> {{ $payment->request->vehicle->number }} </div>
                                    </td>
                                    <td>
                                        <div><span class="text-muted">name :</span> {{ $payment->request->location->name }} </div>
                                        <div><span class="text-muted">road :</span> {{ $payment->request->location->road }} </div>
                                        <div><span class="text-muted">city :</span> {{ $payment->request->location->city }} </div>
                                    </td>
                                    <td>
                                        <div><span class="text-muted">amount :</span> {{ $payment->request->amount}} </div>
                                        <div><span class="text-muted">number :</span> {{ $payment->request->number }} </div>
                                        <div><span class="text-muted">type :</span> {{ $payment->request->type }} </div>
                                    </td>

                                    <td class="">
                                        <div><span class="text-muted">created :</span> {{ $payment->created_at }} </div>
                                        <div><span class="text-muted">updated :</span> {{ $payment->updated_at->diffForHumans() }} </div>
                                    </td>

                                    <td class="text-right">
                                        <a href="/parking-space/{{ $payment->id }}/view" class="icon mr-2 text-info"><i class="fe fe-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer pt-6 d-flex justify-content-center">
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
