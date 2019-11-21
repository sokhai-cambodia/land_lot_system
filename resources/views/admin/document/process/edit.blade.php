@extends('layouts.admin.template', compact('title'))

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
                        <a href="{{ UtilHelper::route('document.process', ['processId' => $processId]) }}" class="btn btn-outline-success btn-flat float-right">Document User List</a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('document.process.update', ['processId' => $processId, 'id' => $row->id]) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{ UtilHelper::hasValue(old('name'), $row->name) }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" placeholder="Enter description">{{ UtilHelper::hasValue(old('description'), $row->description) }}</textarea>
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
