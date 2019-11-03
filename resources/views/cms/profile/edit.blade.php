@extends('layouts.cms.template', compact('title','icon'))

@section('content')
 <!-- Basic Form Inputs card start -->
 <div class="card">
    <div class="card-header">
        <h5>{{ $title }}</h5>
        <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>
    </div>
    <div class="card-block">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" name="last_name" class="form-control"
                    placeholder="Enter Last Name" value="{{ UtilHelper::hasValue(old('last_name'), Auth::user()->last_name) }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" name="first_name" class="form-control"
                        placeholder="Enter First Name" value="{{ UtilHelper::hasValue(old('first_name'), Auth::user()->first_name) }}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" name="username" class="form-control"
                        placeholder="Enter Username" value="{{ UtilHelper::hasValue(old('username'), Auth::user()->username) }}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Gender</label>
                <div class="col-sm-10">
                    <select name="gender" class="form-control">
                        @foreach ($gender as $gd)
                            @php 
                                $gSelected = UtilHelper::hasValue(old('gender'), Auth::user()->gender);
                            @endphp
                            <option value="{{ $gd }}" {{  UtilHelper::selected($gd, $gSelected) }}>{{ $gd }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Dob</label>
                <div class="col-sm-10">
                    <input type="date" name="dob" class="form-control"
                        placeholder="Enter dob" value="{{ UtilHelper::hasValue(old('dob'), Auth::user()->dob) }}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                    <input type="text" name="phone" class="form-control"
                        placeholder="Enter Phone" value="{{ UtilHelper::hasValue(old('phone'), Auth::user()->phone) }}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ Auth::user()->role->name }}" readonly="">
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Photo</label>
                <div class="col-sm-10">
                    <input type="file" name="photo" class="form-control dropify" data-default-file="{{ Auth::user()->getPhoto() }}">
                </div>
            </div>            
            <button type="submit" class="btn btn-success waves-effect waves-light pull-right">Save</button>
        </form>
    </div>
</div>
<!-- Basic Form Inputs card end -->
@endsection