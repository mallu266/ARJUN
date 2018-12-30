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
                            <div class="row m_top_20">
                                <div class="col-md-3">
                                    <div class="panel">
                                        <div class="panel-body">
                                            <h5>
                                                <b class="themeColor pull-left"><i class="far fa-file-alt"></i> User Logs</b>
                                            </h5>
                                        </div>
                                        <div class="panel-body text-center">
                                            <i class="fas fa-user aclicon"></i>
                                            <a class="btn btn-success btn-block" href="{{url('admin/logs/users')}}">View</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="panel">
                                        <div class="panel-body">
                                            <h5>
                                                <b class="themeColor pull-left"><i class="far fa-file-alt"></i> Queue Logs</b>
                                            </h5>
                                        </div>
                                        <div class="panel-body text-center">
                                            <i class="fas fa-list aclicon"></i>

                                            <a class="btn btn-success btn-block"  href="{{url('admin/logs/queues')}}">View</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="panel">
                                        <div class="panel-body">
                                            <h5>
                                                <b class="themeColor pull-left"><i class="far fa-file-alt"></i> Error Logs</b>
                                            </h5>
                                        </div>
                                        <div class="panel-body text-center">
                                            <i class="fas fa-exclamation-triangle aclicon"></i>
                                            <a class="btn btn-success btn-block" href="{{url('admin/logs/errorlogs')}}">View</a>
                                        </div>
                                    </div>
                                </div>
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