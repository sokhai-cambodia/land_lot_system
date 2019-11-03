@php
    $icon = isset($icon) ? 'feather '.$icon.' bg-c-blue' : 'feather icon-clipboard bg-c-blue';
    $title = isset($title) ? $title : 'Empty Name';
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.cms.header')
    @yield('header-src')
</head>

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>
    <!-- [ Pre-loader ] end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <!-- [ Header ] start -->
            @include('layouts.cms.navbar-head')

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <!-- [ navigation menu ] start -->
                    @include('layouts.cms.navbar')
                    <!-- [ navigation menu ] end -->
                    <div class="pcoded-content">
                        <!-- [ breadcrumb ] start -->
                        <div class="page-header card">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="{{ $icon }}"></i>
                                        <div class="d-inline">
                                        <h5>{{ $title }}</h5>
                                            {{-- <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                @include('layouts.message.error')
                                                @yield('content')
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->
                            <div id="styleSelector">
                            </div>
                        </div>
                    </div>

                    <!-- [ style Customizer ] start -->
                    <div id="styleSelector">
                    </div>
                    <!-- [ style Customizer ] end -->
                </div>
            </div>
        </div>
    </div>
    @include('layouts.cms.footer')
    @include('layouts.message.notification')
    @include('layouts.message.delete-popup')
    @yield('footer-src')



</body>
</html>
