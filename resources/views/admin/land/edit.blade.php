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
                        <a href="{{ UtilHelper::route('land') }}" class="btn btn-outline-success btn-flat float-right">Land List</a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('land.update', ['id' => $row->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="name" class="form-control" name="title" id="title" placeholder="Enter title" value="{{ UtilHelper::hasValue(old('title'), $row->title) }}">
                            </div>
                            <div class="form-group">
                                <label for="width">Width</label>
                                <input type="number" class="form-control" minlength="0" step="0.01" name="width" id="width" placeholder="Enter width" value="{{ UtilHelper::hasValue(old('width'), $row->width) }}">
                            </div>
                            <div class="form-group">
                                <label for="height">Height</label>
                                <input type="number" class="form-control" minlength="0" step="0.01" name="height" id="height" placeholder="Enter height" value="{{ UtilHelper::hasValue(old('height'), $row->height) }}">
                            </div>
                            <div class="form-group">
                                <label for="size">Size</label>
                                <input type="number" class="form-control" minlength="0" step="0.01" name="size" id="size" placeholder="Enter size" value="{{ UtilHelper::hasValue(old('size'), $row->size) }}">
                            </div>
                            {{-- Land has land lot not display --}}
                            @if(!($row->type == "land" && $row->is_split_land_lot == 1)) 
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" minlength="0" step="0.01" class="form-control" name="price" id="price" placeholder="Enter price" value="{{ UtilHelper::hasValue(old('price'), $row->price) }}">
                                </div>
                                <div class="form-group">
                                    <label for="commission">Commission (%)</label>
                                    <input type="number" class="form-control" minlength="0" max="100" step="0.01" name="commission" id="commission" placeholder="Enter commission" value="{{ UtilHelper::hasValue(old('commission'), $row->commission) }}">
                                </div>
                            @endif
                            <div class="form-group row">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control dropify" data-default-file="{{ $row->getPhoto() }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="5" placeholder="Enter description">{{ UtilHelper::hasValue(old('description'), $row->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <textarea class="form-control" name="location" id="location" rows="5" placeholder="Enter location">{{ UtilHelper::hasValue(old('location'), $row->location) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    @foreach ($status as $s)
                                        @php 
                                            $sSelected = UtilHelper::hasValue(old('status'), $row->status);
                                        @endphp
                                        <option value="{{ $s }}" {{  UtilHelper::selected($s, $sSelected) }}>{{ $s }}</option>
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
