@extends('layouts.cms.template', compact('title','icon'))

@section('content')


 <!-- Basic Form Inputs card start -->

 <div class="card">
    <div class="card-header">
        <h5>{{ $title }}</h5>
        <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>
    </div>
    <div class="card-block">
        <form id="main" action="{{ route('todo.create') }}" method="POST" enctype="multipart/form-data">
            
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control"
                    placeholder="Enter Name" value="{{ old('name') }}">
                    <span class="messages"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea rows="5" cols="5" name="description" class="form-control"
                        placeholder="Enter Description">{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select name="status" class="form-control">
                        @foreach ($status as $s)
                            <option value="{{ $s }}" {{  UtilHelper::selected($s, old('status')) }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success waves-effect waves-light pull-right">Save</button>
            @csrf
        </form>
    </div>
</div>
<!-- Basic Form Inputs card end -->
@endsection
