@extends('layouts.cms.template', compact('title','icon'))

@section('content')
 <!-- Basic Form Inputs card start -->
 <div class="card">
    <div class="card-header">
        <h5>{{ $title }}</h5>
        <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>
    </div>
    <div class="card-block">
        <form action="{{ route('profile.change-password') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Current Password</label>
                <div class="col-sm-10">
                    <input type="password" name="current_password" class="form-control"
                    placeholder="Enter Current Password" value="{{ old('current_password') }}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">New Password</label>
                <div class="col-sm-10">
                    <input type="password" name="new_password" class="form-control"
                    placeholder="Enter New Password" value="{{ old('new_password') }}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="col-sm-10">
                    <input type="password" name="confirm_password" class="form-control"
                    placeholder="Enter Confirm Password" value="{{ old('confirm_password') }}">
                </div>
            </div>
                   
            <button type="submit" class="btn btn-success waves-effect waves-light pull-right">Save</button>
        </form>
    </div>
</div>
<!-- Basic Form Inputs card end -->
@endsection