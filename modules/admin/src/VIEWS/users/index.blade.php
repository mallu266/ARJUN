@extends('admin::layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('admin::layouts.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">User Management <a href="{{ url('admin/users', ['add']) }}">Add</a></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)
                                    <tr>
                                        <td>
                                            {{ $item->id}}
                                        </td>
                                        <td>
                                            {{ $item->name}}
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/users/show', $item->id) }}">View</a>
                                            <a href="{{ url('admin/users/edit', $item->id) }}">Edit</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection