
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
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table id="dt" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Broker</th>
                        <th>Price</th>
                        <th>Deposit</th>
                        <th>Receive</th>
                        <th>Discount (%)</th>
                        <th>Comission</th>
                        <th>Payment Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tfoot>
                    <tr>
                        <th>Customer</th>
                        <th>Broker</th>
                        <th>Price</th>
                        <th>Deposit</th>
                        <th>Receive</th>
                        <th>Discount (%)</th>
                        <th>Comission</th>
                        <th>Payment Type</th>
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
                'url': "{{ route('land.payment.data-table') }}",
                "data": {
                    "_token": "{{ csrf_token() }}",
                },
            },
            'columns': [
                { data: 'customer_id' },
                { data: 'broker_id' },
                { data: 'price' },
                { data: 'deposit' },
                { data: 'receive' },
                { data: 'discount' },
                { data: 'comission' },
                { data: 'payment_type' },
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