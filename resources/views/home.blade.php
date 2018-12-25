@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <?php
                    $user = auth('web')->user();
//        $user->notify((new USERREGISTRATION($user))->delay($when));
                    foreach ($user->notifications as $notification) {
                        echo '<br>' . $notification->type;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
