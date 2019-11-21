@extends('layouts.admin.print-template')

@section('content')
<div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row">
        <div class="col-12">
            <h4 class="text-center">
                ព្រះរាជាណាចក្រកម្ពុជា
            </h4>
            <h4 class="text-center">
                ជាតិសាសនា ព្រះមហាក្សត្រ
            </h4>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info" style="margin-top: 50px">
        <div class="col-sm-12 invoice-col">
            <p class="text-center">លិខិតប្រគល់ប្លង់ដី និងបង់ប្រាក់បង្រ្គប់</p>
        </div>
        <div class="col-sm-12 invoice-col">
            <p>- {{$customer->getFullName()}}	បានទទួលប្លង់ដីដែលមានលេខឡូតិ៍ {{ $land->title }} តម្លៃសរុបចំនួន USD {{ $payment->priceAfterDiscount() }} ។</p>
            <p>- បានកក់ប្រាក់នៅថ្ងៃទី {{ DateHelper::toKhmerDate($payment->deposit_at) }} ចំនួន USD{{ $payment->deposit }}</p>
            <p>- បានបង់ប្រាក់បង្គ្រប់នៅថ្ងៃទី {{ DateHelper::toKhmerDate($payment->receive_at) }} ចំនួន USD{{ $payment->receive }}។</p>
            <p class="text-right">ធ្វើនៅថ្ងៃទី{{ DateHelper::toKhmerDate($payment->receive_at) }}</p>
        </div>
        <div class="col-sm-4 invoice-col">
            <p class="text-center"><b>សាក្សី</b></p>
            <p class="text-center" style="margin-top: 75px"><b>{{ $witness->getFullName() }}</b></p>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <p class="text-center"><b>អ្នកប្រគល់ប្រាក់និងទទួលប្លង់ដី</b></p>
            <p class="text-center" style="margin-top: 75px"><b>{{ $customer->getFullName() }}</b></p>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <p class="text-center"><b>អ្នកទទួលប្រាក់និងប្រគល់ប្លង់ដី</b></p>
            <p class="text-center" style="margin-top: 75px"><b>{{ $saler->getFullName() }}</b></p>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- /.row -->
    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-12">
            <button class="btn btn-default float-right" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
        </div>
    </div>
</div>
@endsection