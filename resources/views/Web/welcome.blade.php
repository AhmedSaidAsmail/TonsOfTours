@extends('Web.Layouts._master')

@section('meta_tags')
    <?php $meta = App\MyModels\Admin\Topic::where('name', 'Home')->first() ?>
    <meta name="keywords" content="{{ $meta->keywords }}"/>
    <meta name="description" content="{{ $meta->description }}"/>
    <title>{{ $meta->title }}</title>
@endsection
@section('header-nav')
    <div class="row welcome-header-container">
        @include('Web.Layouts._mainNav')
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
        <div class="welcome-search">
            <div class="input-side">
                <input class="search-control" type="text" name="keywords" placeholder='Search for "Cairo" or "Pyramids"'
                       autocomplete="off">
            </div>
            <div class="button-side">
                <button class="search-btn"><i class="fas fa-search"></i></button>
            </div>
        </div>
        {{-- Welcome Search / Ending --}}
        <div class="row welcome-footer-slogans">
            <div class="col-md-4">
                <i class="fas fa-gift"></i>
                <h2>The best selection</h2>
                <span>More than 1000 things to do</span>
            </div>
            <div class="col-md-4">
                <span class="fa-stack">
                    <i class="fa fa-certificate fa-stack-2x"></i>
                    <i class="fa fa-usd fa-inverse fa-stack-1x"></i>
                </span>
                <h2>The lowest prices</h2>
                <span>We guarantee it!</span>
            </div>
            <div class="col-md-4">
                <i class="fas fa-shopping-cart"></i>
                <h2>Fast & easy booking</h2>
                <span>Book online to lock in your tickets</span>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="container">
            <h1>Top Tours</h1>
        </div>
    </div>
@endsection
