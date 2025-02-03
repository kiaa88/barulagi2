<!-- Start::app-sidebar -->
<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="{{ url('/dashboard') }}" class="header-logo">
            <img src="{{ asset('assets/kanudata-assets/logo-SEVEN-putih-2048x836-biru.png') }}" class="desktop-white"
                alt="logo">
            <img src="{{ asset('assets/kanudata-assets/logo-SEVEN-putih-2048x836-biru.png') }}" class="toggle-white"
                alt="logo">
            <img src=".{{ asset('assets/kanudata-assets/logo-SEVEN-putih-2048x836-biru.png') }}" class="desktop-logo"
                alt="logo">
            <img src="{{ asset('assets/kanudata-assets/logo-SEVEN-putih-2048x836-biru.png') }}" class="toggle-dark"
                alt="logo">
            <img src="{{ asset('assets/kanudata-assets/logo-SEVEN-putih-2048x836-biru.png') }}" class="toggle-logo"
                alt="logo">
            <img src="{{ asset('assets/kanudata-assets/logo-SEVEN-putih-2048x836-biru.png') }}" class="desktop-dark"
                alt="logo">
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            <ul class="main-menu">
                <li class="slide__category"><span class="category-name">Dashboard</span></li>

                <li class="slide {{ request()->routeIs('dashboard.home') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.home') }}" class="side-menu__item {{ request()->routeIs('dashboard.home') ? 'active' : '' }}">
                        <span class="shape1"></span>
                        <span class="shape2"></span>
                        <i class="ti-home side-menu__icon"></i>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>

                <li class="slide__category"><span class="category-name">Master Data</span></li>

                <li class="slide {{ request()->routeIs('dashboard.biodata.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.biodata.index') }}" class="side-menu__item {{ request()->routeIs('dashboard.biodata.*') ? 'active' : '' }}">
                        <span class="shape1"></span>
                        <span class="shape2"></span>
                        <i class="ti-user side-menu__icon"></i>
                        <span class="side-menu__label">Biodata</span>
                    </a>
                </li>

                <li class="slide {{ request()->routeIs('dashboard.kategori.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.kategori.index') }}" class="side-menu__item {{ request()->routeIs('dashboard.kategori.*') ? 'active' : '' }}">
                        <span class="shape1"></span>
                        <span class="shape2"></span>
                        <i class="fa-solid fa-tags side-menu__icon"></i>
                        <span class="side-menu__label">Kategori</span>
                    </a>
                </li>

                <li class="slide {{ request()->routeIs('dashboard.barang.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.barang.index') }}" class="side-menu__item {{ request()->routeIs('dashboard.barang.*') ? 'active' : '' }}">
                        <span class="shape1"></span>
                        <span class="shape2"></span>
                        <i class="fa-solid fa-box side-menu__icon"></i>
                        <span class="side-menu__label">Barang</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End::nav -->
        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                height="24" viewBox="0 0 24 24">
                <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
            </svg></div>
    </div>
    <!-- End::main-sidebar -->

</aside>
<!-- End::app-sidebar -->