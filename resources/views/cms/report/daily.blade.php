@extends('layouts.cms.template', compact('title'))

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Main content -->
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
                    @php 
                        $landRevenues = 0;
                        $commissionCost = 0;
                        $revenues = 0;
                        $costs = 0;
                    @endphp
                    <div class="row">
                        <p>ក-ចំណូលអតិថិជនទិញដីឡូតិ៍</p>
                        <div class="col-12 table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ឈ្មោះអតិថិជន</th>
                                        <th>លេខឡូតិ៍</th>
                                        <th>តម្លៃ</th>
                                        <th>បញ្ចុះតម្លៃ(%)</th>
                                        <th>តម្លៃសរុប</th>
                                        <th>លុយកក់</th>
                                        <th>ប្រាក់បង្គ្រាប់</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($reports as $report)
                                        @php 
                                            $landRevenues += $report->deposit + $report->receive;
                                        @endphp
                                        <tr>
                                            <th>#</th>
                                            <th>{{ $report->customer_name }}</th>
                                            <th>{{ $report->land_title }}</th>
                                            <th>{{ $report->price }}</th>
                                            <th>{{ $report->discount }}</th>
                                            <th>{{ $report->price - ($report->price * $report->discount / 100) }}</th>
                                            <th>{{ $report->deposit }}</th>
                                            <th>{{ $report->receive }}</th>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                        <p>ខ-កម្រៃជើងសារ</p>
                        <div class="col-12 table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ឈ្មោះអតិថិជន</th>
                                        <th>លេខឡូតិ៍</th>
                                        <th>តម្លៃសរុប</th>
                                        <th>កម្រៃជើងសារ(%)</th>
                                        <th>កម្រៃជើងសារ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reports as $report)
                                        @php 
                                            $commissionCost += $report->commission;
                                        @endphp
                                        <tr>
                                            <th>#</th>
                                            <th>{{ $report->broker_name }}</th>
                                            <th>{{ $report->land_title }}</th>
                                            <th>{{ $report->price }}</th>
                                            <th>{{ $report->commission_percent }}</th>
                                            <th>{{ $report->commission }}</th>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                        <p>គ-ចំណូល/ចំណាស់ផ្សេងៗ</p>
                        <div class="col-12 table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ឈ្មោះ</th>
                                        <th>ប្រភេទ</th>
                                        <th>ចំណូល/ចំណាយ</th>
                                        <th>កំណត់សំគាល់</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($revCosts as $revCost)
                                        @php 
                                            $price = 0;
                                            if($revCost->category_type == "cost") {
                                                $price = $revCost->price * -1;
                                                $costs += $revCost->price;
                                            } else {
                                                $price = $revCost->price;
                                                $revenues = $revCost->price;
                                            }
                                        @endphp
                                        <tr>
                                            <th>#</th>
                                            <th>{{ $revCost->category_name }}</th>
                                            <th>{{ $revCost->category_type }}</th>
                                            <th>{{ $price }}</th>
                                            <th>{{ $revCost->note }}</th>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-6">
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <p class="lead">របាយការណ៍សង្ខេប</p>
                            <div class="table-responsive">
                                <table class="table">
                                    @php 
                                        $total = ($landRevenues + $revenues) - ($commissionCost + $costs);
                                    @endphp
                                    <tr>
                                        <th style="width:50%">ចំណូលពីដី</th>
                                        <td>${{ $landRevenues }}</td>
                                    </tr>
                                    <tr>
                                        <th>កម្រៃជើងសារ</th>
                                        <td>${{ $commissionCost  }}</td>
                                    </tr>
                                    <tr>
                                        <th>ចំណូលផ្សេងៗ:</th>
                                        <td>${{ $revenues }}</td>
                                    </tr>
                                    <tr>
                                        <th>ចំណាយផ្សេងៗ:</th>
                                        <td>${{ $costs }}</td>
                                    </tr>
                                    <tr>
                                        <th>សរុប:</th>
                                        <td>${{ $total }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
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
                            <a href="{{ route("report.print.daily") }}" target="_blank" class="btn btn-default float-right"><i class="fas fa-print"></i> Print</a>
                        </div>
                    </div>
                </div>
                <!-- /.invoice -->
            </div>
            <!-- /.col -->
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('footer')
<script>
    $('.dropify').dropify();
</script>
@endsection
