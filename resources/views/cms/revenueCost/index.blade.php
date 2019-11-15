
@extends('layouts.cms.template', compact('title'))

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
            <a href="{{ UtilHelper::route('revenue-cost.create') }}" class="btn btn-outline-success btn-flat float-right">Create</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="dt" class="table table-bordered table-striped">
                <thead>
                    <tr>
                            <th>Name</th>
                            {{-- <th>Description</th> --}}
                            <th>Code  </th>
                            <th>Type  </th>
                          
                            <th>Action</th>
                    </tr>
                </thead>
               
                <tfoot>
                    <tr>
                            <th>Name</th>
                            {{-- <th>Description</th> --}}
                            <th>Code  </th>
                            <th>Type </th>
                          
                            <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
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
        $('#dt').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': "{{ route('revenue-cost.data-table') }}",
                "data": {
                    "_token": "{{ csrf_token() }}",
                },
            },
            'columns': [
                { data: 'name' },
                { data: 'code' },
                { data: 'type' },
                { data: 'action' },
            ],
            "columnDefs": [
                { "orderable": false, "targets": 3 }
            ]
        });
    });
    
</script>
@include('layouts.message.delete-confirm')
@endsection