@extends('layouts.cms.template', compact('title'))

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                        <a href="{{ UtilHelper::route('land.payment') }}" class="btn btn-outline-success btn-flat float-right">Payment List</a>
                    </div>
                    <div class="col-md-12" style="margin-top: 20px">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th style="width: 5%">
                                        #
                                    </th>
                                    <th style="width: 20%">
                                        Image
                                    </th>
                                    <th style="width: 30%">
                                        Name
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <img src="{{ $land->getPhoto() }}" style="width: 100px; height: 100px"/>
                                    </td>
                                    <td>
                                        {{ $land->title }}
                                    </td>
                                    <td>
                                        Width(m): {{ $land->width }} <br>
                                        Height(m): {{ $land->height }} <br>
                                        Size(m2): {{ $land->size }} <br>
                                    </td>
                                        
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th style="width: 5%">
                                        #
                                    </th>
                                    <th style="width: 30%">
                                        Installment Date
                                    </th>
                                    <th style="width: 30%">
                                        Price ($)
                                    </th>
                                    <th style="width: 10%">
                                        Type
                                    </th>
                                    <th style="width: 10%">
                                        Status
                                    </th>
                                    <th style="width: 15%">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tcontent">
                                @php $no = 1 @endphp
                                @foreach ($installments as $ism)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $ism->installment_date }}</td>
                                        <td>{{ $ism->price }}</td>
                                        <td>{{ $ism->type }}</td>
                                        <td>
                                            <span class="badge {{ $ism->status == 'paid' ? 'badge-success' : 'badge-danger' }}">{{ ucfirst($ism->status) }}</span>
                                        </td>
                                        <td>
                                            @if($ism->status == 'unpaid')
                                                <button class="btn btn-info btn-sm btn-pay" data-url="{{ route('land.installment-payment.pay', ['id' => $ism->id]) }}" data-price="{{ $ism->price }}">
                                                    Pay
                                                </button>
                                            @else
                                                <button class="btn btn-success btn-sm btn-detail" data-id="{{ $ism->id }}">
                                                    Detail
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>        
                </div>
            </div>
        </div>
    </div>
    {{-- Installment Pay Modal --}}
    <div class="modal fade" id="modal-pay">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Installment Form</h4>
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
                        <div class="form-group">
                            <label for="note">Note</label>
                            <textarea class="form-control" name="note" id="note" placeholder="Enter note" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Pay</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    {{-- Installment Detail Modal --}}
    <div class="modal fade" id="modal-detail">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Installment Detail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="d_installment_date">Installment Date</label>
                                <input type="text" class="form-control"  name="d_installment_date" id="d_installment_date" value="" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="d_price">Price</label>
                                <input type="number" class="form-control" min="0" step="0.01" name="d_price" id="d_price" value="" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="d_paid_date">Paid Date</label>
                                <input type="text" class="form-control" name="d_paid_date" id="d_paid_date" value="" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="d_receive">Receive</label>
                                <input type="number" class="form-control" min="0" step="0.01" name="d_receive" id="d_receive" value="" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="d_receiver">Recive By</label>
                        <input type="text" class="form-control" name="d_receiver" id="d_receiver" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="d_type">Installment Type</label>
                        <input type="text" class="form-control" name="d_type" id="d_type" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="d_note">Note</label>
                        <textarea class="form-control" name="d_note" id="d_note" rows="5" readonly></textarea>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
</section>
<!-- /.content -->

@endsection

@section('footer')
<script>
    $(function () {
        
        $("#receive").keyup(function(){
            calculate();
        });

        function calculate() {
            var price = $("#price").val();
            var receive = $("#receive").val();
            var return_money = receive - price;

            $("#return").val(return_money);
        }

        $(".btn-pay").click(function() {
            var url = $(this).attr('data-url');
            var price = $(this).attr('data-price');
            $("#form").attr('action', url);
            $("#price").val(price);

            calculate();
            $('#modal-pay').modal('toggle');
        });

        $(".btn-detail").click(function() {
            var id = $(this).attr('data-id');
            $.ajax({
                type:'POST',
                url:"{{ route('land.installment-payment.detail') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success:function(data) {
                    if(data.status == 1) {
                        $("#d_installment_date").val(data.installment.installment_date);
                        $("#d_price").val(data.installment.price);
                        $("#d_paid_date").val(data.installment.paid_date);
                        $("#d_receive").val(data.installment.receive);
                        $("#d_receiver").val(data.receiver);
                        $("#d_type").val(data.installment.type);
                        $("#d_note").val(data.installment.note);
                        $('#modal-detail').modal('toggle');
                    }
                }
            }); 
            
        });
    });
</script>
@endsection
