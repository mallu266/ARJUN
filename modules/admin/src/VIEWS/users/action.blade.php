@extends('admin::layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('admin::layouts.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ucfirst(request()->segment(3))}} User  <a href="{{ url('admin/users', []) }}">List</a></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <form class="form-horizontal" id="user_reg_form" method="POST" action="{{ url('admin/users/action', @request()->segment(4)) }}">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="role">Role:</label>
                                    <div class="col-sm-10">
                                        <?php
                                        $role_ids = array();
                                        if (@$users->id) {
                                            $role_ids = json_decode($users->hasroleids($users->id));
                                        }
                                        ?>
                                        @foreach ($roles as $role)
                                        <input data-role-id={{ @$role->id }} <?php echo (@in_array(@$role->id, @$role_ids)) ? 'checked' : NULL ?> type="checkbox" value="{{ @$role->id}}" name="roles[]">{{ @$role->name}}
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="name">Name:</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" value="{{ @$users->name }}" class="form-control alphanumeric" id="name" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Email:</label>
                                    <div class="col-sm-10">
                                        <input type="email" <?php echo (@$users->email) ? 'disabled' : NULL ?> value="{{ @$users->email }}" name="email" class="form-control" id="email" placeholder="Enter email">
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-default">Submit</button>
                                    </div>
                                </div>
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
<script src="{{asset('js/users.js')}}"></script>
@endsection