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
                            របាយការណ៍ចំណាយ-ចំណូលប្រចាំខែ{{ DateHelper::toKhmerMonth($month) }}ផ្នែកគណយ្យករ
                            </p>
                        </div>
                    </div>
                    <!-- /.row -->
                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ល.រ</th>
                                        <th>ថ្ងៃ.ទី…ខែ…ឆ្នាំ</th>
                                        <th>ឈ្នោះ</th>
                                        <th>ប្រភេទ</th>
                                        <th>ចំណូល/ចំណាយ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $no = 1;
                                        $cost = 0;
                                        $revenue = 0;
                                    @endphp
                                    
                                    @foreach($reports as $report)
                                        @php 
                                            $total = 0;
                                            if($report->type == 'cost') {
                                                $total = $report->total * -1;
                                                $cost += $report->total;

                                            } else {
                                                $total = $report->total;
                                                $revenue += $report->total;
                                            }

                                        @endphp
                                        <tr>
                                            <th>{{ $no++ }}</th>
                                            <th>{{ $report->date }}</th>
                                            <th>{{ $report->category_name }}</th>
                                            <th>{{ $report->type }}</th>
                                            <th>{{ $total }}</th>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3"></th>
                                        <th>ចំណូល</th>
                                        <th>{{ $revenue }}</th>
                                    </tr>
                                    <tr>
                                        <th colspan="3"></th>
                                        <th>ចំណាយ</th>
                                        <th>{{ $cost }}</th>
                                    </tr>
                                    <tr>
                                        <th colspan="3"></th>
                                        <th>សរុប</th>
                                        <th>{{ $revenue - $cost }}</th>
                                    </tr>
                                </tfoot>
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
                            <p class="text-center">ធ្វើនៅថ្ងៃទី០៦ ខែកញ្ញា ឆ្នាំ២០១៩</p>
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
                            <a href="{{ route('report.print-monthly') }}" target="_blank" class="btn btn-default float-right"><i class="fas fa-print"></i> Print</a>
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
