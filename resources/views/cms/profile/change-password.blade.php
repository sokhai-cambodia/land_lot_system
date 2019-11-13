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
                    <form role="form" action="{{ route('profile.change-password') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Current Password</label>
                                <input type="password" name="current_password" class="form-control"
                    placeholder="Enter Current Password" value="{{ old('current_password') }}">
                            </div>
                            <div class="form-group">
                                <label for="name">New Password</label>
                                <input type="password" name="new_password" class="form-control"
                    placeholder="Enter New Password" value="{{ old('new_password') }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control"
                    placeholder="Enter Confirm Password" value="{{ old('confirm_password') }}">
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
