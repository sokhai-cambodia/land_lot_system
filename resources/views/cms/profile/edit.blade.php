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
                    <form role="form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control"
                    placeholder="Enter Fistname" value="{{ UtilHelper::hasValue(old('last_name'), Auth::user()->last_name ) }}">
                            </div>
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control"
                    placeholder="Enter Lastname" value="{{ UtilHelper::hasValue(old('first_name'), Auth::user()->first_name ) }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control"
                    placeholder="Enter Phone" value="{{ UtilHelper::hasValue(old('phone'), Auth::user()->phone ) }}">
                            </div>
                            <div class="form-group">
                                <label for="national_id">National Id</label>
                                <input type="text" name="national_id" class="form-control"
                    placeholder="Enter National Id" value="{{ UtilHelper::hasValue(old('national_id'), Auth::user()->national_id ) }}">
                            </div>
                            <div class="form-group">
                                <label for="passport_id">Passport Id</label>
                                <input type="text" name="passport_id" class="form-control"
                    placeholder="Enter Passport Id" value="{{ UtilHelper::hasValue(old('passport_id'), Auth::user()->passport_id ) }}">
                            </div>
                            <div class="form-group row">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control dropify" data-default-file="{{ Auth::user()->getPhoto() }}">
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="date" name="dob" class="form-control" value="{{ UtilHelper::hasValue(old('dob'), Auth::user()->dob) }}">
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    @foreach ($gender as $s)
                                        @php 
                                            $sSelected = UtilHelper::hasValue(old('gender'), Auth::user()->gender);
                                        @endphp
                                        <option value="{{ $s }}" {{  UtilHelper::selected($s, $sSelected) }}>{{ ucfirst($s) }}</option>
                                    @endforeach
                                </select>
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