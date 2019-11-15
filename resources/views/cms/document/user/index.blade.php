
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
        <a href="{{ UtilHelper::route('document.user.create', ['userId' => $user->id]) }}" class="btn btn-outline-success btn-flat float-right">Upload</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="dt" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Folder</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Extension</th>
                        <th>Size</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tfoot>
                    <tr>
                        <th>Folder</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Extension</th>
                        <th>Size</th>
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
                'url': "{{ route('document.user.data-table', ['userId' => $user->id]) }}",
                "data": {
                    "_token": "{{ csrf_token() }}",
                },
            },
            'columns': [
                { data: 'folder' },
                { data: 'name' },
                { data: 'description' },
                { data: 'extension' },
                { data: 'size' },
                { data: 'action' },
            ],
            "columnDefs": [
                { "orderable": false, "targets": 5 }
            ]
        });

    });
</script>
@include('layouts.message.delete-confirm')
@endsection