@extends('frontEnd.layouts._master')
@section('meta_tags')
    <meta name="keywords" content="{{ $mainCategory->keywords }}"/>
    <meta name="description" content="{{ $mainCategory->description }}"/>
    <title>{{ $mainCategory->title }}</title>
@endsection
@section('header-nav')
    <div class="row insider-header-container">
        @include('frontEnd.layouts._mainNav')
        <img class="aspect-img" src="{{asset('images/mainCategories/'.$mainCategory->img)}}"
             alt="{{$mainCategory->title}}">
        <div class="insider-header-contains">
            <div class="container">
                <ul class="list-inline dir">
                    <li>{{translate('WHERE_TO_GO')}}</li>
                    <li>{{$mainCategory->title}}</li>
                </ul>
                <h1>{{$mainCategory->title}}</h1>
            </div>
        </div>

    </div>
    @include('frontEnd.layouts._headerFooter')
@endsection
@section('content')
    <div class="row">
        <div class="container">
            <h1 class="main-title">{{translate('Top_Tours_&_Activities')}}</h1>
            <div class="row items-container">
                @foreach($topItems as $item)
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
            <h1 class="main-title">{{$mainCategory->title}} {{translate('Packages')}}</h1>
            <?php
            $slice_1 = $mainCategory->categories->slice(0, 2);
            $slice_2 = $mainCategory->categories->slice(2);
            ?>
            <div class="row items-container">
                @foreach($slice_1 as $category)
                    <div class="col-md-6">
                        <a href="{{route('home.category.show',['city'=>urlencodeLink($category->name),'id'=>$category->id])}}">
                            <div class="item-holder-first">
                                <img class="aspect-img" src="{{asset('images/categories/thumbMd/'.$category->img)}}"
                                     alt="{{$category->title}}">
                            </div>
                            <h2 class="item-title">{{$category->title}}</h2>
                        </a>
                    </div>
                @endforeach
            </div>
            @foreach($slice_2->chunk(4) as $chunk)
                <div class="row items-container">
                    @foreach($chunk as $category)
                        <div class="col-md-3">
                            <a href="{{route('home.category.show',['city'=>urlencodeLink($category->name),'id'=>$category->id])}}">
                                <div class="item-holder-second">
                                    <img class="aspect-img" src="{{asset('images/categories/thumbMd/'.$category->img)}}"
                                         alt="{{$category->title}}">
                                </div>
                                <h2 class="item-title">{{$category->title}}</h2>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach

        </div>
    </div>
@endsection