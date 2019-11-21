@extends('layouts.cms.print-template')

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
    <div class="row invoice-info"  style="margin-top: 50px">
        <div class="col-sm-12 invoice-col">
            <p class="text-center">
                របាយការណ៍ប្រចាំថ្ងៃផ្នែកគណនេយ្យករ
            </p>
        </div>
    </div>
    <!-- /.row -->
    <!-- Table row -->
    <div class="row">
        {{-- <p>ក-ចំណូលអតិថិជនទិញដីឡូតិ៍</p> --}}
        <div class="col-12 table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ល.រ</th>
                        <th>ថ្ងៃ.ទី.ខែ.ឆ្នាំ</th>
                        <th>ឈ្នោះអតិថិជន</th>
                        <th>លេខឡូតិ៍</th>
                        <th>ចំនួនឡូតិ៍</th>
                        <th>កក់ប្រាក់</th>
                        <th>តម្លៃសរុប</th>
                        <th>ប្រាក់បង្គ្រាប់</th>
                        <th>នៅខ្វះចំនួន</th>
                        <th>លេខទូរស័ព្ទ</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1 @endphp
                    @foreach($reports as $report)
                        @php 
                            $price_after_discount = $report->price - ($report->price * $report->discount / 100);
                            $remain_price = $report->price - $price_after_discount;
                        @endphp
                        <tr>
                            <th>{{ $no++ }}</th>
                            <th>{{ date('d-m-Y', strtotime($report->created_at)) }}</th>
                            <th>{{ $report->customer_name }}</th>
                            <th>{{ $report->title }}</th>
                            <th>1</th>
                            <th>{{ $report->deposit }}</th>
                            <th>{{ $price_after_discount  }}</th>
                            <th>{{ $report->receive }}</th>
                            <th>{{ $remain_price }}</th>
                            <th>{{ $report->phone }}</th>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <!-- /.col -->
        <div class="col-6">
        </div>
        <div class="col-md-6">
            <p class="text-center">ធ្វើនៅ{{ DateHelper::toKhmerFullDate($date) }}</p>
        </div>
    </div>
    <div class="row">
            <!-- accepted payments column -->
        <div class="col-6">
            <p class="text-center">បានត្រួតពិនិត្យ</p>
            <p class="text-center" style="margin-top: 75px">ឈ្មោះទី១</p>
        </div>
        <!-- /.col -->
        <div class="col-6">
            <p class="text-center">ហត្ថលេខា</p>
            <p class="text-center" style="margin-top: 75px">ឈ្មោះទី២</p>
        </div>
    </div>
    <!-- /.row -->
    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-12">
            <button onclick="window.print()" class="btn btn-default float-right"><i class="fas fa-print"></i> Print</button>
        </div>
    </div>
</div>
                <!-- /.invoice -->
            
<!-- /.content -->
@endsection

@section('footer')
<script>
    $('.dropify').dropify();
</script>
@endsection
