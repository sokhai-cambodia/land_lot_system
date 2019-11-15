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
                        <a href="{{ UtilHelper::route('land') }}" class="btn btn-outline-success btn-flat float-right">Land List</a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('land.create') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="name" class="form-control" name="title" id="title" placeholder="Enter title" value="{{ UtilHelper::hasValue(old('title'), "") }}">
                            </div>
                            <div class="form-group">
                                <label for="size">Size</label>
                                <input type="number" class="form-control" name="size" id="size" placeholder="Enter size" value="{{ UtilHelper::hasValue(old('size'), "") }}">
                            </div>
                            <div class="form-group">
                                <label for="width">Width</label>
                                <input type="number" class="form-control" name="width" id="width" placeholder="Enter width" value="{{ UtilHelper::hasValue(old('width'), "") }}">
                            </div>
                            <div class="form-group">
                                <label for="height">Height</label>
                                <input type="number" class="form-control" name="height" id="height" placeholder="Enter height" value="{{ UtilHelper::hasValue(old('height'), "") }}">
                            </div>
                            <div class="form-group">
                                <label for="qty">Qty</label>
                                <input type="number" class="form-control" name="qty" id="qty" placeholder="Enter qty" value="{{ UtilHelper::hasValue(old('qty'), "") }}">
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" name="price" id="price" placeholder="Enter price" value="{{ UtilHelper::hasValue(old('price'), "") }}">
                            </div>
                            <div class="form-group">
                                <label for="commission">Commission</label>
                                <input type="number" class="form-control" name="commission" id="commission" placeholder="Enter commission" value="{{ UtilHelper::hasValue(old('commission'), "") }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="5" placeholder="Enter description">{{ UtilHelper::hasValue(old('description'), "") }}</textarea>
                            </div>
                            <div class="form-group row">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control dropify">
                            </div>
                            <div class="form-group">
                                <label for="status">Location</label>
                                <select name="location" id="location" class="form-control">
                                    @foreach ($location as $s)
                                        @php 
                                            $sSelected = UtilHelper::hasValue(old('location'), "");
                                        @endphp
                                        <option value="{{ $s }}" {{  UtilHelper::selected($s, $sSelected) }}>{{ $s }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Type</label>
                                <select name="type" id="type" class="form-control">
                                    @foreach ($type as $s)
                                        @php 
                                            $sSelected = UtilHelper::hasValue(old('type'), "");
                                        @endphp
                                        <option value="{{ $s }}" {{  UtilHelper::selected($s, $sSelected) }}>{{ $s }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    @foreach ($status as $s)
                                        @php 
                                            $sSelected = UtilHelper::hasValue(old('status'), "");
                                        @endphp
                                        <option value="{{ $s }}" {{  UtilHelper::selected($s, $sSelected) }}>{{ $s }}</option>
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
