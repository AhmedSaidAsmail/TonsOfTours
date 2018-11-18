@extends('Web.Layouts.master')

@section('content')
<div class="main-box row">
    <div class="booking_method row">
        <div class="col-md-4 first-method"> <span>{{Vars::getVar('Add_to_cart') }}</span></div>
        <div class="col-md-4 second-methode"> <span>{{Vars::getVar('Review_order') }}</span></div>
        <div class="col-md-4 third-methode"> <span>{{Vars::getVar('Secure_checkout') }}</span></div>
    </div>
    <div id="list_refrence">
        <div class="left">
            <h1>{{Vars::getVar('Review_your_order') }}</h1>
            <div> {{Vars::getVar('Items_in_cart') }}: {{Session::has('cart')?Session::get('cart')->totalQty:0}}</div>
        </div>
        <div class="right">
            <div> {{Vars::getVar('Current_cart_total') }} </div>
            <h1><span>{{Vars::getVar('Currency_label') }}</span>{{$total}}</h1>
        </div>
    </div>
    <div id="trip_listing">
        @if (isset($items))
        @foreach ($items as $key=>$item)
        <div id="trip_item" class="row">
            <div class="col-md-8 col-xs-8 cart-item-left">
                <h1>{{App\MyModels\Admin\Item::find($key)->title}} </h1>
                <div class="row">
                    <div class="col-md-5 col-xs-5">
                        <img src="{{asset('images/items/thumb/'.App\MyModels\Admin\Item::find($key)->img)}}" />
                    </div>
                    <div class="col-md-7 col-xs-7">
                        <div> <span>{{Vars::getVar('Travel_date') }}:</span> {{$item['date']}}</div>
                        <div> <span>{{Vars::getVar('Number_of_Adult') }}:</span> {{$item['st_no']}}</div>
                        <div> <span>{{Vars::getVar('Number_of_Child') }}:</span> {{$item['sec_no']}}</div>
                        <a href="{{route('remove.from.cart',['id'=>$key])}}" id="remove-cart-item"><i class="fa fa-trash" aria-hidden="true"></i>{{Vars::getVar('remove') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-4 cart-item-right">
                <h1><span>&euro;</span>{{$item['price']}}</h1>
            </div>
        </div>
        @endforeach
        @endif

    </div>
    <div id="listing_next">
        <div class="left"> <a href="index.php">{{Vars::getVar('Continue_shopping') }}</a></div>
        <div class="right"> <a href="{{ route('Web.checkout') }}"> <img src="images/proceed2checkout.png" /></a></div>
    </div>
</div>
@endsection


