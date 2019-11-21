<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Print</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap 4 -->
        <!-- Font Awesome -->
        
        <link rel="stylesheet" href="{{ asset('cms/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('cms/dist/css/ionicons.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('cms/dist/css/adminlte.min.css')}}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <!-- Main content -->
            <section class="invoice">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- ./wrapper -->
        <script type="text/javascript"> 
            window.addEventListener("load", window.print());
        </script>
    </body>
</html>