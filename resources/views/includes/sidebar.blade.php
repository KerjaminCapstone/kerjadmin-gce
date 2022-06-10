<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    Kerjadmin
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>
                @can('admin-users')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="fa fa-user" style="color: rgb(16, 69, 227)" aria-hidden="true"></i>
                            <span>Admin</span>
                        </a>
                        <ul class="submenu {{ auth()->user()->hasRole('admin') ? 'active' : '' }}">
                            <li class="submenu-item">
                                <a href="{{ route('admin.freelancers.index') }}" class='sidebar-link'>
                                    <i class="fas fa-users-cog"></i>
                                    <span>Manajemen Freelancer</span>
                                </a>
                                <!-- <a href="{{ route('admin.complaints.index') }}" class='sidebar-link'>
                                    <i class="fas fa-users-cog"></i>
                                    <span>Manajemen Komplain</span>
                                </a> -->
                               <a class="sidebar-link" href="{{ route('logout') }}"><i
                                        class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                @endcan
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>