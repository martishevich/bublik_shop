<!-- Start Header Style -->
<header id="header" class="htc-header header--3 bg__white">
    <!-- Start Mainmenu Area -->
    <div id="sticky-header-with-topbar" class="mainmenu__area sticky__header">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-lg-2 col-sm-3 col-xs-3 col-12">
                    <div class="logo">
                        <a href="/">
                            <img src="images/logo/logo.png" alt="logo">
                        </a>
                    </div>
                </div>
                <!-- Start MAinmenu Ares -->
                <div class="col-md-8 col-lg-8 col-sm-6 col-xs-6">
                    <nav class="mainmenu__nav hidden-xs hidden-sm">
                        <ul class="main__menu">
                            <li><a href="/">Shop</a></li>
                            <li><a href="/about">About us</a></li>
                            <li><a href="/contact">Contact</a></li>
                            <!-- End Single Mega MEnu -->
                        </ul>
                    </nav>
                    <div class="mobile-menu clearfix visible-xs visible-sm">
                        <nav id="mobile_dropdown">
                            <ul>
                                <li>@if (Route::has('login'))
                                            @auth
                                                <a href="{{ url('/home') }}">Cabinet</a>
                                            @endauth
                                    @endif</li>
                                <li><a href="/">Shop</a></li>
                                <li><a href="/about">About us</a></li>
                                <li><a href="/contact">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- End MAinmenu Ares -->
                <div class="col-md-2 col-sm-4 col-xs-3 col-12">
                    <ul class="menu-extra">
                        <li class="hidden-xs hidden-sm">@if (Route::has('login'))
                                    @auth
                                        <a href="{{ url('/home') }}">Cabinet</a>
                                    @endauth
                            @endif</li>
                            <li><a title="Add TO Cart" href="/Cardshop"><span style="color: red;" class="ti-shopping-cart">{{ session('counter') }}</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="mobile-menu-area"></div>
        </div>
    </div>
    <!-- End Mainmenu Area -->
</header>
<!-- End Header Style -->