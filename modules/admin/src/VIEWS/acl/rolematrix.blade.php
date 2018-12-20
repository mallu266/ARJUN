@extends('admin::layouts.app')
@section('content')
<?php
$permissionroles = new \ARJUN\ADMIN\CONTROLLERS\ACL\ACLCONTROLLER();
?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('admin::layouts.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Role Matrix</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{url('admin/acl/rolematrix/post')}}">
                                {{csrf_field()}}
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                Roles->
                                            </th>
                                            @foreach($roles as $role)
                                            <th>
                                                {{$role->name}}
                                            </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($permissions as $permission)
                                        <tr>
                                            <th class="alert-warning">
                                                <a href="{{url('admin/acl/roles/users')}}">
                                                    <button type="button" class="btn btn-warning btn-xs">
                                                        <span class="glyphicon glyphicon-link"></span></button>
                                                </a>
                                                {{ $permission->name }}
                                            </th>
                                            @for ($i=0; $i < $roles->count(); $i++ )
                                            <td data-container="body" data-trigger="focus" data-toggle="popover" data-placement="left" data-content="Role: {{$roles[$i]->name}}, Permission: {{$permission->slug}}">
                                                <input <?php echo ($permissionroles->permissionrole($roles[$i]->id, $permission->id)) ? "checked" : "" ?><?php echo (in_array($roles[$i]->id, json_decode($permission->role_ids))) ? "" : "disabled" ?>  type="checkbox" name="permission_role[]" value="{{$roles[$i]->id.':'.$permission->id}}">
                                            </td>    
                                            @endfor
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <input type="submit" class="btn btn-success bt-sm">
                            </form>
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