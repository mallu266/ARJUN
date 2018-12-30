@extends('admin::layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('admin::layouts.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">User Logs</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table users">
                                    <thead>
                                        <tr>
                                            <th>Method</th>
                                            <th>Description</th>
                                            <th>UserType</th>
                                            <th>User</th>
                                            <th>Route</th>
                                            <th>IP Address</th>
                                            <th>Referer</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@include('admin::common.datatables')
@endsection