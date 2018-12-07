@extends('frontEnd.layouts._master')
@section('meta_tags')
    <meta name="keywords" content="{{ $category->keywords }}"/>
    <meta name="description" content="{{ $category->description }}"/>
    <title>{{ $category->title }}</title>
@endsection
@section('header-nav')
    <div class="row insider-header-container">
        @include('frontEnd.layouts._mainNav')
        <img class="aspect-img" src="{{asset('images/categories/'.$category->img)}}"
             alt="{{$category->title}}">
        <div class="insider-header-contains">
            <div class="container">
                <ul class="list-inline dir">
                    <li>{{translate('WHERE_TO_GO')}}</li>
                    <?php
                    $mainCategory = $category->mainCategory;
                    ?>
                    <li>
                        <a href="{{route('home.mainCategory.show',['name'=>urlencodeLink($mainCategory->name),'id'=>$mainCategory->id])}}">
                            {{$mainCategory->title}}
                        </a>
                    </li>
                    <li>{{$category->title}}</li>
                </ul>
                <h1>{{$category->title}}</h1>
            </div>
        </div>

    </div>
    @include('frontEnd.layouts._headerFooter')
@endsection
@section('content')
    <div class="row">
        <div class="container">
            <h1 class="main-title">{{$category->title}}</h1>
            @foreach($category->items->chunk(3) as $chunk)
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
                                            {{sprintf('%.2f',$item->cheapestPrise()->st_price)}}
                                        @endif
                                        <span>{{ payment()->currency_symbol }}</span>
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
    @include('frontEnd.layouts._freeCancellationLayer')
    <div class="row">
        <div class="container">
            <div class="more-ideas">
                <h1>{{translate('Find_More_Travel_Ideas')}}</h1>
                <ul class="list-inline text-center">
                    <?php $number = 1; ?>
                    @foreach($otherCategories as $otherCategory)
                        <li>
                            <a href="{{route('home.category.show',['city'=>urlencodeLink($otherCategory->name),'id'=>$otherCategory->id])}}"
                               class="label-container">
                                <span class="label-number">{{$number}}</span>
                                <span class="label-title">{{$otherCategory->name}}</span>
                            </a>
                        </li>
                        <?php $number++; ?>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
