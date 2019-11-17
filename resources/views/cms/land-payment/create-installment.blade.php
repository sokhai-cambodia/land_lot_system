@extends('layouts.cms.template', compact('title'))

@section('header')
<style>
.stepwizard-step p {
    margin-top: 0px;
    color:#666;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}
.stepwizard-step button[disabled] {
    /*opacity: 1 !important;
    filter: alpha(opacity=100) !important;*/
}
.stepwizard .btn.disabled, .stepwizard .btn[disabled], .stepwizard fieldset[disabled] .btn {
    opacity:1 !important;
    color:#bbb;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content:" ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-index: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}
</style>
@endsection

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step col-xs-4"> 
                    <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                    <p><small>Create Payment</small></p>
                </div>
                <div class="stepwizard-step col-xs-4"> 
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p><small>Generate Installment</small></p>
                </div>
                <div class="stepwizard-step col-xs-4"> 
                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                    <p><small>Verify Installment</small></p>
                </div>
               
            </div>
        </div>
        
       
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <form role="form" action="{{ route('land.lot.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- Create Payment --}}
                    <div class="card card-primary setup-content" id="step-1">
                        <div class="card-header">
                            <h3 class="card-title">Create Payment</h3>
                            <a href="{{ UtilHelper::route('land.lot') }}" class="btn btn-outline-success btn-flat float-right">Land Lot List</a>
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
                                <input type="number" class="form-control" min="0" step="0.01" name="receive" id="receive" placeholder="Enter receive" value="{{ UtilHelper::hasValue(old('receive'), "") }}">
                            </div>
                            <div class="form-group">
                                <label for="deposit">Return</label>
                                <input type="number" class="form-control" min="0" step="0.01" name="subtotal" id="subtotal" placeholder="Enter subtotal" value="{{ UtilHelper::hasValue(old('subtotal'), 0) }}" readonly>
                            </div>
                                
                           
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary nextBtn pull-right">Create Payment</button>
                        </div>
                        
                    </div>
                    {{-- Generate Installment --}}
                    <div class="card card-primary setup-content" id="step-2">
                        <div class="card-header">
                            <h3 class="card-title">Generate Installment</h3>
                            <a href="{{ UtilHelper::route('land.lot') }}" class="btn btn-outline-success btn-flat float-right">Land Lot List</a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="installment_type">Installment Type</label>
                                    <select name="installment_type" id="installment_type" class="form-control">
                                        @foreach ($installmentType as $s)
                                            @php 
                                                $sSelected = UtilHelper::hasValue(old('installment_type'), "");
                                            @endphp
                                            <option value="{{ $s }}" {{  UtilHelper::selected($s, $sSelected) }}>{{ ucfirst($s) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="duration">Duration</label>
                                    <input type="number" minlength="0" class="form-control" name="duration" id="duration" placeholder="Enter installment duration" value="{{ UtilHelper::hasValue(old('duration'), 0) }}">
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Duration</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Enter start date">
                                </div>
                                
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button class="btn btn-primary nextBtn pull-right" type="button" data-code="generate">Generate</button>
                            </div>
                        
                    </div>
                    {{-- Verify Installment --}}
                    <div class="card card-primary setup-content" id="step-3">
                        <div class="card-header">
                            <h3 class="card-title">Verify Installment</h3>
                            <a href="{{ UtilHelper::route('land.lot') }}" class="btn btn-outline-success btn-flat float-right">Land Lot List</a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body p-0">
                            <table class="table table-striped projects">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">
                                            #
                                        </th>
                                        <th style="width: 45%">
                                            Installment Date
                                        </th>
                                        <th style="width: 45%">
                                            Price
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tcontent">
                                    {{-- <tr>
                                        <td>1</td>
                                        <td>
                                            <input type="date" class="form-control" name="installment_date[]" id="installment_date" placeholder="Enter installment date">
                                        </td>
                                        <td>
                                            <input type="number" minlength="0" class="form-control" name="installment_price[]" id="installment_price" placeholder="Enter installment price">
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Create</button>
                        </div>
                        
                    </div>
                <!-- /.card -->
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

@endsection

@section('footer')
<script>
$(document).ready(function () {
$('.dropify').dropify();


var navListItems = $('div.setup-panel div a'),
    allWells = $('.setup-content'),
    allNextBtn = $('.nextBtn');

allWells.hide();

navListItems.click(function (e) {
    
    e.preventDefault();
    var $target = $($(this).attr('href')),
        $item = $(this);

    if (!$item.hasClass('disabled')) {
        navListItems.removeClass('btn-success').addClass('btn-default');
        $item.addClass('btn-success');
        allWells.hide();
        $target.show();
        $target.find('input:eq(0)').focus();
    }
});

allNextBtn.click(function () {
    var code = $(this).attr('data-code');
    if(code == "generate") {
        var price = $("#price").val();
        var discount = $("#discount").val();
        var duration = $("#duration").val();
        var installment_type = $("#installment_type").val();
        var start_date = $("#start_date").val();

        // var msg = `
        //     price: ${price}
        //     discount: ${discount}
        //     duration: ${duration}
        //     installment_type: ${installment_type}
        //     start_date: ${start_date}
        // `;
        $.ajax({
            type:'POST',
            url:"{{ route('land.installment-payment.generate') }}",
            data: {
                _token: "{{ csrf_token() }}",
                price: price,
                discount: discount,
                duration: duration,
                installment_type: installment_type,
                start_date: start_date
            },
            success:function(data) {
                if(data.status == 1) {
                    $('#tcontent').html(data.data);
                }
            }
        }); 
    }
    var curStep = $(this).closest(".setup-content"),
        curStepBtn = curStep.attr("id"),
        nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
        curInputs = curStep.find("input[type='text'],input[type='url']"),
        isValid = true;

    $(".form-group").removeClass("has-error");
    for (var i = 0; i < curInputs.length; i++) {
        if (!curInputs[i].validity.valid) {
            isValid = false;
            $(curInputs[i]).closest(".form-group").addClass("has-error");
        }
    }

    if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
});

$('div.setup-panel div a.btn-success').trigger('click');
});


</script>
@endsection
