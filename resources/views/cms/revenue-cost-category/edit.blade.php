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
                        <a href="{{ UtilHelper::route('revenue-cost.category') }}" class="btn btn-outline-success btn-flat float-right">Category</a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('revenue-cost.category.update', ['id' => $row->id]) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Name</label>
                                <input type="name" class="form-control" name="name" id="title" placeholder="Enter name" value="{{ UtilHelper::hasValue(old('name'), $row->name) }}">
                            </div>
                            <div class="form-group">
                                    <label for="code">Code</label>
                                    <input type="name" class="form-control" name="code" id="code" placeholder="Enter code" value="{{ UtilHelper::hasValue(old('code'), $row->code) }}">
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
