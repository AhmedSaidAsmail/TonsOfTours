@extends('Web.Layouts.master')
@section('meta_tags')
<title>{{$item->title}}</title>
<meta name="keywords" content="{{ $item->keywords }}" />
<meta name="description" content="{{ $item->description }}" />
@endsection
@section('content')
<div class="row exc-container">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <ul class="list-inline directory">
                        <li><a href="">Home<span class="glyphicon glyphicon-chevron-right" style="font-size: 10px;"></span></a></li>
                        <li><a href="">{{$item->sort->name}} Tours<span class="glyphicon glyphicon-chevron-right"></span></a>
                        <li><a href="">{{$item->name}}</a>
                    </ul>
                    <h1>{{$item->title}}</h1>
                </div>
                <div class="row">

                    <div class="col-md-5 item-img">

                        <div class="item-img-shadow"></div>
                        <img src="{{asset('images/items/'.$item->img)}}" style="width: 100%" alt="">
                    </div>
                    <div class="col-md-7" style="font-size: 17px; position: relative;">
                        <span class="glyphicon glyphicon-triangle-left item-img-label"></span>
                        <div class="row item-tripadvisor-icon">
                            <div class="row">
                                <div class="col-md-2" style="margin-top: -5px;">
                                    <div class="fb-like" data-href="http://www.sharmtour.com" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>
                                </div>
                                <div class="col-md-2">
                                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://sharmwondes.com" data-count="none">Tweet</a>
                                </div>
                                <div class="col-md-3">
                                    <script src="https://apis.google.com/js/platform.js" async defer></script>
                                    <div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/u/0/113067422417563827751" data-rel="publisher"></div>
                                </div>
                                <div class="col-md-2"><a href="//www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"  data-pin-color="red"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_red_20.png" /></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{$item->intro}}
                        </div>
                    </div>
                </div>
                <div class="row item-details-container">



                    <ul class="nav nav-tabs item-details-tab">
                        <li class="active"><a data-toggle="tab" href="#home"><span class="glyphicon glyphicon-stats" ></span> Itinerary</a></li>
                        <li><a data-toggle="tab" href="#menu1"><span class="glyphicon glyphicon-picture"></span> Gallery</a></li>

                    </ul>

                    <div class="tab-content item-tab-style" >
                        <div id="home" class="tab-pane fade in active">
                            <h3>Highlights</h3>
                            {!! $item->exploration->txt !!}
                            <div class="row" style="border: 2px solid #f2f2f2; padding-top: 20px; padding-bottom: 10px;
                                 margin-top: 50px;
                                 position: relative;
                                 box-shadow: 5px 5px 5px #f2f2f2;">
                                <div style="

                                     position: absolute;
                                     top: -20px;
                                     color: #fe6500;
                                     font-size: 21px;
                                     text-align: center;
                                     width: 100%;">

                                    <span style="background: #FFF;
                                          padding: 10px 20px;"><span class="glyphicon glyphicon-picture"></span> Small Gallery</span></div>
                                @foreach($item->itemsgallrie->slice(0,4) as $img)
                                <div class="col-md-3">
                                    <img class="img-thumbnail" src="{{asset('images/gallery/thumb/'.$img->img)}}" alt="">
                                </div>
                                @endforeach


                            </div>
                            <div class="row">
                                <h3 class="item-details-label-header">
                                    <span class="glyphicon glyphicon-ok"></span> Our Service includes</h3>
                                <ul style="margin:0px 0px 0px 30px; font-weight: bold;">
                                    @foreach($item->inclusion as $inclusion)
                                    <li>{{$inclusion->txt}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="row">
                                <h3 class="item-details-label-header">
                                    <span class="glyphicon glyphicon-remove"></span> Our Service Not includes</h3>
                                <ul style="margin:0px 0px 0px 30px; font-weight: bold;">
                                    @foreach($item->exclusion as $exclusion)
                                    <li>{{$exclusion->txt}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="row">
                                <h3 class="item-details-label-header">
                                    <span class="glyphicon glyphicon-star"></span> Recomendation</h3>
                                <ul style="margin:0px 0px 0px 30px; font-weight: bold;">
                                    @foreach($item->additional as $additional)
                                    <li>{{$additional->txt}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <h3>Menu 1</h3>
                            <p>Some content in menu 1.</p>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <h3>Menu 2</h3>
                            <p>Some content in menu 2.</p>
                        </div>
                    </div>



                </div>



                <div class="row more-attractions">
                    <h3>More Things to Do in Sharm el Sheikh</h3>
                    <ul class="list-inline">
                        <li><span><a href="">Cairo by Bus from Sharm One Day Trip</a></span></li>
                        <li><span><a href="">Cairo by Bus from Sharm One</a></span></li>
                        <li><span><a href="">Cairo by Bus from Sharm One Day</a></span></li>


                        <li><span><a href="">Cairo by Bus from Sharm One Day</a></span></li>
                        <li><span><a href="">Cairo by Bus from Sharm One</a></span></li>
                        <li><span><a href="">Cairo by Bus from Sharm One Day Trip</a></span></li>
                    </ul>
                </div>
                <div class="row more-attractions">
                    <h3>Top Sharm el Sheikh Attractions</h3>
                    <ul class="list-inline">
                        <li><span><a href="">Cairo by Bus from Sharm One Day Trip</a></span></li>
                        <li><span><a href="">Cairo by Bus from Sharm One</a></span></li>
                        <li><span><a href="">Cairo by Bus from Sharm One Day</a></span></li>


                        <li><span><a href="">Cairo by Bus from Sharm One Day</a></span></li>
                        <li><span><a href="">Cairo by Bus from Sharm One</a></span></li>
                        <li><span><a href="">Cairo by Bus from Sharm One Day Trip</a></span></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4" style="padding: 0px 0px 0px 20px; margin: 0px;">
                <div class="col-md-12">
                    <div class="row booking-form">
                        <div class="row booking-form-price-first">
                            <div class="col-md-7"><span>{{$item->price->st_name}}</span></div>
                            <div class="col-md-5">{{$item->price->st_price}}.00 <span>$</span></div>
                        </div>
                        <div class="row booking-form-price-sec">
                            <div class="col-md-7"><span>{{$item->price->sec_name}}</span></div>
                            <div class="col-md-5">{{$item->price->sec_price}}.00 <span>$</span></div>
                        </div>

                        <div class="row booking-form-date">
                            <h3>Select Travel Date</h3>
                            <div class="col-md-3">Date</div>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-addon booking-form-date-icon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                                </div>
                            </div>
                        </div>
                        <h3>Enter Total Number of Travelers</h3>
                        <div class="row">
                            <div class="col-md-3">Adult</div>
                            <div class="col-md-3"><input type="number" class="form-control"></div>
                            <div class="col-md-3">Adult</div>
                            <div class="col-md-3"><input type="number" class="form-control"></div>
                        </div>
                        <div class="row text-center" style="padding-top: 20px;">
                            <button class="btn btn-danger btn-lg">
                                <span class="glyphicon glyphicon-shopping-cart"></span> add to Basket <span class="glyphicon glyphicon-arrow-right"></span>
                            </button>
                            <h3 class="text-center price-gurantee"><a href=""><span class="glyphicon glyphicon-bookmark"></span> Low Price Guarantee</a></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <img src="{{asset('images/banner.jpg')}}" alt="" style="width:100%;">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h1>cairo excursions from sharm el sheikh</h1>
                        <ul>
                            <li><a href="">Cairo by Bus from Sharm One Day Trip</a></li>
                            <li><a href="">Cairo by plane one day trip</a></li>
                            <li><a href="">Private Trip to Cairo by Plane from Sharm One Day</a></li>
                            <li><a href="">Cairo by Bus from Sharm One Day Trip</a></li>
                            <li><a href="">Cairo by plane one day trip</a></li>
                            <li><a href="">Private Trip to Cairo by Plane from Sharm One Day</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-plugged-in')
<script>(function(d, s, id) {
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
<script>!function(d, s, id) {
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