
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
            <a href="{{ UtilHelper::route('land.create') }}" class="btn btn-outline-success btn-flat float-right">Create</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="dt" class="table table-bordered table-striped">
                <thead>
                    <tr>
                            <th>Title</th>
                            {{-- <th>Description</th> --}}
                            <th>Size  <span style="color:red">(m<sup>2</sup>)</span></th>
                            <th>Width  <span style="color:red">(m)</span></th>
                            <th>Heigth <span style="color:red">(m)</span></th>
                            <th>Price <span style="color:red">($)</span></th>
                            <th>Comission <span style="color:red">(%)</span></th>
                            <th>Status</th>
                            <th>Action</th>
                    </tr>
                </thead>
               
                <tfoot>
                    <tr>
                            <th>Title</th>
                            {{-- <th>Description</th> --}}
                            <th>Size  <span style="color:red">(m<sup>2</sup>)</span></th>
                            <th>Width  <span style="color:red">(m)</span></th>
                            <th>Heigth <span style="color:red">(m)</span></th>
                            <th>Price <span style="color:red">($)</span></th>
                            <th>Comission<span style="color:red">(%)</span></th>
                            <th>Status</th>
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
                'url': "{{ route('land.data-table') }}",
                "data": {
                    "_token": "{{ csrf_token() }}",
                },
            },
            'columns': [
                { data: 'title' },
                // { data: 'description' },
                { data: 'size' },
                { data: 'width' },
                { data: 'height' },
                { data: 'price' },
                { data: 'commission' },
                { data: 'status' },
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