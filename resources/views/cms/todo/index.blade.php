@extends('layouts.cms.template', compact('title'))

@section('header')
    <!-- jsGrid -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/jsgrid/jsgrid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cms/plugins/jsgrid/jsgrid-theme.min.css') }}">
@endsection

@section('content')

<!-- Content Header (Page header) -->
@include('layouts.cms.content-header', compact('title'))

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <a href="{{ UtilHelper::route('todo.create') }}" class="btn btn-outline-success btn-flat float-right">Create</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="jsGrid"></div>
        </div>
        <!-- /.card-body -->
    </div>
<!-- /.card -->
</section>
<!-- /.content -->
@endsection


@section('footer')
    <!-- jsGrid -->
    <script src="{{ asset('cms/plugins/jsgrid/demos/db.js') }}"></script>
    <script src="{{ asset('cms/plugins/jsgrid/jsgrid.min.js') }}"></script>
    <!-- page script -->
    <script>
        $(function () {
            $("#jsGrid").jsGrid({
                height: "100%",
                width: "100%",
        
                sorting: true,
                paging: true,
        
                data: db.clients,
        
                fields: [
                    { name: "Name", type: "text", width: 150 },
                    { name: "Age", type: "number", width: 50 },
                    { name: "Address", type: "text", width: 200 },
                    { name: "Country", type: "select", items: db.countries, valueField: "Id", textField: "Name" },
                    { name: "Married", type: "checkbox", title: "Is Married" }
                ]
            });
        });
    </script>
@endsection