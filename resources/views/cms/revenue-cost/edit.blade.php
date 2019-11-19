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
                        <a href="{{ UtilHelper::route('revenue-cost') }}" class="btn btn-outline-success btn-flat float-right">Revenue Cost</a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('revenue-cost.update', ['id' => $row->id]) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-control select2">
                                    @foreach ($categories as $category)
                                        @php 
                                            $sSelected = UtilHelper::hasValue(old('category'), $row->category_id);
                                        @endphp
                                        <option value="{{ $category->id }}" {{  UtilHelper::selected($category->id, $sSelected) }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" name="date" id="date" placeholder="Enter date" value="{{ UtilHelper::hasValue(old('date'), date('Y-m-d', strtotime($row->date))) }}">
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" min="0" step="0.01" name="price" id="price" placeholder="Enter price" value="{{ UtilHelper::hasValue(old('price'), $row->price) }}">
                            </div>
                            <div class="form-group">
                                <label for="note">Note</label>
                                <textarea class="form-control" name="note" id="note" placeholder="Enter note" rows="5">{{ UtilHelper::hasValue(old('note'), $row->note) }}</textarea>
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
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
    });
</script>
@endsection
