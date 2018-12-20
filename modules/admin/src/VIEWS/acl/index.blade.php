@extends('admin::layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('admin::layouts.sidebar')
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Roles</div>
                        <div class="card-body">
                            <a href="{{url('admin/acl/roles')}}">Settings</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Permissions</div>
                        <div class="card-body">
                            <a href="{{url('admin/acl/permissions')}}">Settings</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Role Matrix</div>
                        <div class="card-body">
                            <a href="{{url('admin/acl/rolematrix')}}">Settings</a>
                        </div>
                    </div>
                </div>
<!--                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">User Matrix</div>
                        <div class="card-body">
                            <a href="{{url('admin/acl/usermatrix')}}">Settings</a>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection