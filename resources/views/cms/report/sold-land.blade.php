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
                    <div class="row">
                        <p>ក-ចំណូលអតិថិជនទិញដីឡូតិ៍</p>
                        <div class="col-12 table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ល.រ</th>
                                        <th>ថ្ងៃ.ទី…ខែ…ឆ្នាំ</th>
                                        <th>ឈ្នោះអតិថិជន</th>
                                        <th>លេខឡូតិ៍</th>
                                        <th>ចំនួនឡូតិ៍</th>
                                        <th>កក់ប្រាក់</th>
                                        <th>តម្លៃសរុប</th>
                                        <th>នៅខ្វះចំនួន</th>
                                        <th>ទូទាត់រួច</th>
                                        <th>លេខទូរស័ព្ទ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($i = 1; $i <= 10; $i++)
                                        <tr>
                                            <th>{{ $i }}</th>
                                            <th>14/02/2019</th>
                                            <th>ញឹក ផាត</th>
                                            <th>B3</th>
                                            <th>1</th>
                                            <th>1000</th>
                                            <th>1500</th>
                                            <th>500</th>
                                            <th>0</th>
                                            <th>0123456789</th>
                                        </tr>
                                    @endfor
                                    
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
                            <a href="invoice-print.html" target="_blank" class="btn btn-default float-right"><i class="fas fa-print"></i> Print</a>
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
