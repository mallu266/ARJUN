@extends('admin::layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('admin::layouts.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ucfirst(request()->segment(3))}}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-border">
                                    <thead>
                                        <tr>
                                            <th>Context</th>
                                            <th>Level</th>
                                            <th>Level Class</th>
                                            <th>level_img</th>
                                            <th>date</th>
                                            <th>IP Address</th>
                                            <th>text</th>
                                            <th>in_file</th>
                                            <!--<th>stack</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($i = 0; $i < count($logs); $i++) {
                                            ?>
                                            <tr>
                                                <td>{{@$logs[$i]['context']}}</td>
                                                <td>{{@$logs[$i]['level']}}</td>
                                                <td>{{@$logs[$i]['level_class']}}</td>
                                                <td>{{@$logs[$i]['level_img']}}</td>
                                                <td>{{@$logs[$i]['date']}}</td>
                                                <td>{{@$logs[$i]['text']}}</td>
                                                <td>{{@$logs[$i]['in_file']}}</td>
                                                <!--<td>{{@$logs[$i]['stack']}}</td>-->
                                            </tr>
                                            <?php
                                        }
                                        ?>
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