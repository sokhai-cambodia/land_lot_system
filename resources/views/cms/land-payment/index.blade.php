
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
    {{-- Pay Modal --}}
    <div class="modal fade" id="modal-pay">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Payment Form</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form" role="form" action="" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" min="0" step="0.01" name="price" id="price" placeholder="Enter price" value="" readonly>
                        </div>
                        <div class="form-group">
                            <label for="receive">Receive</label>
                            <input type="number" class="form-control" min="0" step="0.01" name="receive" id="receive" placeholder="Enter receive" value="0">
                        </div>
                        <div class="form-group">
                            <label for="return">Return</label>
                            <input type="number" class="form-control" step="0.01" name="return" id="return" placeholder="Enter return" value="0" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Pay</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    {{-- View Invoice --}}
    <div class="modal fade" id="modal-invoice">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" id="modal-invoice-content">
                <!-- Main content -->
                <!-- /.invoice -->
            </div>
            <!-- /.modal-content -->
        </div>
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

        $("body").on("click", ".btn-view-invoice", function() {
            var url = $(this).attr('data-url');

            $.ajax({
                type:'POST',
                url: url,
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success:function(data) {
                    if(data.status == 1) {
                        $('#modal-invoice-content').html(data.data);
                        $('#modal-invoice').modal('toggle');
                    } else {
                        alert('error');
                    }
                }
            }); 
            
        });

        $("body").on("click", ".btn-pay", function() {
            var url = $(this).attr('data-url');
            var price = $(this).attr('data-price');
            $("#form").attr('action', url);
            $("#price").val(price);

            calculate();
            $('#modal-pay').modal('toggle');
        });

        $("#receive").keyup(function(){
            calculate();
        });

        function calculate() {
            var price = $("#price").val();
            var receive = $("#receive").val();
            var return_money = receive - price;

            $("#return").val(return_money);
        }

        
    });
</script>
@include('layouts.message.delete-confirm')
@endsection