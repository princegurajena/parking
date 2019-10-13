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
            <a href="/accounts/add" class="btn btn-primary"><i class="fe fe-plus mr-2"></i> Add Account </a>
        </div>
    </form>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table card-table table-striped table-vcenter">
                        <thead>
                        <tr>
                            <th colspan="2">User</th>
                            <th>Commit</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><span class="avatar" style="background-image: url(./demo/faces/female/11.jpg)"></span></td>
                            <td>Sharon Wells</td>
                            <td>Fixes #625</td>n
                            <td class="text-nowrap">April 9, 2018</td>
                            <td class="d-flex justify-content-end">
                                <a href="#" class="icon mr-2"><i class="fe fe-edit"></i></a>
                                <a href="#" class="icon mr-2"><i class="fe fe-eye"></i></a>
                                <a href="#" class="icon mr-2"><i class="fe fe-trash"></i></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
