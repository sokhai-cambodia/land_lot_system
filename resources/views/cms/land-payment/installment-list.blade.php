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
                                        Price
                                    </th>
                                    <th style="width: 10%">
                                        Price
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
                                                <a class="btn btn-info btn-sm" href="#">
                                                    Pay
                                                </a>
                                            @else
                                                <a class="btn btn-success btn-sm" href="#">
                                                    Detail
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

@endsection

@section('footer')
<!-- Select2 -->
<script src="{{ asset('cms/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
        
        calculate();

        $("#price").keyup(function(){
            calculate();
        });

        $("#discount").keyup(function(){
            calculate();
        });

        $("#receive").keyup(function(){
            calculate();
        });

        function calculate() {
            var price = $("#price").val();
            var discount = $("#discount").val();
            var receive = $("#receive").val();

            var subtotal = price - (discount * price / 100);
            var return_money = receive - subtotal;

            $("#subtotal").val(subtotal);
            $("#return").val(return_money);
        }
    });
</script>
@endsection
