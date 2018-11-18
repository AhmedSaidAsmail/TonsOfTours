@extends('frontEnd.layouts._master')
@section('meta_tags')
    <title>{{ translate('Password_reset')}} | {{Request::getHost()}}</title>
@endsection
@section('header-nav')
    <div class="row insider-header-container-sp">
        @include('frontEnd.layouts._mainNav')
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="container">
            <h1 class="sent-email-success">{{translate('Reset_password_link_has_been_sent_to_your_email_successfully')}}</h1>
            <h1 class="main-title">{{translate('Top_Tours_&_Activities')}}</h1>
            @foreach(topTours()->chunk(3) as $chunk)
                <div class="row items-container">
                    @foreach($chunk as $item)
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
        </div>
    </div>
@endsection