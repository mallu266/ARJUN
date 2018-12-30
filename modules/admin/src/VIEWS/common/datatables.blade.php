<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap.min.css" />
<script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script>
    $base_url = $('#base_url').attr('content');
    $tab = $('#segment').attr('content');
    $model = $('#tabmodel').attr('content');
    $primarykey = $('#primarykey').attr('content');
    $(document).ready(function () {
        getdynamicdata();
    });
    function getdynamicdata() {
        var table = $('.' + $tab).DataTable({
            processing: true,
            serverSide: true,
            rowReorder: true,
            ajax: $base_url + "/" + $model + "/" + $tab + '/datatable',
            columns: [
                {data: 'methodType', name: 'methodType'},
                {data: 'description', name: 'description'},
                {data: 'userType', name: 'userType'},
                {data: 'userId', name: 'userId'},
                {data: 'route', name: 'route'},
                {data: 'ipAddress', name: 'ipAddress'},
                {data: 'referer', name: 'referer'},
                {data: 'created_at', name: 'created_at'},
                {data: 'id', name: 'id'}
            ]
        });
    }

    function getparameters() {
        $search_min = parent.$('#search_min').val();
        $search_max = parent.$('#search_max').val();
        $datepicker_from = parent.$('#datepicker_from').val();
        $datepicker_to = parent.$('#datepicker_to').val();
        $vendorselect = parent.$('#vendorselect').val();
        var requests = {'search_min': $search_min, 'search_max': $search_max, 'datepicker_from': $datepicker_from, 'datepicker_to': $datepicker_to};
        return requests;
    }
    $("#searchdata").click(function () {
        $('.' + $tab).DataTable().destroy();
        getdynamicdata();
    });
</script>