@extends('Web.Layouts._master')
@section('meta_tags')
<?php $meta = App\MyModels\Admin\Topic::where('name', 'Home')->first() ?>
<meta name="keywords" content="{{ $meta->keywords }}" />
<meta name="description" content="{{ $meta->description }}" />
<title>{{ $meta->title }}</title>
@endsection
@section('header-nav')
<div class="row" style="position: relative;">
    @include('Web.Layouts._mainNav')
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                <img src="images/flash001.jpg" alt="Chania">
            </div>
        </div>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev" style="background-image: none;" >
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next" style="background-image: none;">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
@endsection
@section('content')
<!-- real insider -->
<div class="container welcome-body">
    <!-- Welcome Search -->
    <div class="search-sliders">
        <div class="search-sliders-insiders">
            <h2 class="banner-title">Let the activities begin!</h2>
            <div class="row" style="margin-top: 10px;">
                <form action="{{route('Web.searchItems')}}" method="get" id="serach-items-result">
                    <div class="col-md-10 col-sm-8 col-xs-8" style=" padding: 0px; position: relative;">
                        <input type="text" class="form-control welcome-search-input" id="welcome-search" placeholder="Search for destentions, attraction and tours" >
                        <div class="welcome-search-result" id="search-result">
                            <!-- search Result -->
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4" style=" padding: 0px;">
                        <button  class="btn btn-primary" style="width: 100%; border-radius: 0px; font-size: 17px; padding-top: 3px;">LETS GO</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Welcome Search -->


    @foreach($Categories->sortBy('arrangement') as $category)
    <div class="row">
        <h1 class="text-center welcome-title">{{$category->slogan}}
            <span class="glyphicon glyphicon-circle-arrow-right"></span></h1>
        <h4 class="text-center welcome-title2">{{$category->slogan2}}</h3>
    </div>
    @foreach($category->items->where('recommended',"=",1)->chunk(3) as $chunks)
    <div class="row welcome-items">
        @foreach($chunks as $item)
        <div class="col-md-4" >
            <div class="welcome-item">
                @if($item->offer)
                <div class="hot-offers"></div>
                @endif

                <div class="thumb-one row">
                    <div class="col-md-6 col-xs-6 col-sm-6">
                        @if(isset($item->price))
                        {{sprintf('%.2f',$item->price->st_price)}}
                        @endif
                        <span class="price-currency-label">{{ Vars::getVar("$") }}</span></div>
                    <div class="col-md-6 col-xs-6 col-sm-6" style=" text-align: right;">
                        <a href="{{route('tour.show',['city'=>urlencodeLink($category->name),'tour'=>urlencodeLink($item->name),'id'=>$item->id])}}" style="color:inherit; text-decoration: none;">
                            {{ Vars::getVar('Add_to_basket') }} <i class="fa fa-cart-plus" style="color: #67ab34;" ></i>
                        </a>
                    </div>
                </div>
                <div class="welcome-item-img-container">
                    <a href="{{route('tour.show',['city'=>urlencodeLink($category->name),'tour'=>urlencodeLink($item->name),'id'=>$item->id])}}">
                        <img src="{{asset('images/items/thumb/'.$item->img)}}"  alt="{{$item->title}}" style="width: 100%;">
                    </a>
                </div>

                <div class="welcome-item-txt-container">
                    <div class="welcome-img-border">
                        <span class="glyphicon glyphicon-triangle-top"></span>
                    </div>
                    <h2>{{$item->name}}</h2>
                    <?php
                    echo substr($item->intro, 0, 90);
                    ?>

                    ...<a href="{{route('tour.show',['city'=>urlencodeLink($category->name),'tour'=>urlencodeLink($item->name),'id'=>$item->id])}}">Read More</a>

                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
    <div class="row text-center">
        <a href="{{route('cities.show',['city'=>urlencodeLink($category->name),'id'=>$category->id])}}" class="btn btn-info btn-lg">Show more attractions</a>
    </div>
    @endforeach
</div>
@endsection