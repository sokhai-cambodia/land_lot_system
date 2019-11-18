@extends('layouts.cms.template', compact('title'))

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                        <a href="{{ UtilHelper::route('land') }}" class="btn btn-outline-success btn-flat float-right">Land List</a>
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
                    <form role="form" action="{{ route('land.payment.create', ['landId' => $land->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="customer">Customer</label>
                                <select name="customer" id="customer" class="form-control select2">
                                    @foreach ($customers as $customer)
                                        @php 
                                            $sSelected = UtilHelper::hasValue(old('status'), "");
                                        @endphp
                                        <option value="{{ $customer->id }}" {{  UtilHelper::selected($customer->id, $sSelected) }}>{{ $customer->getFullName() }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="broker">Broker</label>
                                <select name="broker" id="broker" class="form-control select2">
                                    @foreach ($brokers as $broker)
                                        @php 
                                            $sSelected = UtilHelper::hasValue(old('status'), "");
                                        @endphp
                                        <option value="{{ $broker->id }}" {{  UtilHelper::selected($broker->id, $sSelected) }}>{{ $broker->getFullName() }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label for="witness1">Witness 1</label>
                                        <select name="witness1" id="witness1" class="form-control select2">
                                            @foreach ($witnesses as $witness)
                                                @php 
                                                    $sSelected = UtilHelper::hasValue(old('status'), "");
                                                @endphp
                                                <option value="{{ $witness->id }}" {{  UtilHelper::selected($witness->id, $sSelected) }}>{{ $witness->getFullName() }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label for="witness2">Witness 2</label>
                                        <select name="witness2" id="witness2" class="form-control select2">
                                            @foreach ($witnesses as $witness)
                                                @php 
                                                    $sSelected = UtilHelper::hasValue(old('status'), "");
                                                @endphp
                                                <option value="{{ $witness->id }}" {{  UtilHelper::selected($witness->id, $sSelected) }}>{{ $witness->getFullName() }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                        <!-- text input -->
                                    <div class="form-group">
                                        <label for="witness3">Witness 3</label>
                                        <select name="witness3" id="witness3" class="form-control select2">
                                            @foreach ($witnesses as $witness)
                                                @php 
                                                    $sSelected = UtilHelper::hasValue(old('status'), "");
                                                @endphp
                                                <option value="{{ $witness->id }}" {{  UtilHelper::selected($witness->id, $sSelected) }}>{{ $witness->getFullName() }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>     
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" min="0" step="0.01" name="price" id="price" placeholder="Enter price" value="{{ UtilHelper::hasValue(old('price'), $land->price) }}">
                            </div>
                        
                            <div class="form-group">
                                <label for="discount">Discount (%)</label>
                                <input type="number" class="form-control" min="0" max="100" step="0.01" name="discount" id="discount" placeholder="Enter discount" value="{{ UtilHelper::hasValue(old('discount'), 0) }}">
                            </div>
                        
                            {{-- <div class="form-group">
                                <label for="commission">Commission</label>
                                <input type="number" class="form-control" min="0" step="0.01" name="commission" id="commission" placeholder="Enter commission" value="{{ UtilHelper::hasValue(old('commission'), "") }}">
                            </div> --}}
                            <div class="form-group">
                                <label for="deposit">Sub Total</label>
                                <input type="number" class="form-control" min="0" step="0.01" name="subtotal" id="subtotal" placeholder="Enter subtotal" value="{{ UtilHelper::hasValue(old('subtotal'), 0) }}" readonly>
                            </div>
                        
                            <div class="form-group">
                                <label for="receive">Receive</label>
                                <input type="number" class="form-control" min="0" step="0.01" name="receive" id="receive" placeholder="Enter receive" value="{{ UtilHelper::hasValue(old('receive'), 0) }}">
                            </div>
                            <div class="form-group">
                                <label for="deposit">Return</label>
                                <input type="number" class="form-control" step="0.01" name="return" id="return"  value="{{ UtilHelper::hasValue(old('return'), 0) }}" readonly>
                            </div>
                                
                           
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
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
