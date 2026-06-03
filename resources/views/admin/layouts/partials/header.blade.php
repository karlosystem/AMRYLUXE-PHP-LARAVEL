        <!-- Header section start -->
        <header class="header__area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="header__navbar">
                            <div class="header__navbar__left">
                                <button class="sidebar-toggler">
                                    <img src="{{ asset('admin/assets/images/icons/header/bars.svg') }}" alt="">
                                </button>
                                <a href="http://127.0.0.1:8000" target="_blank" class="btn btn-primary text-white">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            <div class="header__navbar__right">
                                <ul class="header__menu">
                                    <li>
                                        <a href="#" class="btn btn-dropdown user-profile"
                                            data-bs-toggle="dropdown">
                                            <img src="{{ asset('admin/assets/images/admin_profile/profile.png') }}"
                                                alt="icon">
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="profile.html">
                                                    <img src="{{ asset('admin/assets/images/icons/user.svg') }}"
                                                        alt="icon">
                                                    <span>Profile</span>
                                                </a>
                                            </li>
                                            <li>
                                                {{-- <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#logoutModal">
                                                    <img src="{{ asset('admin/assets/images/icons/logout.svg') }}"
                                                        alt="icon">
                                                    <span>Salir</span>
                                                </a> --}}
                                                <form action="{{ route('admin.logout') }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                         <img width="24" height="24" src="{{ asset('admin/assets/images/icons/logout.svg') }}"
                                                        alt="icon"><span>Salir</span>
                                                    </button>                                                     
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header section end -->
