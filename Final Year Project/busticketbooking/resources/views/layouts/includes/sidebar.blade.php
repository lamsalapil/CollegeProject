<!-- SIDEBAR -->
	<!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-bus"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Bus<sup>Management</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{Request::routeIs('admin.dashboard') ? 'active':'';}}">
                <a class="nav-link" href="{{route('admin.dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{Request::routeIs('admin.account.index') ? 'active':'';}}">
                <a class="nav-link" href="{{route('admin.account.index')}}"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-user"></i>
                    <span>Account</span>
                </a>
            </li>
            <li class="nav-item {{Request::routeIs('admin.bus.index') ? 'active':'';}}">
                <a class="nav-link" href="{{route('admin.bus.index')}}">
                    <i class="fas fa-bus"></i>
                    <span>Bus</span>
                </a>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1"
                    aria-expanded="true" aria-controls="collapseUtilities1">
                    <i class="fas fa-calendar"></i>
                    <span>Manage Schedule</span>
                </a>
                <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item text-primary {{Request::routeIs('admin.schedule.index') ? 'active':'';}}" href="{{route('admin.schedule.index')}}">
                            <i class="fas fa-route text-primary"></i>
                            <span>Route</span>
                        </a>
                        @if(auth()->user()->hasRole('admin'))
                            <a class="collapse-item text-primary {{Request::routeIs('admin.startdestination.index') ? 'active':'';}}" href="{{route('admin.startdestination.index')}}" href="{{route('admin.startdestination.index')}}">
                                <i class="fas fa-chevron-circle-right"></i>                   
                                <span>Start Destination</span>
                            </a>
                            <a class="collapse-item text-primary {{Request::routeIs('admin.destination.index') ? 'active':'';}}" href="{{route('admin.destination.index')}}">
                                <i class="fas fa-chevron-circle-right"></i>
                                <span>Destination</span>
                            </a>
                        @endif
                    </div>
                </div>
            </li>
            
            @if(auth()->user()->hasRole('admin'))
            <li class="nav-item {{Request::routeIs('admin.coupon.index') ? 'active':'';}}">
                <a class="nav-link d-flex align-items-end" href="{{route('admin.coupon.index')}}">
                    <i class='bx bxs-coupon bx-tada text-center' style="font-size: 17px"></i>
                    <span>Coupons</span>
                </a>
            </li>
            @endif
            <li class="nav-item {{Request::routeIs('admin.booking.index') ? 'active':'';}}">
                <a class="nav-link" href="{{route('admin.booking.index')}}">
                    <i class='fas fa-money-bill'></i>
                    <span>Booking</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
	<!-- SIDEBAR -->
