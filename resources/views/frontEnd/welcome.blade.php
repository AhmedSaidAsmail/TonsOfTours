@extends('frontEnd.layouts._master')
@section('meta_tags')
    <?php $meta = App\MyModels\Admin\Topic::where('name', 'Home')->first() ?>
    <meta name="keywords" content="{{ $meta->keywords }}"/>
    <meta name="description" content="{{ $meta->description }}"/>
    <title>{{ $meta->title }}</title>
@endsection
@section('header-nav')
    <div class="row welcome-header-container">
        @include('frontEnd.layouts._mainNav')
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item">
                    <img src="{{asset('images/slider1.jpg')}}" alt="Egypt">
                </div>
                <div class="item active">
                    <img src="{{asset('images/slider2.jpg')}}" alt="Egypt">
                </div>
                <div class="item">
                    <img src="{{asset('images/slider3.jpg')}}" alt="Egypt">
                </div>
                <div class="item">
                    <img src="{{asset('images/slider4.jpg')}}" alt="Egypt">
                </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <i class="fas fa-angle-left"></i>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <i class="fas fa-angle-right"></i>
            </a>
        </div>
    </div>
    <div class="welcome-footer">
        {{-- Welcome Search--}}
        <form action="{{route('home.search')}}" method="get" id="searchForm">
        </form>
        <div class="welcome-search">
            <div class="input-side">
                <input class="search-control" type="text" name="keywords"
                       placeholder='Search for "Cairo" or "Pyramids"'
                       autocomplete="off" form="searchForm">
                <div class="search-loading">
                    {{--<img src="{{asset('images/loadinfo.gif')}}" alt="loading">--}}
                </div>
            </div>
            <div class="button-side">
                <button class="search-btn" form="searchForm" disabled><i class="fas fa-search"></i></button>
            </div>
            {{-- Search Results --}}
            <div class="welcome-search-results">
                {{-- Dispaying search results --}}
            </div>
            {{-- Search Results / Ending --}}
        </div>
        {{-- Welcome Search / Ending --}}
        <div class="container">
            <div class="row welcome-footer-slogans">
                <div class="col-md-3 col-xs-3">
                    <i class="fas fa-gift"></i>
                    <h2>The best selection</h2>
                    <span class="slogan-text">More than 1000 things to do</span>
                </div>
                <div class="col-md-3 col-xs-3">
                <span class="fa-stack">
                    <i class="fa fa-certificate fa-stack-2x"></i>
                    <i class="fa fa-usd fa-inverse fa-stack-1x"></i>
                </span>
                    <h2>The lowest prices</h2>
                    <span class="slogan-text">We guarantee it!</span>
                </div>
                <div class="col-md-3 col-xs-3">
                    <i class="fas fa-shopping-cart"></i>
                    <h2>Fast & easy booking</h2>
                    <span class="slogan-text">Book online to lock in your tickets</span>
                </div>
                <div class="col-md-3 col-xs-3">
                    <i class="fas fa-user-clock"></i>
                    <h2>Customer service</h2>
                    <span class="slogan-text">English speaking customer service representatives!!</span>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="container">
            <h1 class="main-title-center">Top Tours</h1>
            <?php
            $chunks = $topItems->chunk(3);
            $slice_1 = $chunks->slice(0, 2);
            $slice_2 = $chunks->slice(2);

            ?>
            {{-- Slice 1--}}
            @foreach($slice_1 as $chunks)
                <div class="row items-container">
                    @foreach($chunks as $item)
                        <?php
                        $link = route('home.item.show', [
                            'category' => urlencodeLink($item->category->name),
                            'name' => urlencodeLink($item->name),
                            'id' => $item->id]);
                        ?>
                        <div class="col-md-4">
                            <div class="item-container">
                                @if($item->offer)
                                    <div class="hot-offers-label"></div>
                                @endif

                                <div class="row item-container-footer">
                                    <div class="col-md-6 col-xs-6 col-sm-6 item-footer-price">
                                        @if(isset($item->price))
                                            {{sprintf('%.2f',$item->price->st_price)}}
                                        @endif
                                        <span>{{ translate('$') }}</span>
                                    </div>
                                    <div class="col-md-6 col-xs-6 col-sm-6 item-footer-basket">
                                        <a href="{{$link}}">
                                            {{ translate('Add_to_basket') }} <i class="fa fa-cart-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="item-container-img">
                                    <a href="{{$link}}">
                                        <img src="{{asset('images/items/thumbMd/'.$item->img)}}" alt="{{$item->title}}">
                                    </a>
                                </div>
                                <div class="item-container-text">
                                    <h2>{{$item->name}}</h2>
                                    <span>
                                        {{str_limit($item->intro,90,'...')}}
                                        <a href="{{$link}}">Read More</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
            {{-- Slice 1 / Ending --}}
        </div>
        {{-- Between --}}

        @include('frontEnd.layouts._freeCancellationLayer')

        <div class="container last-slice">
            {{-- Slice 2--}}
            @foreach($slice_2 as $chunks)
                <div class="row items-container">
                    @foreach($chunks as $item)
                        <?php
                        $link = route('home.item.show', [
                            'category' => urlencodeLink($item->category->name),
                            'name' => urlencodeLink($item->name),
                            'id' => $item->id]);
                        ?>
                        <div class="col-md-4">
                            <div class="item-container">
                                @if($item->offer)
                                    <div class="hot-offers-label"></div>
                                @endif

                                <div class="row item-container-footer">
                                    <div class="col-md-6 col-xs-6 col-sm-6 item-footer-price">
                                        @if(isset($item->price))
                                            {{sprintf('%.2f',$item->price->st_price)}}
                                        @endif
                                        <span>{{ translate('$') }}</span>
                                    </div>
                                    <div class="col-md-6 col-xs-6 col-sm-6 item-footer-basket">
                                        <a href="{{$link}}">
                                            {{ translate('Add_to_basket') }} <i class="fa fa-cart-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="item-container-img">
                                    <a href="{{$link}}">
                                        <img src="{{asset('images/items/thumbMd/'.$item->img)}}" alt="{{$item->title}}">
                                    </a>
                                </div>
                                <div class="item-container-text">
                                    <h2>{{$item->name}}</h2>
                                    <span>
                                        {{str_limit($item->intro,90,'...')}}
                                        <a href="{{$link}}">Read More</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
            {{-- Slice 2 / Ending --}}
        </div>
    </div>
@endsection
@section('_extra_js')
    <script>
        $(function () {
            let link = $('form#searchForm').attr('action');
            let resultContainer = $(".welcome-search-results");
            let loading = $('.search-loading');

            $('form#searchForm').submit(function (event) {
                event.preventDefault();
            });
            $("input[name=keywords]").keyup(function () {
                let value = $(this).val();
                if (value.length > 3) {
                    loading.show();
                    $.ajax({
                        url: link,
                        type: "get",
                        data: {keywords: value},
                        success: function (response) {
                            loading.hide();
                            resultContainer.show();
                            resultContainer.html(response);
                        }
                    })
                }
            });
            $(document).click(function (a) {
                if (!$(a.target).closest(resultContainer).length && resultContainer.is(":visible"))
                    resultContainer.hide();
            });
        });
    </script>
@endsection