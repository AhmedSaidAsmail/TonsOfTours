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
            <div class="row cart-items-holder">
                <div class="col-md-8 checkout-form">
                    <h3>
                        Checkout
                        <span>all fields are required</span>
                    </h3>
                    <?php
                    $customer_id = null;
                    $first_name = null;
                    $last_name = null;
                    $email = null;
                    $phone = null;
                    if (Auth::guard('customer')->check()) {
                        $customer = Auth::guard('customer')->user();
                        $customer_id = $customer->id;
                        $first_name = substr(trim($customer->name), 0, strpos(trim($customer->name), " "));
                        $last_name = substr(trim($customer->name), strpos(trim($customer->name), " ") + 1);
                        $email = $customer->email;
                        $phone = $customer->information->phone;
                    }
                    ?>
                    <form action="{{route('cart.checkout')}}"
                          method="post" {!! $cart->deposit>0?'id="checkOutForm"':null !!}>
                        {{csrf_field()}}
                        <input id="token" name="token" type="hidden" value="">
                        <input type="hidden" name="deposit" value="{{$cart->deposit}}">
                        <input type="hidden" name="total" value="{{$cart->total}}">
                        <input type="hidden" name="currency" value="{{payment()->currency}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input class="form-control" name="first_name" value="{{$first_name}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input class="form-control" name="last_name" value="{{$last_name}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="{{$email}}" required>
                                    <div class="help-block">
                                        This is where we will send the booking confirmation
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input class="form-control" name="phone" value="{{$phone}}" required>
                                    <div class="help-block">
                                        The tour operator will call this number if they need to reach you.
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($cart->deposit>0)
                            {{-- Payment options--}}
                            @include('frontEnd.cart.layouts.paymentOptions')
                            {{-- 2Checkout form fields--}}
                            @include('frontEnd.cart.layouts.2checkoutForm')
                        @endif
                        @include('frontEnd.cart.layouts.checkoutSubmitButton')
                    </form>
                </div>
                <div class="col-md-4 checkout-review">
                    <h3>{{translate('Review_Order_Details')}}</h3>
                    <section>
                        @foreach($cart->all() as $item)
                            <?php
                            $model = getItem($item->item_id);
                            ?>
                            <div class="row checkout-review-item">
                                <div class="col-md-7 col-xs-7 checkout-review-item-details">
                                    <h2>{{$model->title}}</h2>
                                    @if($item->st_num)
                                        <span>
                                        <label class="numbers">{{$item->st_num}}</label>
                                            {{$item->st_name}} ×
                                            <label class="numbers">{{payment()->currency_symbol}}{{sprintf('%.2f',$item->st_price)}}</label>
                                            {{payment()->currency}}
                                    </span>
                                    @endif
                                    @if($item->sec_num)
                                        <span>
                                        <label class="numbers">{{$item->sec_num}}</label>
                                            {{$item->sec_name}} ×
                                            <label class="numbers">{{payment()->currency_symbol}}{{sprintf('%.2f',$item->sec_price)}}</label>
                                            {{payment()->currency}}
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-5 col-xs-5 checkout-review-item-prices">
                                    <span>{{translate('Total')}}
                                        :</span> {{payment()->currency_symbol.sprintf('%.2f',$item->total)}}
                                    @if($item->deposit>0)
                                        <span>{{translate('Deposit_Due')}}
                                            :</span> {{payment()->currency_symbol.sprintf('%.2f',$item->deposit)}}
                                    @else
                                        <span>{{translate('No_Deposit')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row checkout-review-cancel">
                                <div class="col-md-12">
                                    <i class="fas fa-check"></i> {{translate('Free_cancellation_before')}}
                                    {{\Carbon\Carbon::parse($item->date)->subDay(2)->format('l, M d, Y')}}
                                </div>
                            </div>
                        @endforeach
                    </section>
                    <section class="checkout-review-total">
                        <div class="row">
                            <div class="col-md-6">
                                <span>{{translate('total')}}</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <label>{{payment()->currency_symbol.sprintf('%.2f',$cart->total)}} {{payment()->currency}}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span>{{translate('Deposit_due')}}</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <label>{{payment()->currency_symbol.sprintf('%.2f',$cart->deposit)}} {{payment()->currency}}</label>
                            </div>
                        </div>
                    </section>
                    <section>
                        <ul class="checkout-notify">
                            <li>
                                <span>{{translate('Lowest_Price_Guarantee')}}</span>
                                {{translate("Find_it_cheaper?_We'll_refund_the_difference")}}
                            </li>
                            <li>
                                <span>{{translate('24/7_Global_Support')}}</span>
                                {{translate('Get_the_answers_you_need,_when_you_need_them')}}
                            </li>
                            <li>
                                <span>{{translate('Book_Securely')}}</span>
                                <i class="fas fa-lock"></i> {{translate('We_use_SSL_encryption_to_keep_your_data_secure')}}
                            </li>
                        </ul>
                    </section>
                    <div class="having-trouble">
                        <span>{{translate('Having_trouble_booking_online?')}}</span>
                        <span>{{translate('Call')}} {{translate('info_phone')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
