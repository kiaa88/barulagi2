<!-- app-header -->
<header class="app-header">

    <!-- Start::main-header-container -->
    <div class="main-header-container container-fluid">

        <!-- Start::header-content-left -->
        <div class="header-content-left">

            <!-- Start::header-element -->
            <div class="header-element">
                <div class="horizontal-logo">
                    <a href="index.html" class="header-logo">
                        <img src="{{ asset('assets/kanudata-assets/logo-SEVEN-putih-2048x836-biru.png') }}" alt="logo"
                            class="desktop-logo">
                        <img src="{{ asset('assets/kanudata-assets/logo-SEVEN-putih-2048x836-biru.png') }}"
                            alt="logo" class="toggle-logo">
                        <img src="{{ asset('assets/kanudata-assets/logo-SEVEN-putih-2048x836-biru.png') }}"
                            alt="logo" class="desktop-dark">
                        <img src="{{ asset('assets/kanudata-assets/logo-SEVEN-putih-2048x836-biru.png') }}"
                            alt="logo" class="toggle-dark">
                        <img src="{{ asset('assets/kanudata-assets/logo-SEVEN-putih-2048x836-biru.png') }}"
                            alt="logo" class="desktop-white">
                        <img src="{{ asset('assets/kanudata-assets/logo-SEVEN-putih-2048x836-biru.png') }}"
                            alt="logo" class="toggle-white">
                    </a>
                </div>
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element">
                <!-- Start::header-link -->
                <a aria-label="Hide Sidebar"
                    class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle"
                    data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
                <!-- End::header-link -->
            </div>
            <!-- End::header-element -->

        </div>
        <!-- End::header-content-left -->

        <!-- Start::header-content-right -->
        <div class="header-content-right">

            <!-- Start::header-element -->
            <div class="header-element header-theme-mode">
                <!-- Start::header-link|layout-setting -->
                <a href="javascript:void(0);" class="header-link layout-setting">
                    <span class="light-layout">
                        <!-- Start::header-link-icon -->
                        <i class="fe fe-moon header-link-icon lh-2"></i>
                        <!-- End::header-link-icon -->
                    </span>
                    <span class="dark-layout">
                        <!-- Start::header-link-icon -->
                        <i class="fe fe-sun header-link-icon lh-2"></i>
                        <!-- End::header-link-icon -->
                    </span>
                </a>
                <!-- End::header-link|layout-setting -->
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element">
                <!-- Start::header-link|dropdown-toggle -->
                <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile"
                    data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <div class="header-link-icon">
                            <img src="../assets/images/faces/1.jpg" alt="img" width="32" height="32"
                                class="rounded-circle">
                        </div>
                        <div class="d-none">
                            <p class="fw-semibold mb-0">Angelica</p>
                            <span class="op-7 fw-normal d-block fs-11">Web Designer</span>
                        </div>
                    </div>
                </a>
                <!-- End::header-link|dropdown-toggle -->
                <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                    aria-labelledby="mainHeaderProfile">
                    <Li>
                        <div class="header-navheading border-bottom">
                            <h6 class="main-notification-title">Sonia Taylor</h6>
                            <p class="main-notification-text mb-0">Web Designer</p>
                        </div>
                    </Li>
                    <li><a class="dropdown-item d-flex" href="#" onclick="logout()"><i
                                class="fe fe-power fs-16 align-middle me-2"></i>Log Out</a></li>
                    <form id="logout-form" action="{{ route('dashboard.logout') }}" method="post">
                        @csrf
                    </form>
                    <script>
                        function logout() {
                            document.getElementById('logout-form').submit();
                        }
                    </script>
                </ul>
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element">
                <!-- Start::header-link|switcher-icon -->
                <a href="javascript:void(0);" class="header-link switcher-icon" data-bs-toggle="offcanvas"
                    data-bs-target="#switcher-canvas">
                    <i class="fe fe-settings header-link-icon"></i>
                </a>
                <!-- End::header-link|switcher-icon -->
            </div>
            <!-- End::header-element -->

        </div>
        <!-- End::header-content-right -->

    </div>
    <!-- End::main-header-container -->

</header>
<!-- /app-header -->
