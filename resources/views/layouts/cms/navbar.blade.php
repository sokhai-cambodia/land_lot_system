<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            {{-- Single Menu --}}
            <div class="pcoded-navigation-label">Single Menu</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{ UtilHelper::activeNavbar(['product-feature']) }}">
                    <a href="{{ UtilHelper::route('product-feature') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-home"></i>
                        </span>
                        <span class="pcoded-mtext">Menu 1</span>
                    </a>

                </li>

                <li class="{{ UtilHelper::activeNavbar(['product.create']) }}">
                    <a href="{{ UtilHelper::route('product.create') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-file-plus"></i>
                        </span>
                        <span class="pcoded-mtext">Menu 2</span>
                    </a>

                </li>
                <li class="{{ UtilHelper::activeNavbar(['product']) }}">
                    <a href="{{ UtilHelper::route('product') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-sliders"></i>
                        </span>
                        <span class="pcoded-mtext">Menu 3</span>
                    </a>

                </li>
            </ul>
            {{-- Multi Menu --}}
            <div class="pcoded-navigation-label">Multi Menu</div>
            <ul class="pcoded-item pcoded-left-item">
                {{-- User --}}
                <li class="pcoded-hasmenu {{ UtilHelper::activeNavbar(['user', 'user.create'], true) }}" >
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                        <span class="pcoded-mtext">Menu</span>
                        {{-- <span class="pcoded-badge label label-warning">NEW</span> --}}
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{ UtilHelper::activeNavbar(['user.create']) }}">
                            <a href="{{ UtilHelper::route('user.create') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Sub Menu 1</span>
                            </a>
                        </li>
                        <li class="{{ UtilHelper::activeNavbar(['user']) }}">
                            <a href="{{ UtilHelper::route('user') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Sub Menu 2</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                {{-- Todo Sample Code --}}
                <li class="pcoded-hasmenu {{ UtilHelper::activeNavbar(['todo', 'todo.create'], true) }}" >
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                        <span class="pcoded-mtext">Menu</span>
                        {{-- <span class="pcoded-badge label label-warning">NEW</span> --}}
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{ UtilHelper::activeNavbar(['todo.create']) }}">
                            <a href="{{ UtilHelper::route('todo.create') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Create Todo</span>
                            </a>
                        </li>
                        <li class="{{ UtilHelper::activeNavbar(['todo']) }}">
                            <a href="{{ UtilHelper::route('todo') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">List Todo</span>
                            </a>
                        </li>
                    </ul>
                </li>
             
            </ul> 
        </div>
    </div>
</nav>
