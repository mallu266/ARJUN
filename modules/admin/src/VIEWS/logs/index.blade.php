@extends('admin::layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('admin::layouts.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Logs Management</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Method</th>
                                        <th>User Id</th>
                                        <th>Route</th>
                                         <th>IP Address</th>
                                         <!--<th>Referer</th>-->
                                         <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($logs as $item)
                                    <tr>
                                        <td>
                                            {{ $item->methodType}}
                                        </td>
                                        <td>
                                            {{ $item->userId}}
                                        </td>
                                        <td>
                                            {{ $item->route}}
                                        </td>
                                        <td>
                                            {{ $item->ipAddress}}
                                        </td>
<!--                                        <td>
                                            {{ $item->referer}}
                                        </td>-->
                                        <td>
                                            <a href="{{ url('admin/users/log', $item->id) }}">View</a>
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