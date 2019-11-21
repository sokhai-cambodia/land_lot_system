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
                        <a href="{{ UtilHelper::route('user.'.$role) }}" class="btn btn-outline-success btn-flat float-right">{{ ucfirst($role) }} List</a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('user.create', ['role' => $role]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter last name" value="{{ UtilHelper::hasValue(old('last_name'), "") }}">
                            </div>
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter first name" value="{{ UtilHelper::hasValue(old('first_name'), "") }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone" value="{{ UtilHelper::hasValue(old('phone'), "") }}">
                            </div>
                            <div class="form-group">
                                <label for="national_id">National Id</label>
                                <input type="text" class="form-control" name="national_id" id="national_id" placeholder="Enter national id" value="{{ UtilHelper::hasValue(old('national_id'), "") }}">
                            </div>
                            <div class="form-group">
                                <label for="passport_id">Passport Id</label>
                                <input type="text" class="form-control" name="passport_id" id="passport_id" placeholder="Enter passport id" value="{{ UtilHelper::hasValue(old('passport_id'), "") }}">
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="date" name="dob" class="form-control" value="{{ UtilHelper::hasValue(old('dob')) }}">
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    @foreach ($gender as $s)
                                        @php 
                                            $sSelected = UtilHelper::hasValue(old('gender'), "");
                                        @endphp
                                        <option value="{{ $s }}" {{  UtilHelper::selected($s, $sSelected) }}>{{ ucfirst($s) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group row">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control dropify">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" value="{{ UtilHelper::hasValue(old('username'), "") }}">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" value="{{ UtilHelper::hasValue(old('password'), "") }}">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    @foreach ($status as $s)
                                        @php 
                                            $sSelected = UtilHelper::hasValue(old('status'), "");
                                        @endphp
                                        <option value="{{ $s }}" {{  UtilHelper::selected($s, $sSelected) }}>{{ ucfirst($s) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Create</button>
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
