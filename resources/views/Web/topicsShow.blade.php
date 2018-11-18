@extends('Web.Layouts._master')
@section('meta_tags')
<title>{{ $topic->title }}</title>
<meta name="keywords" content="{{ $topic->keywords }}">
<meta name="description" content="{{ $topic->description }}">
@endsection
@section('header-nav')
@include('Web.nav-menu')
@endsection
@section('content')



<div class="row exc-container">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <ul class="list-inline directory">
                        <li><a href="">{{ Vars::getVar("Home") }}<span class="glyphicon glyphicon-chevron-right" style="font-size: 10px;"></span></a></li>
                        <li><a href="">{{Vars::getVar('Articles')}} <span class="glyphicon glyphicon-chevron-right"></span></a>
                        <li><a href="">{{$topic->name}}</a>
                    </ul>
                    <h1>{{$topic->title}}</h1>
                </div>
                <div class="main-box row">
                    <div class="col-md-8">
                        @if($topic->Topics_text)
                        {!! $topic->Topics_text->txt !!}
                        @endif


                    </div>
                    <div class="col-md-4">
                        @foreach($topic->topics_image as $image)
                        <div class="row" style="margin-bottom: 10px;">
                            <img src="{{ asset('images/gallery/thumb/'.$image->img)}}">
                        </div>
                        @endforeach
                    </div>

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
                                <!-- <a href="{{route('tour.show',['city'=>urlencode($category->name),'tour'=>urlencode($item->name),'id'=>$item->id])}}">{{$item->title}}</a> -->

                                <div class="row">
                                    <div class="col-md-3"  style="padding: 0px;">
                                        <img src="{{asset('images/items/thumb/'.$item->img)}}" alt="" style="width: 100%;">
                                    </div>
                                    <div class="col-md-9 text-right">
                                        <div class="row banner-ref-list-title"><a href="{{route('tour.show',['city'=>urlencode($category->name),'tour'=>urlencode($item->name),'id'=>$item->id])}}" title="{{$item->title}}">
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
                    <li><span><a href="{{route('cities.show',['city'=>urlencode($Seccategory->name),'id'=>$Seccategory->id])}}">{{$Seccategory->title}}</a></span></li>
                    @endforeach
                </ul>
            </div>
            <div class="row more-attractions">
                <h3>{{ Vars::getVar("Top_Sharm_el_Sheikh_Attractions") }}</h3>
                <ul class="list-inline">
                    @foreach($Categories as $LinkCategory)
                    @foreach($LinkCategory->items->where('recommended',"=",1) as $LinkItems)

                    <li><span><a href="{{route('tour.show',['city'=>urlencode($LinkCategory->name),'tour'=>urlencode($LinkItems->name),'id'=>$LinkItems->id])}}">{{$LinkItems->title}}</a></span></li>

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