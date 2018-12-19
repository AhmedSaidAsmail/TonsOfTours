@extends('frontEnd.layouts._master')
@section('meta_tags')
    <meta name="keywords" content="{{ $item->keywords }}"/>
    <meta name="description" content="{{ $item->description }}"/>
    <title>{{ $item->title }}</title>
@endsection
@section('header-nav')
    <div class="row insider-header-container">
        @include('frontEnd.layouts._mainNav')
        <img class="aspect-img" src="{{asset('images/items/'.$item->img)}}"
             alt="{{$item->title}}">
        <div class="insider-header-contains">
            <div class="container">
                <a href="{{asset('images/items/'.$item->img)}}?image=100" class="more-photos" data-toggle="lightbox"
                   data-gallery="{{$item->title}}">
                    <i class="fas fa-camera"></i>
                    <span>{{translate('More_photos')}}</span>
                </a>
                <div class="item-gallery">
                    @foreach($item->images as $img)
                        <a href="{{asset('images/gallery/'.$img->image)}}" data-toggle="lightbox"
                           title="{{$img->title}}"
                           data-gallery="{{$item->title}}">
                            #
                        </a>
                    @endforeach
                </div>
                <ul class="list-inline dir">
                    <?php
                    $mainCategory = $item->category->mainCategory;
                    $category = $item->category;
                    ?>
                    <li>
                        <a href="{{route('home.mainCategory.show',['name'=>urlencodeLink($mainCategory->name),'id'=>$mainCategory->id])}}">
                            {{$mainCategory->name}}
                        </a>
                    </li>
                    <li>
                        <a href="{{route('home.category.show',['name'=>urlencodeLink($category->name),'id'=>$category->id])}}">
                            {{$category->name}}
                        </a>
                    </li>
                    <li>{{$item->title}}</li>
                </ul>
                <h1 class="item-title-responsive">{{$item->title}}</h1>
            </div>
        </div>

    </div>
@endsection
@section('content')
    <div class="row">
        <div class="container">
            <div class="row item-holder">
                <div class="col-md-8">
                    <ul class="list-inline symbol-references">
                        <li>
                            <i class="far fa-comment-alt"></i> Offered in: English and other
                        </li>
                        @if(!is_null($item->details))
                            @if(!is_null($item->details->duration))
                                <li>
                                    <i class="far fa-clock"></i> {{$item->details->duration}}
                                </li>
                            @endif
                            @if(!is_null($item->details->transfer))
                                <li>
                                    <i class="fas fa-bus-alt"></i> Pick-up service
                                </li>
                            @endif
                        @endif
                        <li>
                            <i class="fas fa-credit-card"></i> Cancellation: up 2 Days
                        </li>
                    </ul>
                    <ul class="list-inline item-main-nav-bar">
                        <li class="active"><a href="#overview" id="scrollTo">Overview</a></li>
                        <li><a href="#itinerary" id="scrollTo">Itinerary</a></li>
                        <li><a href="#price" id="scrollTo">Prices</a></li>

                    </ul>
                    <div class="intro" id="overview">
                        {{$item->intro}}
                    </div>
                    @if($item->includes->count()>0)
                        <h1 class="item-header">{{translate('Include')}}</h1>
                        <ul class="item-includes">
                            @foreach($item->includes as $include)
                                <li>{{trim(str_replace('•','',$include->txt))}}</li>
                            @endforeach
                        </ul>
                    @endif
                    @if($item->excludes->count()>0)
                        <h1 class="item-header">{{translate('Excludes')}}</h1>
                        <ul class="item-excludes">
                            @foreach($item->excludes as $exclude)
                                <li>{{trim(str_replace('*','',$exclude->txt))}}</li>
                            @endforeach
                        </ul>
                    @endif
                    @if(isset($item->exploration))
                        <h1 class="item-header" id="itinerary">{{translate('Itinerary')}}</h1>
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                           href="#collapse5" aria-expanded="true">
                                            {{translate('Highlights')}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse5" class="panel-collapse collapse in" aria-expanded="true" style="">
                                    <div class="panel-body">
                                        {!! $item->exploration->txt !!}
                                    </div>
                                </div>
                            </div>


                        </div>
                    @endif
                    @if(isset($item->price))
                        <h1 class="item-header" id="price">{{translate('Prices')}}</h1>
                        <div class="item-prices-container">
                            <div class="row">
                                <div class="col-md-5 price-references">
                                    <div class="price-package">
                                        <span class="only">{{translate('Price_per_Person')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul>
                                        <li>{{ payment()->currency_symbol }} <b>{{$item->price->st_price}}</b>
                                            {{translate('Price_per')}} {{$item->price->st_name}}
                                        </li>
                                        <li>{{ payment()->currency_symbol }} <b>{{$item->price->sec_price}}</b>
                                            {{translate('price_per')}} {{$item->price->sec_name}}
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            @if($item->packages->count()>0)
                                @foreach($item->packages as $package)
                                    <div class="row">
                                        <div class="col-md-5 price-references">
                                            <div class="price-package">
                                                <span>{{translate('Price_per_Person')}}</span>
                                                <span>
                                                    (
                                                    {{translate('from')}} <b>{{$package->min}}</b> {{'to'}}
                                                    <b>{{$package->max}}</b> {{translate('person')}}
                                                    )
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul>
                                                <li>{{ payment()->currency_symbol }} <b>{{$package->st_price}}</b>
                                                    {{translate('Price_per')}} {{$item->price->st_name}}
                                                </li>
                                                <li>{{ payment()->currency_symbol }} <b>{{$package->sec_price}}</b>
                                                    {{translate('price_per')}} {{$item->price->sec_name}}
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endif
                </div>
                {{-- Reight Side --}}
                <div class="col-md-4">
                    @include('frontEnd.layouts._bookingForm')
                </div>
                {{-- Reight Side / Ending --}}
            </div>
        </div>
    </div>
@endsection
@section('_extra_css')
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css"/>
@endsection
@section('_extra_js')
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
    <script>
        $(document).on('click', '[data-toggle="lightbox"]', function (event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                maxHeight: 500
            });
        });
        $("a#scrollTo").on('click', function (event) {
            let scrollTo = $(this).attr('href');
            event.preventDefault();
            $('html, body').animate({
                scrollTop: ($(scrollTo).offset().top - 100)
            }, 500)
        });
    </script>
@endsection