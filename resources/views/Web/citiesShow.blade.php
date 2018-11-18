@extends('Web.Layouts._master')
@section('meta_tags')
<title>{{ $category->title }}</title>
<meta name="keywords" content="{{ $category->keywords }}">
<meta name="description" content="{{ $category->description }}">
@endsection
@section('header-nav')
@include('Web.nav-menu')
@endsection
@section('content')
<div class="row exc-container">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row" style="margin-bottom: 20px; border: 1px outset #6a97ae; border-radius: 10px; overflow: hidden;">
                    <div class="col-md-4 col-xs-4 checkout-refrences checkout-refrences-active">
                        <i class="fa fa-cart-plus"></i> {{ Vars::getVar("Add_to_Cart") }}
                        <div class="checkout-refrences-arrow"></div>
                        <div class="checkout-refrences-arrow-bg"></div>
                    </div>
                    <div class="col-md-4 col-xs-4 checkout-refrences checkout-refrences-inactive">
                        <i class="fa fa-users" aria-hidden="true"></i> {{ Vars::getVar("Review_Orders") }}
                        <div class="checkout-refrences-arrow"></div>
                        <div class="checkout-refrences-arrow-bg"></div>
                    </div>
                    <div class="col-md-4 col-xs-4 checkout-refrences checkout-refrences-inactive">
                        <i class="fa fa-lock"></i> {{ Vars::getVar("Secure_checkout") }}
                    </div>
                </div>
                <!-- end directory -->
                <div class="row" >
                    <div class="col-md-12 exc-item-img-title">
                        <h3><span class="glyphicon glyphicon-briefcase"></span> {{$category->title}}</h3>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12 exc-item-img">
                        <img src="{{asset('images/sorts/'.$category->img)}}" alt="">
                    </div>
                </div>

                <div class="row exc-items-conatiner">
                    @foreach($category->items->where('status',"=",1)->chunk(2) as $chunks)
                    <div class="row welcome-items">
                        @foreach($chunks as $item)
                        <div class="col-md-6" >

                            <div class="welcome-item">
                                @if($item->offer)
                                <div class="hot-offers"></div>
                                @endif

                                <div class="thumb-one row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        @if(isset($item->price))
                                        {{sprintf('%.2f',$item->price->st_price)}}
                                        @endif
                                        <span class="price-currency-label">{{ Vars::getVar("$") }}</span></div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" style=" text-align: right;">
                                        <a href="{{route('tour.show',['city'=>urlencodeLink($category->name),'tour'=>urlencodeLink($item->name),'id'=>$item->id])}}" style="color:inherit; text-decoration: none;">
                                            {{ Vars::getVar('Add_to_basket') }} <i class="fa fa-cart-plus" style="color: #67ab34;" ></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="welcome-item-img-container">
                                    <a href="{{route('tour.show',['city'=>urlencodeLink($category->name),'tour'=>urlencodeLink($item->name),'id'=>$item->id])}}">
                                        <img src="{{asset('images/items/'.$item->img)}}"  alt="{{$item->title}}" style="width: 100%;">
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


                </div>

            </div>
            <div class="col-md-4">
                @include('Web.Layouts.TrnasferForm')


                <div class="row">
                    <div class="col-md-12 youtube-holder">
                        <iframe id="youtube"  height="315" src="https://www.youtube.com/embed/jnfwoGw3fnU" frameborder="0" allowfullscreen></iframe>
                    </div>


                </div>

                <div class="row" style="padding: 7px;">
                    <div class="col-md-12" style="border: 1px solid #e5e5e5; margin-top: 15px; background: #FFF; border-radius: 5px;">
                        <h1 class="bannser-ref-header">{{ $category->title}}</h1>
                        <ul class="banner-ref-list">
                            @foreach($category->items as $item)
                            <li>
                                <!-- <a href="{{route('tour.show',['city'=>urlencodeLink($category->name),'tour'=>urlencodeLink($item->name),'id'=>$item->id])}}">{{$item->title}}</a> -->

                                <div class="row">
                                    <div class="col-md-3"  style="padding: 0px;">
                                        <img src="{{asset('images/items/thumb/'.$item->img)}}" alt="" style="width: 100%;">
                                    </div>
                                    <div class="col-md-9 text-right">
                                        <div class="row banner-ref-list-title"><a href="{{route('tour.show',['city'=>urlencodeLink($category->name),'tour'=>urlencodeLink($item->name),'id'=>$item->id])}}" title="{{$item->title}}">
                                                {{substr($item->title,0,25)}}
                                            </a></div>
                                        <div class="row">
                                            {{Vars::getVar('from')}}
                                            <span class="banner-ref-list-price">{{ Vars::getVar("$") }}@if(isset($item->price)){{sprintf('%.2f',$item->price->st_price)}}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </li>
                            @endforeach

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="row more-attractions">
                <h3>{{ Vars::getVar("More_Things_to_Do_in_Sharm_el_Sheikh") }}</h3>
                <ul class="list-inline">
                    @foreach ($Categories as $Seccategory)
                    <li><span><a href="{{route('cities.show',['city'=>urlencodeLink($Seccategory->name),'id'=>$Seccategory->id])}}">{{$Seccategory->title}}</a></span></li>
                    @endforeach
                </ul>
            </div>
            <div class="row more-attractions">
                <h3>{{ Vars::getVar("Top_Sharm_el_Sheikh_Attractions") }}</h3>
                <ul class="list-inline">
                    @foreach($Categories as $LinkCategory)
                    @foreach($LinkCategory->items->where('recommended',"=",1) as $LinkItems)

                    <li><span><a href="{{route('tour.show',['city'=>urlencodeLink($LinkCategory->name),'tour'=>urlencodeLink($LinkItems->name),'id'=>$LinkItems->id])}}">{{$LinkItems->title}}</a></span></li>

                    @endforeach
                    @endforeach
                </ul>
            </div>
        </div>


    </div>
</div>

@endsection
@section('_extra_css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<link rel="stylesheet" href="{{asset('adminlte/plugins/daterangepicker/daterangepicker.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/select2/select2.min.css')}}">
@endsection
@section('_extra_js')
<script src="{{asset('adminlte/plugins/select2/select2.full.min.js')}}"></script>
<!-- date Range -->
<script src="{{asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script>
$(function() {
//Initialize Select2 Elements
    $(".select2").select2();
    $('#reservation').daterangepicker({
        startDate: new Date(),
        minDate: new Date()

    });


});
</script>
@endsection