@extends('layouts.cms.template')

@section('content')

<!-- Content Header (Page header) -->
@include('layouts.cms.content-header')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @for($i = 0; $i < 10; $i++)
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Title</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        Start creating your amazing application!
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        Footer
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->
                @endfor
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection
