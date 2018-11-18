@extends('Web.Layouts._master')
@section('meta_tags')
<title>{{$item->title}}</title>
<meta name="keywords" content="{{ $item->keywords }}" />
<meta name="description" content="{{ $item->description }}" />
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
                        <li><a href="">{{$item->sort->name}} Tours<span class="glyphicon glyphicon-chevron-right"></span></a>
                        <li><a href="">{{$item->name}}</a>
                    </ul>
                    <h1>{{$item->title}}</h1>
                </div>
                <div class="row">

                    <div class="col-md-5 item-img">
                        <div class="item-img-shadow"></div>
                        <div class="item-img-holder">
                            
                            <img src="{{asset('images/items/'.$item->img)}}"  alt="">
                        </div>

                    </div>
                    <div class="col-md-7" style="font-size: 17px; position: relative;">
                        <span class="glyphicon glyphicon-triangle-left item-img-label"></span>
                        <div class="row item-tripadvisor-icon">
                            <div class="row">
                                <div class="col-md-3 col-lg-2 col-xs-3 col-sm-3" style="margin-top: -5px;">
                                    <div class="fb-like" data-href="http://www.sharmtour.com" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>
                                </div>
                                <div class="col-md-3 col-lg-2 col-xs-3 col-sm-3">
                                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://sharmwondes.com" data-count="none">Tweet</a>
                                </div>
                                <div class="col-md-4 col-lg-3 google-api">
                                    <script src="https://apis.google.com/js/platform.js" async defer></script>
                                    <div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/u/0/113067422417563827751" data-rel="publisher"></div>
                                </div>
                                <div class="col-md-2 col-xs-3 col-sm-3"><a href="//www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"  data-pin-color="red"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_red_20.png" /></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            $start = 100;
                            echo substr($item->intro, 0, $start);
                            ?>
                            <?php
                            if (substr($item->intro, $start)) {
                                echo '<a href="#" class="seemore">...see more</a>';
                                echo '<span class="reset-text">' . substr($item->intro, $start) . '</span>';
                                echo '<a class="showless" href="#">show less</a>';
                            }
                            ?>


                        </div>
                    </div>
                </div>
                <div class="row item-details-container">



                    <ul class="nav nav-tabs item-details-tab">
                        <li class="active"><a data-toggle="tab" href="#home"><span class="glyphicon glyphicon-stats" ></span> {{ Vars::getVar("Itinerary") }}</a></li>
                        <li><a data-toggle="tab" href="#menu1"><span class="glyphicon glyphicon-picture"></span> {{ Vars::getVar("Gallery") }}</a></li>

                    </ul>

                    <div class="tab-content item-tab-style" >
                        <div id="home" class="tab-pane fade in active">
                            <h3>{{ Vars::getVar("Highlights") }}</h3>
                            @if(isset($item->exploration->txt))
                            {!! $item->exploration->txt !!}
                            @endif
                            <div class="row small-gallery">
                                <div class="small-gallery-label">
                                    <span class="small-gallery-label-span"><span class="glyphicon glyphicon-picture"></span> 
                                        {{ Vars::getVar("Small_Gallery") }}</span></div>
                                @if(isset($item->itemsgallrie))
                                @foreach($item->itemsgallrie->slice(0,4) as $img)
                                <div class="col-md-3 img-item-small-gallery">
                                    <div>

                                        <a href="{{asset('images/gallery/'.$img->img)}}" class="show-more-photos" data-toggle="lightbox" data-gallery="{{$item->name}}">
                                            <img  src="{{asset('images/gallery/thumb/'.$img->img)}}" alt="{{$item->title}}">
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                                @endif


                            </div>

                            @if(count($item->inclusion)>0)
                            <div class="row">
                                <h3 class="item-details-label-header">

                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fa fa-check fa-stack-1x fa-inverse"></i>
                                    </span>
                                    {{ Vars::getVar("Our_Service_includes") }}</h3>
                                <ul style="margin:0px 0px 0px 30px; font-weight: bold;">
                                    @foreach($item->inclusion as $inclusion)
                                    <li>{{$inclusion->txt}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif


                            @if(count($item->exclusion)>0)
                            <div class="row">
                                <h3 class="item-details-label-header">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                                    </span>
                                    {{ Vars::getVar("Our_Service_Not_includes") }}</h3>
                                <ul style="margin:0px 0px 0px 30px; font-weight: bold;">
                                    @foreach($item->exclusion as $exclusion)
                                    <li>{{$exclusion->txt}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif


                            @if(count($item->additional)>0)
                            <div class="row">
                                <h3 class="item-details-label-header">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fa fa-star fa-stack-1x fa-inverse"></i>
                                    </span>
                                    {{ Vars::getVar("Recommendation") }}</h3>
                                <ul style="margin:0px 0px 0px 30px; font-weight: bold;">
                                    @foreach($item->additional as $additional)
                                    <li>{{$additional->txt}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                        </div>
                        <div id="menu1" class="tab-pane fade">
                            @if(isset($item->itemsgallrie))
                            @foreach($item->itemsgallrie->slice(4)->chunk(4) as $chunk)
                            <div class="row" style="margin-bottom: 15px;">
                                @foreach($chunk as $img)
                                <div class="col-md-3 img-item-small-gallery">
                                    <div>

                                        <a href="{{asset('images/gallery/'.$img->img)}}" class="show-more-photos" data-toggle="lightbox" data-gallery="{{$item->name}}">
                                            <img  src="{{asset('images/gallery/thumb/'.$img->img)}}" alt="{{$item->title}}">
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4" style="padding: 0px 0px 0px 20px; margin: 0px;">
                <div class="col-md-12">
                    @if(isset($item->price))

                    @include('Web.Layouts.BookingForm')

                    @endif
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <img src="{{asset('images/banner.jpg')}}" alt="" style="width:100%;">
                    </div>
                </div>

                <div class="row" style="padding: 7px;">
                    <div class="col-md-12" style="border: 1px solid #e5e5e5; margin-top: 15px; background: #FFF; border-radius: 5px;">
                        <h1 class="bannser-ref-header">{{ $item->sort->title}}</h1>
                        <ul class="banner-ref-list">
                            @foreach($item->sort->items as $leftItem)
                            <li>

                                <div class="row">
                                    <div class="col-md-3"  style="padding: 0px;">
                                        <img src="{{asset('images/items/thumb/'.$leftItem->img)}}" alt="" style="width: 100%;">
                                    </div>
                                    <div class="col-md-9 text-right">
                                        <div class="row banner-ref-list-title"><a href="{{route('tour.show',['city'=>urlencode($leftItem->sort->name),'tour'=>urlencode($leftItem->name),'id'=>$leftItem->id])}}" title="{{$leftItem->title}}">
                                                {{substr($leftItem->title,0,25)}}
                                            </a></div>
                                        <div class="row">
                                            {{Vars::getVar('from')}}
                                            <span class="banner-ref-list-price">{{ Vars::getVar("$") }}@if(isset($leftItem->price)){{sprintf('%.2f',$leftItem->price->st_price)}}
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
@section('extra-plugged-in')
<script>(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
        return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=184060755364562";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
@endsection
@section('_extra_js')
<script src="{{asset('adminlte/plugins/select2/select2.full.min.js')}}"></script>
<!-- Date Picker -->
<script src="{{asset('adminlte/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.2.0/ekko-lightbox.min.js"></script>
<script>
$(document).on('click', '[data-toggle="lightbox"]', function (event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});
$(function () {
//Initialize Select2 Elements
    $(".select2").select2();




});
var daysOff;
var inputlink = $('.daysoff').attr('data');
$.ajax({
    type: "get",
    url: inputlink,
    dataType: 'json',
    success: function (response) {

        daysOff = response;
        $(function () {
            $('#datepicker').datepicker({
                autoclose: true,
                daysOfWeekDisabled: daysOff,
                startDate: new Date()
            });
        });

    }
});
</script>
<script>!function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
        if (!d.getElementById(id)) {
            js = d.createElement(s);
            js.id = id;
            js.src = p + '://platform.twitter.com/widgets.js';
            fjs.parentNode.insertBefore(js, fjs);
        }
    }(document, 'script', 'twitter-wjs');</script>

<!-- Place this tag where you want the +1 button to render. -->

<!-- Place this tag after the last +1 button tag. -->




<!-- Please call pinit.js only once per page -->
<script type="text/javascript" async defer src="//assets.pinterest.com/js/pinit.js"></script>
@endsection
@section('_extra_css')
<link rel="stylesheet" href="{{asset('adminlte/plugins/datepicker/datepicker3.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/select2/select2.min.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.2.0/ekko-lightbox.min.css" rel="stylesheet">
@endsection