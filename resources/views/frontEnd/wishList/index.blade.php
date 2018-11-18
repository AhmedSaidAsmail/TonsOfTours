@extends('frontEnd.layouts._master')
@section('meta_tags')
    <title>{{ translate('Wish_List')}} | {{Request::getHost()}}</title>
@endsection
@section('header-nav')
    <div class="row insider-header-container-sp">
        @include('frontEnd.layouts._mainNav')
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="container">
            <div class="wish-list-container">
                <h1 class="main-wish-list-title">{{translate('My_Wish_list')}}</h1>
                <span class="wish-list-count"><i class="far fa-heart"></i> {{count($wishLists)}}</span>
                @foreach($wishLists as $wishList)
                    <?php
                    $link = route('home.item.show', [
                        'category' => urlencodeLink($wishList->item->category->name),
                        'name' => urlencodeLink($wishList->item->name),
                        'id' => $wishList->item->id]);
                    ?>
                    <div class="row wish-list-holder">
                        <a href="{{route('wish-list.destroy',['id'=>$wishList->id])}}" class="wish-list-remove">
                            <i class="fas fa-times"></i>
                        </a>
                        <div class="wish-list-price">
                            {{translate('From')}}
                            <span>{{translate('$')}} {{sprintf('%.2f',$wishList->item->price->st_price)}}</span>
                        </div>
                        <div class="col-md-3 wish-list-img">
                            <img src="{{asset('images/items/thumbMd/'.$wishList->item->img)}}"
                                 alt="{{$wishList->item->title}}" class="aspect-img">
                        </div>
                        <div class="col-md-9 wish-list-details">
                            <h1>{{$wishList->item->title}}</h1>
                            {{str_limit($wishList->item->intro,150,'...')}}
                            <a href="{{$link}}">{{translate('read_more')}}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection