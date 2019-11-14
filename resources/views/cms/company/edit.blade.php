@extends('layouts.cms.template', compact('title'))

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('company') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control"
                    placeholder="Enter Name" value="{{ UtilHelper::hasValue(old('name'), $company->name) }}">
                            </div>
                            <div class="form-group row">
                                <label for="logo">Logo</label>
                                <input type="file" name="logo" class="form-control dropify" data-default-file="{{ $company->getLogo() }}">
                                
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" class="form-control"
                    placeholder="Enter Address">{{ UtilHelper::hasValue(old('address'), $company->address) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="found_at">Found At</label>
                                <input type="date" name="found_at" class="form-control" value="{{ UtilHelper::hasValue(old('found_at'), $company->found_at) }}">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
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
