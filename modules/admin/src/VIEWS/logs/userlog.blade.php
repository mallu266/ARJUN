@extends('admin::layouts.app')
@section('content')
@php
switch ($activity->userType) {
case trans('LaravelLogger::laravel-logger.userTypes.registered'):
$userTypeClass = 'success';
break;

case trans('LaravelLogger::laravel-logger.userTypes.crawler'):
$userTypeClass = 'danger';
break;

case trans('LaravelLogger::laravel-logger.userTypes.guest'):
default:
$userTypeClass = 'warning';
break;
}

switch (strtolower($activity->methodType)) {
case 'get':
$methodClass = 'info';
break;

case 'post':
$methodClass = 'primary';
break;

case 'put':
$methodClass = 'caution';
break;

case 'delete':
$methodClass = 'danger';
break;

default:
$methodClass = 'info';
break;
}

$platform       = $userAgentDetails['platform'];
$browser        = $userAgentDetails['browser'];
$browserVersion = $userAgentDetails['version'];

switch ($platform) {

case 'Windows':
$platformIcon = 'fa-windows';
break;

case 'iPad':
$platformIcon = 'fa-';
break;

case 'iPhone':
$platformIcon = 'fa-';
break;

case 'Macintosh':
$platformIcon = 'fa-apple';
break;

case 'Android':
$platformIcon = 'fa-android';
break;

case 'BlackBerry':
$platformIcon = 'fa-';
break;

case 'Unix':
case 'Linux':
$platformIcon = 'fa-linux';
break;

default:
$platformIcon = 'fa-';
break;
}

switch ($browser) {

case 'Chrome':
$browserIcon  = 'fa-chrome';
break;

case 'Firefox':
$browserIcon  = 'fa-';
break;

case 'Opera':
$browserIcon  = 'fa-opera';
break;

case 'Safari':
$browserIcon  = 'fa-safari';
break;

case 'Internet Explorer':
$browserIcon  = 'fa-edge';
break;

default:
$browserIcon  = 'fa-';
break;
}
@endphp

<div id="wrapper">
    <div id="sidebar-wrapper">
        @include('admin::layouts.usersidebar')
    </div>
    <div id="page-content-wrapper">
        <div class="row">
            <div class="col-md-12 m_top_20">
                <div class="panel">
                    <div class="panel-body">
                        <h5>
                            <b class="themeColor pull-left"><i class="far fa-file-alt"></i> User Log</b>
                        </h5>
                    </div>
                    <div class="panel-body">
                        <div class="row ">
                            <div class="col-md-4 col-lg-4 m_top_20">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">IP Details</div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-border">
                                                <tbody>
                                                    @if($ipAddressDetails)
                                                    @foreach($ipAddressDetails as $ipAddressDetailKey => $ipAddressDetailValue)
                                                    <tr>
                                                        <th>{{$ipAddressDetailKey}}</th>
                                                        <td>{{$ipAddressDetailValue}}</td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-8 m_top_20">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">Activity Details</div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-border">
                                                        <tbody>
                                                            <tr>
                                                                <th>Description</th>
                                                                <td>{{$activity->description}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Route</th>
                                                                <td> 
                                                                    <a href="@if($activity->route != '/')/@endif{{$activity->route}}">
                                                                        {{$activity->route}}
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>User Agent</th>
                                                                <td>
                                                                    <i class="fa {{ $platformIcon }} fa-fw" aria-hidden="true">
                                                                        <span class="sr-only">
                                                                            {{ $platform }}
                                                                        </span>
                                                                    </i>
                                                                    <i class="fa {{ $browserIcon }} fa-fw" aria-hidden="true">
                                                                        <span class="sr-only">
                                                                            {{ $browser }}
                                                                        </span>
                                                                    </i>
                                                                    <sup>
                                                                        <small>
                                                                            {{ $browserVersion }}
                                                                        </small>
                                                                    </sup>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Referer</th>
                                                                <td>
                                                                    <a href="{{ $activity->referer }}">
                                                                        {{ $activity->referer }}
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Time Passed</th>
                                                                <td>{{$timePassed}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Method</th>
                                                                <td>
                                                                    <span class="label label-{{$methodClass}}">
                                                                        {{ $activity->methodType }}
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Created</th>
                                                                <td>{{$activity->created_at}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">User Details</div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-border">
                                                        <tbody>
                                                            <tr>
                                                                <th>User Type</th>
                                                                <td>{{@$activity->userType}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Name</th>
                                                                <td> 
                                                                    {{@$userDetails->name}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Guard</th>
                                                                <td> 
                                                                    {{@$guard}}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Email</th>
                                                                <td>
                                                                    {{@$userDetails->email}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Created</th>
                                                                <td>{{@$userDetails->created_at}}</td>
                                                            </tr>
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
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('footer')
@endsection