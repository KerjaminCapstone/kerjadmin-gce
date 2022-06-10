<header class='mb-3'>
    <nav class="navbar navbar-expand navbar-light ">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                </ul>
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <i class="fa-solid fa-circle-user"></i> 
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li>
                            <h6 class="dropdown-header">
                                @if(Auth::check())
                                    {{Auth::user()->nama}}
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
                            <li><a class="dropdown-item" href="{{ route('register') }}">
                                <i class="icon-mid bi bi-person me-2"></i>Register</a></li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
