
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
        <h3 class="card-title">{{ $title }}  {{$revenue->name}}</h3> 
            <a href="{{ UtilHelper::route('revenue-cost.create') }}" class="btn btn-outline-success btn-flat float-right">Create</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="dt" class="table table-bordered table-striped">
                <thead>
                    <tr>
                            <th>Date</th>
                            <th>Code  </th>
                            <th>Price  </th>
                            <th>Note</th>
                            <th>Referance Table</th>
                            <th>Action</th>
                    </tr>
                </thead>
               
                <tfoot>
                    <tr>
                            <th>Date</th>
                            <th>Code  </th>
                            <th>Price  </th>
                            <th>Note</th>
                            <th>Referance Table</th>
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
        var revenueId=$('#revenueId').val();
        $('#dt').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': "{{ route('revenue-cost-detail.data-table',['revenueId' => $revenue->id]) }}",
                "data": {
                    "_token": "{{ csrf_token() }}",
                },
            },
            'columns': [
                { data: 'date' },
                { data: 'price' },
                { data: 'type' },
                { data: 'note' },
                { data: 'reference_table' },
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