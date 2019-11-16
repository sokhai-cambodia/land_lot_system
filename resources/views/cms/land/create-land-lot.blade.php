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
                    <p><small>Create Land</small></p>
                </div>
                <div class="stepwizard-step col-xs-4"> 
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p><small>Generate</small></p>
                </div>
                <div class="stepwizard-step col-xs-4"> 
                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                    <p><small>Verify Land Lot</small></p>
                </div>
               
            </div>
        </div>
        
       
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <form role="form" action="{{ route('land.lot.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- Create Land --}}
                    <div class="card card-primary setup-content" id="step-1">
                        <div class="card-header">
                            <h3 class="card-title">Create Land</h3>
                            <a href="{{ UtilHelper::route('land.lot') }}" class="btn btn-outline-success btn-flat float-right">Land Lot List</a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="name" class="form-control" name="title" id="title" placeholder="Enter title" value="{{ UtilHelper::hasValue(old('title'), "") }}">
                                </div>
                                <div class="form-group">
                                    <label for="width">Width (m)</label>
                                    <input type="number" class="form-control" minlength="0" step="0.01" name="width" id="width" placeholder="Enter width" value="{{ UtilHelper::hasValue(old('width'), "") }}">
                                </div>
                                <div class="form-group">
                                    <label for="height">Height (m)</label>
                                    <input type="number" class="form-control" minlength="0" step="0.01" name="height" id="height" placeholder="Enter height" value="{{ UtilHelper::hasValue(old('height'), "") }}">
                                </div>
                                <div class="form-group">
                                    <label for="size">Size (m2)</label>
                                    <input type="number" class="form-control" minlength="0" step="0.01" name="size" id="size" placeholder="Enter size" value="{{ UtilHelper::hasValue(old('size'), "") }}">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" minlength="0" step="0.01" class="form-control" name="price" id="price" placeholder="Enter price" value="{{ UtilHelper::hasValue(old('price'), "") }}">
                                </div>
                                <div class="form-group">
                                    <label for="commission">Commission (%)</label>
                                    <input type="number" class="form-control" minlength="0" max="100" step="0.01" name="commission" id="commission" placeholder="Enter commission" value="{{ UtilHelper::hasValue(old('commission'), "") }}">
                                </div> --}}
                                <div class="form-group row">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" class="form-control dropify">
                                    </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="5" placeholder="Enter description">{{ UtilHelper::hasValue(old('description'), "") }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <textarea class="form-control" name="location" id="location" rows="5" placeholder="Enter location">{{ UtilHelper::hasValue(old('location'), "") }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        @foreach ($status as $s)
                                            @php 
                                                $sSelected = UtilHelper::hasValue(old('status'), "");
                                            @endphp
                                            <option value="{{ $s }}" {{  UtilHelper::selected($s, $sSelected) }}>{{ $s }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary nextBtn pull-right">Create Land</button>
                            </div>
                        
                    </div>
                    {{-- Generate Land Lot --}}
                    <div class="card card-primary setup-content" id="step-2">
                        <div class="card-header">
                            <h3 class="card-title">Generate Land Lot</h3>
                            <a href="{{ UtilHelper::route('land.lot') }}" class="btn btn-outline-success btn-flat float-right">Land Lot List</a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="g_width">Width (m)</label>
                                    <input type="number" class="form-control" minlength="0" step="0.01" name="g_width" id="g_width" placeholder="Land width" value="{{ UtilHelper::hasValue(old('g_width'), 0) }}">
                                </div>
                                <div class="form-group">
                                    <label for="g_height">Height (m)</label>
                                    <input type="number" class="form-control" minlength="0" step="0.01" name="g_height" id="g_height" placeholder="Land height" value="{{ UtilHelper::hasValue(old('g_height'), 0) }}">
                                </div>
                                <div class="form-group">
                                    <label for="g_size">Size (m2)</label>
                                    <input type="number" class="form-control" minlength="0" step="0.01" name="g_size" id="g_size" placeholder="Land size" value="{{ UtilHelper::hasValue(old('g_size'), 0) }}">
                                </div>
                                <div class="form-group">
                                    <label for="g_price">Price</label>
                                    <input type="number" minlength="0" step="0.01" class="form-control" name="g_price" id="g_price" placeholder="Enter price" value="{{ UtilHelper::hasValue(old('g_price'), 0) }}">
                                </div>
                                <div class="form-group">
                                    <label for="g_commission">Commission (%)</label>
                                    <input type="number" class="form-control" minlength="0" max="100" step="0.01" name="g_commission" id="g_commission" placeholder="Enter commission" value="{{ UtilHelper::hasValue(old('g_commission'), 0) }}">
                                </div>
                                <div class="form-group">
                                    <label for="price">Generate Land Lot Qty</label>
                                    <input type="number" minlength="0" class="form-control" name="qty" id="qty" placeholder="Enter Land lot qty" value="{{ UtilHelper::hasValue(old('qty'), 0) }}">
                                </div>
                                
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button class="btn btn-primary nextBtn pull-right" type="button" data-code="generate">Generate</button>
                            </div>
                        
                    </div>
                    <div class="card card-primary setup-content" id="step-3">
                        <div class="card-header">
                            <h3 class="card-title">Verify Land Lot</h3>
                            <a href="{{ UtilHelper::route('land.lot') }}" class="btn btn-outline-success btn-flat float-right">Land Lot List</a>
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
                                        <th style="width: 20%">
                                            Title
                                        </th>
                                        <th style="width: 15%">
                                            Width (m)
                                        </th>
                                        <th style="width: 15%">
                                            Height (m)
                                        </th>
                                        <th style="width: 15%">
                                            Size (m2)
                                        </th>
                                        <th style="width: 15%">
                                            Price
                                        </th>
                                        <th style="width: 15%">
                                            Commission (%)
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tcontent">
                                   
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
        if( generateLandLot() == false ) return false;
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

function generateLandLot() {

    var width = $("#g_width").val();
    var height = $("#g_height").val();
    var size = $("#g_size").val();
    var price = $("#g_price").val();
    var commission = $("#g_commission").val();
    var qty = $("#qty").val();
    if(width == "" || height == "" || size == "" || price == "" || commission == "" || qty == "" ) {
        alert("please input data");
        return false;
    }
    var title = $("#title").val();
    var table = "";
    for(var i = 1; i <= qty; i++) {
        table += `<tr>
            <td>
                ${i}
            </td>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control" name="ll_titles[]" id="ll_title" placeholder="title" value="${title + " " + i}" />
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="number" class="form-control" minlength="0" step="0.01" name="ll_widths[]" id="ll_width" placeholder="width" value="${width}">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="number" class="form-control" minlength="0" step="0.01" name="ll_heights[]" id="ll_height" placeholder="height" value="${height}">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="number" class="form-control" minlength="0" step="0.01" name="ll_sizes[]" id="ll_size" placeholder="size" value="${size}">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="number" class="form-control" minlength="0" step="0.01" name="ll_prices[]" id="ll_price" placeholder="price" value="${price}">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="number" class="form-control" minlength="0" maxlength="100" name="ll_commissions[]" id="ll_commission" placeholder="commission" value="${commission}">
                </div>
            </td>
        </tr>`;
    }
    $("#tcontent").html(table);
    return true;
}
</script>
@endsection
