@extends('layouts.master-horizontal')
@section('content')
    <div id="main" class="layout-horizontal">
        <header class="mb-5">
            <div class="header-top">
                <div class="container">
                    <div class="logo" style="display: flex; justify-content: center; align-items: center;">
                        <h4>Kerjadmin</h4>
                    </div>
                    <div class="header-top-right">
                        <div class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-menu d-flex">
                                    <div class="user-img d-flex align-items-center">
                                        <div class="avatar avatar-md">
                                            <i class="fa-solid fa-circle-user" style="font-size: 30px"></i>     
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <h6 class="dropdown-header">
                                        @if(Auth::user())
                                            @if(Auth::user()->hasRole('admin'))
                                                Admin
                                            @endif
                                        @else
                                            Guest
                                        @endif
                                    </h6>
                                </li>
        
                                @if(Auth::check())
                                    <li><a class="dropdown-item" href="{{ route('logout') }}"><i
                                        class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('login') }}">
                                        <i class="icon-mid bi bi-person me-2"></i>Login</a></li>
                                @endif
        
                            </ul>
                        </div>
                        <!-- Burger button responsive -->
                        <a href="#" class="burger-btn d-block d-xl-none">
                            <i class="fa-solid fa-list"></i>
                        </a>
                    </div>
                </div>
            </div>
            <nav class="main-navbar">
                <div class="container">
                    <div class="submenu-group-wrapper">
                        <ul class="submenu-group">
                            @if(Auth::user())
                                @if(Auth::user()->hasRole('admin'))
                                    <li
                                        class="menu-item">
                                        <a class='menu-link text-white font-weight-bold' href="{{ route('admin.freelancers.index') }}">
                                            <i class="bi bi-grid-fill text-white font-weight-bold"></i>
                                            <span>Dashboard</span>
                                        </a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </div> 
                </div>
            </nav>
        </header>
    </div>

    <div class="content-wrapper container">            
    </div>
@endsection

@push('custom-scripts')
@endpush