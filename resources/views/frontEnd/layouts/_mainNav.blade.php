@include('frontEnd.layouts._loginForm')
<section class="main-nav">
    {{-- Top Nav --}}
    <div class="row top-nav">
        <div class="container">
            <nav class="navbar">
                <div class="container-fluid">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="{{route('wish-list.index')}}">
                                <i class="fas fa-heart"></i> WishList
                                @if(wishListsCount())
                                    <span class="header-numbers">({{wishListsCount()}})<i class="fas fa-circle"></i></span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('cart.index')}}">
                                <i class="fas fa-shopping-cart"></i> Cart
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fas fa-question-circle"></i> Help
                            </a>
                        </li>
                        @if (Auth::guard('customer')->check())
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-user"></i> {{Auth::guard('customer')->user()->name}}
                                </a>
                                <ul class="dropdown-menu">
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
                        @else
                            <li>
                                <a href="#" id="login">
                                    <i class="fas fa-user-circle"></i> Login
                                </a>
                            </li>
                            <li>
                                <a href="{{route('customer.register')}}">
                                    <i class="fas fa-user-plus"></i> Sign Up
                                </a>
                            </li>
                        @endif

                    </ul>


                </div>
            </nav>
        </div>
    </div>
    {{-- Top Nav / Ending --}}
    {{-- Main Nav --}}
    <div class="row main-navbar normal-screen ">
        <div class="container">
            <div class="col-md-3">
                <a href="{{route('home')}}" style="padding-top: 7px; display: block;">
                    <img src="{{asset('images/logo.png')}}" alt="" style="width: 90%;">
                </a>
            </div>
            <div class="col-md-9">
                <nav class="navbar">
                    <div class="container-fluid">
                        <ul class="nav navbar-nav navbar-right">
                            @foreach(activeMainCategories() as $activeMainCategory)
                                <li>
                                    <a href="{{route('home.mainCategory.show',['name'=>$activeMainCategory->name,'id'=>$activeMainCategory->id])}}"
                                       class="normal-link">
                                        <i class="fa {{$activeMainCategory->icon}}"></i>
                                        {{$activeMainCategory->title}}
                                    </a>
                                    @if(count($activeMainCategory->categories)>0)
                                        <div class="sub-nav">
                                            <div class="row">
                                                @foreach($activeMainCategory->categories->split(3) as $split)
                                                    <div class="col-md-4">
                                                        @foreach($split as $category)
                                                            <a href="{{route('home.category.show',['city'=>urlencodeLink($category->name),'id'=>$category->id])}}">
                                                                {{$category->name}}
                                                            </a>
                                                            @if(count($category->items)>0)
                                                                <ul>
                                                                    @foreach($category->items as $activeItems)
                                                                        <li>
                                                                            <a href="{{route('home.item.show',['category'=>urlencodeLink($category->name),'name'=>urlencodeLink($activeItems->name),'id'=>$activeItems->id])}}"
                                                                               title="{{$activeItems->title}}">{{str_limit($activeItems->name,40,'...')}}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                            <li>
                                <a href="#" class="additional-link">
                                    <i class="fas fa-phone-square"></i> {{Vars::getVar('Special_Assistance')}}
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    {{-- Main Nav /Ending --}}
</section>
{{-- Windos fixed position--}}
@section('_nav_js')
    <script>
        $(function () {
            $(window).scroll(function () {
                let topNavHeight = parseInt($('.top-nav').height());
                let mainMenu = $(".main-navbar");
                let scrollPoint = $(window).scrollTop();
                if (window.innerWidth > 797) {
                    if (scrollPoint >= topNavHeight && !mainMenu.hasClass('fixed-position')) {
                        mainMenu.addClass('fixed-position');
                    }
                    if (scrollPoint < topNavHeight && mainMenu.hasClass('fixed-position')) {
                        mainMenu.removeClass('fixed-position');
                    }
                }

            });

        });
    </script>
@endsection
