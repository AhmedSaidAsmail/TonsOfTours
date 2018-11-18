{{-- Top Nav --}}
<div class="row top-header">
    <div class="container">
        <nav class="navbar" id="header-nav" style=" min-height: 0px;">
            <div class="container-fluid headerLinks">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{route('home')}}"><span
                                    class="glyphicon glyphicon-home"></span>{{ Vars::getVar("Home") }}</a></li>
                    <li><a href="{{ route('cart')}}"><span class="glyphicon glyphicon-shopping-cart"></span>Cart <span
                                    id="shoping-cart-header">(
                                {{Session::has('cart')?Session::get('cart')->totalQty:0}}
                                )</span></a></li>
                    @foreach( App\MyModels\Admin\Topic::where('top',1)->orderBy('arrangement','asc')->get() as $top)
                        <li><a href="{{ route('topics.show',['topicsName'=>urlencodeLink($top->name)]) }}">
                                @if(!is_null($top->icon))
                                    <span class="glyphicon {{$top->icon}}"></span>
                                @endif
                                {{ $top->top_link }} </a></li>
                    @endforeach

                </ul>


            </div>
        </nav>
    </div>
</div>
{{-- Top Nav / Ending --}}
{{-- Main Nav --}}
<div class="row main-nav-normal animated" id="main-nav">
    <div class="nav-attention">
        <i class="fa fa-asterisk" aria-hidden="true"></i> {{Vars::getVar('book_online_and_pay_when_come_Egypt')}}
    </div>
    <div class="container" id="responsive-nav">
        <div class="responsive-menu-header">
            <div class="row">
                <div class="col-sm-2 col-xs-2 responsive-menu-icon-cover">
                    <div class="responsive-menu-icon">
                        <div class="hamburger"></div>
                    </div>

                </div>
                <div class="col-sm-7 col-xs-7 responsive-menu-logo-cover">
                    <div class="responsive-menu-logo"></div>
                </div>
                <div class="col-sm-3 col-xs-3 responsive-menu-cart">
                    <a href="{{ route('cart')}}">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                        <span class="responsive-menu-cart-no">
                            {{Session::has('cart')?Session::get('cart')->totalQty:0}}
                        </span></a>
                </div>
            </div>

        </div>
        <div class="row responsive-menu-side">
            <div class="col-md-2 logo-conatiner col-sm-8 col-xs-8">
                <span class="logo-header logo-header-position"></span>
            </div>
            <div class="col-sm-12 col-xs-12 responsive-menu-title">
                Main Menu
            </div>
            <div class="col-md-10 col-sm-12 col-xs-12 responsive-menu-conatiner">
                <ul id="main-nav-main" style="position: relative;">
                    @foreach(App\MyModels\Admin\Basicsort::where('home','=','1')->limit(4)->orderBy('arrangement','desc')->get() as $sortMenu)
                        <li>
                            <a href="#" class="normal-link"><i class="fa {{$sortMenu->icon}}"></i> {{$sortMenu->title}}
                                <i class="fa fa-caret-up link-arraow"></i>
                            </a>
                            @if(count($sortMenu->sorts)>0)
                                <div class="responsive-menu-arrow">
                                    <i class="fa fa-angle-down"></i>
                                </div>

                                <div class=" row submenu">
                                    @foreach($sortMenu->sorts->chunk(3) as $chunk)
                                        <div class="row">
                                            @foreach($chunk as $category)
                                                <div class="col-md-4">
                                                    <h2>
                                                        <a href="{{route('cities.show',['city'=>urlencodeLink($category->name),'id'=>$category->id])}}"
                                                           style="color:#5e5e5e;">{{$category->name}}</a></h2>

                                                    @if(count($category->items)>0)
                                                        <ul>
                                                            @foreach($category->items as $itemmenu)
                                                                <li>
                                                                    <a href="{{route('tour.show',['city'=>urlencodeLink($category->name),'tour'=>urlencodeLink($itemmenu->name),'id'=>$itemmenu->id])}}"
                                                                       title="{{$itemmenu->title}}">{{substr($itemmenu->name,0,30)}}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </li>
                    @endforeach
                <!-- start navigator menu -->

                    <li><a href="{{route('transfersShow')}}" class="additional-link"><i
                                    class="fa fa-car"></i> {{Vars::getVar('Airport Transfers')}}</a></li>
                    <li><a href="{{route('hotDeals')}}" class="additional-link"><i
                                    class="fa fa-heart"></i> {{Vars::getVar('Hot_Offers')}}</a></li>
                    <li class="responsive-menu-topics"><a href="{{route('home')}}" class="normal-link"><span
                                    class="glyphicon glyphicon-home"></span>{{ Vars::getVar("Home") }}</a></li>
                    @foreach( App\MyModels\Admin\Topic::where('top',1)->orderBy('arrangement','asc')->get() as $top)
                        <li class="responsive-menu-topics"><a
                                    href="{{ route('topics.show',['topicsName'=>urlencodeLink($top->name)]) }}"
                                    class="normal-link">
                                @if(!is_null($top->icon))
                                    <span class="glyphicon {{$top->icon}}"></span>
                                @endif
                                {{ $top->top_link }} </a></li>
                    @endforeach

                </ul>
            </div>
        </div>

    </div>
</div>
{{-- Main Nav /Ending --}}