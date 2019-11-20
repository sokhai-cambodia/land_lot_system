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
                    <div class="row invoice-info" style="margin-top: 50px">
                        <div class="col-sm-12 invoice-col">
                            <p class="text-center">លិខិតប្រគល់ប្លង់ដី និងបង់ប្រាក់បង្រ្គប់</p>
                        </div>
                        <div class="col-sm-12 invoice-col">
                            <p>- យួន សុភា	បានទទួលប្លង់ដីដែលមានលេខឡូតិ៍ D32-D33 តម្លៃសរុបចំនួនUSD7,000 ។</p>
                            <p>- បានកក់ប្រាក់នៅថ្ងៃទី ២៥ - សីហា - ២០១៩ ចំនួន USD1,000</p>
                            <p>- បានបង់ប្រាក់បង្គ្រប់នៅថ្ងៃទី ០៦-កញ្ញា-២០១៩ ចំនួន USD6,000។</p>
                            <p class="text-right">ធ្វើនៅថ្ងៃទី០៦ ខែកញ្ញា ឆ្នាំ២០១៩</p>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <p class="text-center"><b>សាក្សី</b></p>
                            <p class="text-center" style="margin-top: 75px"><b>លឹម ច័ន្ទរតនៈ</b></p>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <p class="text-center"><b>អ្នកប្រគល់ប្រាក់និងទទួលប្លង់ដី</b></p>
                            <p class="text-center" style="margin-top: 75px"><b>យួន សុភា</b></p>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <p class="text-center"><b>អ្នកទទួលប្រាក់និងប្រគល់ប្លង់ដី</b></p>
                            <p class="text-center" style="margin-top: 75px"><b>លឹម សិរីរ័ត្ន</b></p>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
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
