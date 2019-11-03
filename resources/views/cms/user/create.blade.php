@extends('layouts.cms.template', compact('title','icon'))

@section('content')
 <!-- Basic Form Inputs card start -->
 <div class="card">
    <div class="card-header">
        <h5>{{ $title }}</h5>
        <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>
    </div>
    <div class="card-block">
        <form action="{{ route('user.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" name="last_name" class="form-control"
                    placeholder="Enter Last Name" value="{{ old('last_name') }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" name="first_name" class="form-control"
                        placeholder="Enter First Name" value="{{ old('first_name') }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                    <input type="text" name="phone" class="form-control"
                        placeholder="Enter Phone" value="{{ old('phone') }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" name="username" class="form-control"
                        placeholder="Enter Username" value="{{ old('username') }}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Dob</label>
                <div class="col-sm-10">
                    <input type="text" name="dob" class="form-control date"
                        placeholder="Enter dob" value="{{ old('dob') }}" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Gender</label>
                <div class="col-sm-10">
                    <select name="gender" class="form-control">
                        @foreach ($gender as $gd)
                            <option value="{{ $gd }}" {{  UtilHelper::selected($gd, old('gender')) }}>{{ $gd }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select name="status" class="form-control">
                        @foreach ($status as $s)
                            <option value="{{ $s }}" {{  UtilHelper::selected($s, old('gender')) }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                    <select name="role_id" class="form-control">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{  UtilHelper::selected($role->id, old('role_id')) }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                    <input type="file" name="image" class="form-control dropify">
                </div>
            </div>

            <button type="submit" class="btn btn-success waves-effect waves-light pull-right">Save</button>
        </form>
    </div>
</div>
<!-- Basic Form Inputs card end -->
@endsection

@section('footer-src')
<script>
    $( document ).ready(function() {

        $('.date').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
</script>
@endsection