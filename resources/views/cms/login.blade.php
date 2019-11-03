<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="colorlib" />
    <!-- Favicon icon -->
    <link rel="icon" href="https://colorlib.com/polygon/admindek/plugin/assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"><link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugin/cms/bower_components/bootstrap/css/bootstrap.min.css') }}">
   <!-- waves.css -->
    <link rel="stylesheet" href="{{ asset('plugin/cms/assets/pages/waves/css/waves.min.css') }}" type="text/css" media="all">
    <!-- feather icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugin/cms/assets/icon/feather/css/feather.css') }}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugin/cms/assets/icon/themify-icons/themify-icons.css') }}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugin/cms/assets/icon/icofont/css/icofont.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugin/cms/assets/icon/font-awesome/css/font-awesome.min.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugin/cms/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugin/cms/assets/css/pages.css') }}">
  </head>

<body themebg-pattern="theme1" style="background-image: url('http://localhost:8000/assets/cms/login-background.jpg');  background-repeat: no-repeat, repeat; background-position: center; background-size: cover;">
  <!-- Pre-loader start -->
  <div class="theme-loader">
      <div class="loader-track">
          <div class="preloader-wrapper">
              <div class="spinner-layer spinner-blue">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
              <div class="spinner-layer spinner-red">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>

              <div class="spinner-layer spinner-yellow">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>

              <div class="spinner-layer spinner-green">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Pre-loader end -->
    <section class="login-block" >
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <form class="md-float-material form-material" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="auth-box card" style="opacity: 0.9">
                            <div class="card-block">
                                    
                                <div class="row m-b-20">
                                    <img class="img-fluid" src="{{ FileHelper::getDashboardImage() }}" alt="Theme-Logo" style="max-height: 150px; margin: 0 auto;"/>
                                </div>
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center txt-primary">LOGIN</h3>
                                    </div>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="text" name="username" class="form-control" required="">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Username</label>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="password" name="password" class="form-control" required="">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Password</label>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">LOGIN</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>

<!-- Required Jquery -->
<script src="{{ asset('plugin/cms/bower_components/jquery/js/jquery.min.js') }}"></script>
<script src="{{ asset('plugin/cms/bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('plugin/cms/bower_components/popper.js/js/popper.min.js') }}"></script>
<script src="{{ asset('plugin/cms/bower_components/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- waves js -->
<script src="{{ asset('plugin/cms/assets/pages/waves/js/waves.min.js') }}"></script>
<!-- jquery slimscroll js -->
<script src="{{ asset('plugin/cms/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}"></script>
<!-- modernizr js -->
<script src="{{ asset('plugin/cms/bower_components/modernizr/js/modernizr.js') }}"></script>
<script src="{{ asset('plugin/cms/bower_components/modernizr/js/css-scrollbars.js') }}"></script>
<script src="{{ asset('plugin/cms/assets/js/common-pages.js') }}"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
<script src="{{ asset('plugin/cms/assets/js/rocket-loader.min.js') }}" data-cf-settings="f9fca66bca566c2e4fe58b6c-|49" defer=""></script>
@include('layouts.message.notification')
</body>
</html>
