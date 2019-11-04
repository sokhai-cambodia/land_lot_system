<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
    <img src="{{ asset('cms/dist/img/AdminLTELogo.png') }}"
        alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('cms/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                
                <li class="nav-item">
                    <a href="{{ UtilHelper::route('cms') }}" class="nav-link {{ UtilHelper::activeSideBar(['cms']) }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                <a href="{{ UtilHelper::route('todo') }}" class="nav-link {{ UtilHelper::activeSideBar(['todo']) }}">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Todo
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ UtilHelper::activeSideBar(['define-your-route-name'], true) }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Menu Options
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">3</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('define-your-route-name') }}" class="nav-link {{ UtilHelper::activeSideBar(['define-your-route-name']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Menu 1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('define-your-route-name') }}" class="nav-link {{ UtilHelper::activeSideBar(['define-your-route-name']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Menu 2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('define-your-route-name') }}" class="nav-link {{ UtilHelper::activeSideBar(['define-your-route-name']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Menu 3 (Active)</p>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                <li class="nav-header">EXAMPLES</li>
                <li class="nav-item">
                    <a href="{{ UtilHelper::route('define-your-route-name') }}" class="nav-link {{ UtilHelper::activeSideBar(['define-your-route-name']) }}">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Menu 1
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ UtilHelper::route('define-your-route-name') }}" class="nav-link {{ UtilHelper::activeSideBar(['define-your-route-name']) }}">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Menu 2
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Menu Options
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('define-your-route-name') }}" class="nav-link {{ UtilHelper::activeSideBar(['define-your-route-name']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Menu 1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('define-your-route-name') }}" class="nav-link {{ UtilHelper::activeSideBar(['define-your-route-name']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Menu 2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('define-your-route-name') }}" class="nav-link {{ UtilHelper::activeSideBar(['define-your-route-name']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Menu 3</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>