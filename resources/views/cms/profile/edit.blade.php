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
                        <a href="{{ UtilHelper::route('todo') }}" class="btn btn-outline-success btn-flat float-right">Todo List</a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Lastname</label>
                                <input type="name" class="form-control" name="last_name" id="last_name" placeholder="Enter Lastname" value="{{ UtilHelper::hasValue(old('last_name'), Auth::user()->last_name) }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Firstname</label>
                                <input type="name" class="form-control" name="first_name" id="first_name" placeholder="Enter Firstname" value="{{ UtilHelper::hasValue(old('first_name'), Auth::user()->first_name) }}">
                            </div>
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
