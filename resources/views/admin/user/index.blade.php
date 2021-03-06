
@extends('layouts.admin.template', compact('title'))

@section('header')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('cms/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <a href="{{ UtilHelper::route('user.create', [ 'role' => $role ]) }}" class="btn btn-outline-success btn-flat float-right">Create</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="dt" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>National Id</th>
                        <th>Passport id</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>National Id</th>
                        <th>Passport id</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <!-- /.modal -->
    <div class="modal fade" id="view-info">
        <div class="modal-dialog modal-lg" id="view-content">
            
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</section>
<!-- /.content -->
@endsection

@section('footer')
<!-- DataTables -->
<script src="{{ asset('cms/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('cms/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<!-- page script -->
<script>
    $(function () {
        // Datatable
        $('#dt').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': "{{ route('user.data-table') }}",
                "data": {
                    "_token": "{{ csrf_token() }}",
                    "role": "{{ $role }}"
                },
            },
            'columns': [
                { data: 'name' },
                { data: 'phone' },
                { data: 'national_id' },
                { data: 'passport_id' },
                { data: 'status' },
                { data: 'action' },
            ],
            "columnDefs": [
                { "orderable": false, "targets": 5 }
            ]
        });

        // open modal
        $("body").on('click', '.btn-view-detail', function(){
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{ route('user.detail') }}",
                method: 'post',
                dataType : 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: function(result){
                    if(result.status == 1) {
                        $("#view-content").html(result.modal);
                        $('#view-info').modal('toggle');
                    } else {
                        alert('no data');
                    }
                    
                    
                }
            })
        });
    });
</script>
@include('layouts.message.delete-confirm')
@endsection