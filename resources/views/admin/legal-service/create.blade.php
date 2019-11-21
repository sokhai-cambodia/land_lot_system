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
                        <a href="{{ UtilHelper::route('legal-service') }}" class="btn btn-outline-success btn-flat float-right">Legal Service</a>
                    </div>
                    <div class="col-md-12" style="margin-top: 20px">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th style="width: 5%">
                                        #
                                    </th>
                                    <th style="width: 20%">
                                        Image
                                    </th>
                                    <th style="width: 30%">
                                        Name
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <img src="{{ $land->getPhoto() }}" style="width: 100px; height: 100px"/>
                                    </td>
                                    <td>
                                        {{ $land->title }}
                                    </td>
                                    <td>
                                        Width(m): {{ $land->width }} <br>
                                        Height(m): {{ $land->height }} <br>
                                        Size(m2): {{ $land->size }} <br>
                                    </td>
                                        
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('legal-service.create', ['paymentId' => $paymentId]) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <!-- text input -->   
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" value="{{ UtilHelper::hasValue(old('title'), "") }}">
                            </div>
                        
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" placeholder="Enter description">{{ UtilHelper::hasValue(old('description'), "") }}</textarea>
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
