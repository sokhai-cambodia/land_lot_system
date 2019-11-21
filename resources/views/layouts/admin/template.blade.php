<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $title ?? "Land Lot System" }}</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('layouts.admin.header')
        @yield('header')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            @include('layouts.admin.navbar')
            <!-- /.navbar -->
            <!-- Main Sidebar Container -->
            @include('layouts.admin.sidebar')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                @include('layouts.admin.content-header')

                <!-- Error Message -->
                @include('layouts.message.error')
                @yield('content')
                
            </div>
            <!-- /.content-wrapper -->
            @include('layouts.admin.footer')
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
        <!-- jQuery -->
        <script src="{{ asset('cms/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- SweetAlert2 -->
        <script src="{{ asset('cms/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <!-- Select2 -->
        <script src="{{ asset('cms/plugins/select2/js/select2.full.min.js') }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('cms/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('cms/dist/js/adminlte.min.js')}}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('cms/dist/js/demo.js')}}"></script>
        <!-- Dropify -->
        <script src="{{ asset('cms/plugins/dropify/dropify.js')}}"></script>
        @include('layouts.message.notification')
        @include('layouts.message.delete-popup')
        @yield('footer')
    </body>
</html>