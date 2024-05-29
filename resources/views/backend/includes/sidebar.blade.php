<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="/assets/backend/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Banking System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/assets/backend/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('dashboard') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link @yield('dashboard')">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> Dashboard </p>
                    </a>
                </li>
                <!-- Deposit -->
                <li class="nav-item">
                    <a href="{{ route('deposit.list') }}" class="nav-link @yield('deposit')">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p> Deposit </p>
                    </a>
                </li>
                <!-- Withdrawal -->
                <li class="nav-item @yield('withdrawal')">
                    <a href="#" class="nav-link @yield('withdrawal-menu')">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Withdrawal
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('withdrawal.add') }}" class="nav-link @yield('withdrawal-add')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Withdrawal</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('withdrawal.list') }}" class="nav-link @yield('withdrawal-list')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Withdrawal List</p>
                            </a>
                        </li>                        
                    </ul>
                </li>
                <!-- Logout -->
                <li class="nav-item">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p> Logout </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
