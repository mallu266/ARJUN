@extends('admin::layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('admin::layouts.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    function installpackage(e) {
        $base_url = $('#base_url').attr('content');
        $package = e.getAttribute('data-value');
        swal({
            title: "Installing Package",
            text: "Are you sure you want to install this package?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: $base_url + "/installpackage",
                    type: "GET",
                    data: {'package': $package},
                    beforeSend: function () {
                        swal({
                            title: "Installing Package",
                            text: "Please wait we are installing package",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        });
                    },
                    success: function (data) {
                        if (data.status == 'success') {
                            swal({
                                title: "Installing Package",
                                text: "Package installed successfully",
                                icon: "success",
                                dangerMode: true,
                            });
                        } else {
                            swal({
                                title: "Installing Package",
                                text: "Something went wrong",
                                icon: "warning",
                                dangerMode: true,
                            });
                        }


                    },
                });
            } else {
                swal("You cancelled");
            }
        });
    }




</script>
@endsection