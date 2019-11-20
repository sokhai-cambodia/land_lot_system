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
                                        <th>#</th>
                                        <th>ឈ្មោះអតិថិជន</th>
                                        <th>លេខឡូតិ៍</th>
                                        <th>តម្លៃសរុប</th>
                                        <th>លុយកក់</th>
                                        <th>ប្រាក់បង្គ្រាប់</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($i = 0; $i < 5; $i++)
                                        <tr>
                                            <th>#</th>
                                            <th>ហេង សំណាង់</th>
                                            <th>D32-D33</th>
                                            <th>៧០០០</th>
                                            <th>៦០០០</th>
                                            <th>១០០០</th>
                                        </tr>
                                    @endfor
                                    
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
                                        <th>លុយកក់</th>
                                        <th>ប្រាក់បង្គ្រាប់</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($i = 0; $i < 5; $i++)
                                        <tr>
                                            <th>#</th>
                                            <th>ហេង សំណាង់</th>
                                            <th>D32-D33</th>
                                            <th>៧០០០</th>
                                            <th>៦០០០</th>
                                            <th>១០០០</th>
                                        </tr>
                                    @endfor
                                    
                                </tbody>
                            </table>
                        </div>
                        <p>គ-ចំណាស់ផ្សេងៗ</p>
                        <div class="col-12 table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ឈ្មោះអតិថិជន</th>
                                        <th>លេខឡូតិ៍</th>
                                        <th>តម្លៃសរុប</th>
                                        <th>លុយកក់</th>
                                        <th>ប្រាក់បង្គ្រាប់</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($i = 0; $i < 5; $i++)
                                        <tr>
                                            <th>#</th>
                                            <th>ហេង សំណាង់</th>
                                            <th>D32-D33</th>
                                            <th>៧០០០</th>
                                            <th>៦០០០</th>
                                            <th>១០០០</th>
                                        </tr>
                                    @endfor
                                    
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
                                    <tr>
                                        <th style="width:50%">ចំណូល</th>
                                        <td>$250.30</td>
                                    </tr>
                                    <tr>
                                        <th>កម្រៃជើងសារ</th>
                                        <td>$10.34</td>
                                    </tr>
                                    <tr>
                                        <th>ចំណាយ:</th>
                                        <td>$5.80</td>
                                    </tr>
                                    <tr>
                                        <th>សរុប:</th>
                                        <td>$265.24</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
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
