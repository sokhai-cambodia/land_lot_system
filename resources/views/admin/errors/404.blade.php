@section('header-src')

@endsection
<!DOCTYPE html>
<html>
<head>
    <title>Page Not Found</title>
    <style type="text/css">
        .w-wrap{
            text-align: center;
            position: absolute;
            left: 20%;
            top: 10%;
        }
        .w-wrap img{
            width: 80%;
        }
        .w-wrap span{
            color: darkred;
            font-size: 18px;
        }
        a{
            text-align: center;
            text-decoration: none;
        }
        .w-wrap .link-home{
            text-decoration: underline;
            width: 80%;
            text-align: center;
            margin: 20px 0 0 80px;
        }
    </style>
</head>
<body>
    <div class="w-wrap">
        <div><img src="{{asset('assets/uploads/404.png')}}"></div>
        <div class="link-home"><a href="{{ route('blank') }}"><span style="font-family:Bayon;">Back To previous page</span></a></div>
    </div>
</body>
</html>
