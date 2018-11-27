@extends('frontEnd.layouts._master')
@section('meta_tags')
    <title>{{ translate('Shopping_Cart')}} | {{Request::getHost()}}</title>
@endsection
@section('header-nav')
    <div class="row insider-header-container-sp">
        @include('frontEnd.layouts._mainNav')
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="container">
            @if($cart->qty>0)
                <h1 class="cart-header">
                    {{translate('Hooray,_you’ve_successfully_added')}} {{$cart->qty}} {{translate('item_to_your_cart.')}}
                </h1>
                <h2 class="cart-header">{{translate('Only_2_more_steps_to_go!')}}</h2>
                <span class="cart-cookie-notify">
                <i class="fa fa-clock-o"></i>
                    {{translate('Once_you_add_an_activity_to_your_cart,_we_will_save_your_spot_for_60_minutes.')}}
            </span>
                <div class="row cart-items-holder">
                    <div class="col-md-8">
                        @foreach($cart->items()->all() as $key=>$item)
                            <div class="cart-item">
                                <div class="row cart-item-details">
                                    <div class="cart-item-remove">
                                        <a href="{{route('cart.item.remove',['key'=>$key])}}">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                    <div class="cart-item-price">
                                        <sub>
                                            <span>Total:</span> {{$item->currency}}{{sprintf('%.2f',$item->total)}}
                                        </sub>
                                        <sub>
                                            @if($item->deposit>0)
                                                <span>Deposit Due:</span> {{$item->currency}}{{sprintf('%.2f',$item->deposit)}}
                                            @else
                                                <span>No Deposit</span>
                                            @endif
                                        </sub>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="item-card-img">
                                            <img src="{{asset('images/items/thumbSm/'.$item->model->img)}}"
                                                 class="aspect-img" alt="{{$item->model->title}}">
                                        </div>
                                    </div>
                                    <div class="col-md-10 cart-details">
                                        <h2>{{$item->title}}</h2>
                                        <span>{{$item->date}}</span>
                                        @if($item->st_num)
                                            <span>
                                            <label class="numbers">{{$item->st_num}}</label>
                                                {{$item->st_name}} ×
                                            <label class="numbers">{{$item->currency}}{{sprintf('%.2f',$item->st_price)}}</label>
                                                {{translate('USD')}}
                                        </span>
                                        @endif
                                        @if($item->sec_num)
                                            <span>
                                            <label class="numbers">{{$item->sec_num}}</label>
                                                {{$item->sec_name}} ×
                                            <label class="numbers">{{$item->currency}}{{sprintf('%.2f',$item->sec_price)}}</label>
                                                {{translate('USD')}}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="cart-item-footer row">
                                    <div class="col-md-12">
                                        {{translate('Book_without_regrets!')}}
                                        <label>{{translate('Cancel_your_activity_for_free_any_time_up_until')}}
                                            {{\Carbon\Carbon::parse($item->date)->subDay(2)->format('l, M d, Y')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-4">
                        <div class="cart-all-total">
                        <span class="cart-header-total">
                            Total ({{$cart->qty}} items):
                            <label>{{translate('$')}}{{sprintf('%.2f',$cart->total)}}</label>
                        </span>
                            <span class="cart-header-total">
                            Total Deposit:
                            <label>{{translate('$')}}{{sprintf('%.2f',$cart->deposit)}}</label>
                        </span>
                            <span>No additional fees.</span>
                            <a href="{{route('cart.checkout')}}"
                               class="btn btn-info btn-block">Checkout</a>
                            <div class="cart-all-bottom">
                                <a href="{{route('customer.register')}}">Create an account</a>
                                or
                                <a href="{{route('customer.login')}}" id="login_now">log in</a>
                                <span>for faster checkout.</span>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="empty-cart">
                    <h1>Your cart is empty.</h1>
                    <span>The world is waiting for you. Fill up on amazing things to do in egypt.</span>
                    <a class="btn btn-primary btn-block" href="{{route('home')}}">
                        Continue Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection