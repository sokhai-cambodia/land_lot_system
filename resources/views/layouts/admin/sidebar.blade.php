<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin') }}" class="brand-link">
        <img src="{{ asset('cms/dist/img/AdminLTELogo.png') }}"
            alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Land Lot System</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Auth::user()->getPhoto() }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->getFullName() }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                
                <li class="nav-item">
                    <a href="{{ UtilHelper::route('admin') }}" class="nav-link {{ UtilHelper::activeSideBar(['cms']) }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ UtilHelper::route('company') }}" class="nav-link {{ UtilHelper::activeSideBar(['company']) }}">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Company
                            
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ UtilHelper::activeSideBar(['user.customer', 'user.witness', 'user.staff', 'user.deleted-list'], true) }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('user.customer') }}" class="nav-link {{ UtilHelper::activeSideBar(['user.customer']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Customer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('user.witness') }}" class="nav-link {{ UtilHelper::activeSideBar(['user.witness']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Witness</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('user.staff') }}" class="nav-link {{ UtilHelper::activeSideBar(['user.staff']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Staff</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('user.deleted-list') }}" class="nav-link {{ UtilHelper::activeSideBar(['user.deleted-list']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Deleted List</p>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                {{-- Land --}}
                <li class="nav-item has-treeview {{ UtilHelper::activeSideBar(['land', 'land.landlot', 'land.create', 'land.lot.create'], true) }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-map-marked-alt"></i>
                        <p>
                            Land
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('land.create') }}" class="nav-link {{ UtilHelper::activeSideBar(['land.create']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Land</p>
                            </a>
                        </li>
                        <li class="nav-item">
                                <a href="{{ UtilHelper::route('land.lot.create') }}" class="nav-link {{ UtilHelper::activeSideBar(['land.lot.create']) }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Land Lot</p>
                                </a>
                            </li>
                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('land') }}" class="nav-link {{ UtilHelper::activeSideBar(['land', 'land.landlot']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Land List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Revenue --}}
                <li class="nav-item has-treeview {{ UtilHelper::activeSideBar(['land.payment', 'legal-service'], true) }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>
                            Payment & Service
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('land.payment') }}" class="nav-link {{ UtilHelper::activeSideBar(['land.payment']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Payment List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('legal-service') }}" class="nav-link {{ UtilHelper::activeSideBar(['legal-service']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Legal Service</p>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                {{-- Land --}}
                <li class="nav-item has-treeview {{ UtilHelper::activeSideBar(['revenue-cost.category', 'revenue-cost', 'revenue-cost.create.revenue', 'revenue-cost.create.cost'], true) }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                        <p>
                            Revenue Cost
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('revenue-cost.category') }}" class="nav-link {{ UtilHelper::activeSideBar(['revenue-cost.category']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('revenue-cost') }}" class="nav-link {{ UtilHelper::activeSideBar(['revenue-cost']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Revenue Cost List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('revenue-cost.create.revenue') }}" class="nav-link {{ UtilHelper::activeSideBar(['revenue-cost.create.revenue']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Revenue</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('revenue-cost.create.cost') }}" class="nav-link {{ UtilHelper::activeSideBar(['revenue-cost.create.cost']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Cost</p>
                            </a>
                        </li>
                        
                    </ul>
                </li> 
                {{-- Report --}}
                <li class="nav-item has-treeview {{ UtilHelper::activeSideBar(['report.daily', 'report.monthly', 'report.land-layout', 'report.sold-land'], true) }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-print"></i>
                        <p>
                            Report
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('report.daily') }}" class="nav-link {{ UtilHelper::activeSideBar(['report.daily']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daily Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('report.monthly') }}" class="nav-link {{ UtilHelper::activeSideBar(['report.monthly']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Monthly Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('report.sold-land') }}" class="nav-link {{ UtilHelper::activeSideBar(['report.sold-land']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sold Land</p>
                            </a>
                        </li>
                    </ul>
                </li> 
                {{-- User Setting --}}
                <li class="nav-item has-treeview {{ UtilHelper::activeSideBar(['profile.change-password', 'profile.update'], true) }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            User Setting
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('profile.update') }}" class="nav-link {{ UtilHelper::activeSideBar(['profile.update']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>My Account</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ UtilHelper::route('profile.change-password') }}" class="nav-link {{ UtilHelper::activeSideBar(['profile.change-password']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Change Password</p>
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