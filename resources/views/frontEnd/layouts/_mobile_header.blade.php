<div class="mobile-header">
    <div class="row">
        <div class="col-xs-2">
            <div class="main-nav-lunch">
                <div class="hamburger"></div>
            </div>
        </div>
        <div class="col-xs-7">
            <a href="{{route('home')}}" class="header-logo">
                <img src="{{asset('images/logo.png')}}">
            </a>
        </div>
        <div class="col-xs-3 mobile-header-list">
            <ul class="list-inline">
                <li>
                    <a href="">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="fas fa-user"></i>
                    </a>
                    <ul class="mobile-header-drop-menu">
                        <li>
                            <a href="{{route('customer.bookings')}}">
                                <i class="fas fa-cart-arrow-down"></i> Bookings
                            </a>
                        </li>
                        <li>
                            <a href="{{route('customer.setting')}}">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                        </li>
                        <li>
                            <a href="{{route('customer.logout') }}">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</div>

