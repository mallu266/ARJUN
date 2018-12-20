@extends('admin::layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('admin::layouts.sidebar')
        </div>
        <div class="col-md-9">
            <?php
            $id = request()->segment(4);
            ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Add Permission <a class="btn btn-primary btn-sm pull-right" href="{{url('admin/acl/permissions')}}">New</a></div>
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="{{url('admin/acl/permission/post')}}">
                                {{csrf_field()}}
                                <input type="hidden" name="id" value="{{@$id}}">
                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="name">Name:</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="name" value="{{@$permission->name}}" class="form-control" id="name" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="slug">Slug:</label>
                                    <div class="col-sm-12"> 
                                        <input type="text" name="slug" value="{{@$permission->slug}}" class="form-control" id="slug" placeholder="Enter Slug">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="role">Role:</label>
                                    <div class="col-sm-12">
                                        @foreach($roles as $field)
                                        <input type="checkbox" {{(@$permission->slug==$field->id)?"checked":""}} name="role_ids[]" value="{{$field->id}}">{{$field->name}}
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="description">Description:</label>
                                    <div class="col-sm-12"> 
                                        <textarea class="form-control" name="description">{{@$permission->description}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group"> 
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-default btn-block">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">List</div>
                        <div class="card-body">
                            <div class="row">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Desc</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(@$permissions as $permission)
                                        <tr>
                                            <td>{{$permission->name}}</td>
                                            <td>{{$permission->slug}}</td>
                                            <td><a href="{{url('admin/acl/permissions/'.$permission->id)}}">Edit</a></td>
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
</div>
@endsection
@section('script')

@endsection