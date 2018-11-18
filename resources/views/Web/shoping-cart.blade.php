@extends('Web.Layouts._master')
@section('meta_tags')
<?php $meta = App\MyModels\Admin\Topic::where('name', 'Home')->first() ?>
<meta name="keywords" content="{{ $meta->keywords }}" />
<meta name="description" content="{{ $meta->description }}" />
<title>{{ $meta->title }}</title>
@endsection
@section('header-nav')
@include('Web.nav-menu')
@endsection
@section('content')
<div class="row exc-container">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row" style="margin-bottom: 20px; border: 1px outset #6a97ae; border-radius: 10px; overflow: hidden;">
                    <div class="col-md-4 col-xs-4 checkout-refrences checkout-refrences-inactive">
                        <i class="fa fa-cart-plus"></i> {{ Vars::getVar("Add_to_Cart") }}
                        <div class="checkout-refrences-arrow"></div>
                        <div class="checkout-refrences-arrow-bg"></div>
                    </div>
                    <div class="col-md-4 col-xs-4 checkout-refrences checkout-refrences-active">
                        <i class="fa fa-users" aria-hidden="true"></i> {{ Vars::getVar("Review_Orders") }}
                        <div class="checkout-refrences-arrow"></div>
                        <div class="checkout-refrences-arrow-bg"></div>
                    </div>
                    <div class="col-md-4 col-xs-4 checkout-refrences checkout-refrences-inactive">
                        <i class="fa fa-lock"></i> {{ Vars::getVar("Secure_checkout") }}
                    </div>
                </div>
                <!-- end directory -->
                <div class="row">
                    <div class="col-md-12 review-orders-header"><i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ Vars::getVar("Review_Your_Orders") }}</div>
                </div>
                <div class="row">
                    <div class="col-md-12 review-orders-table">
                        <div class="row review-orders-table-items review-orders-gray">
                            <div class="col-md-9">
                                {{Vars::getVar('Subtotal')}}
                            </div>
                            <div class="col-md-3">{{sprintf('%.2f',$total)}} {{ Vars::getVar("$") }}</div>
                        </div>
                        <div class="row review-orders-table-items review-orders-white">
                            <div class="col-md-9">
                                {{Vars::getVar('Deposit')}}
                            </div>
                            <div class="col-md-3">{{sprintf('%.2f',$total*$percent/100)}}</div>
                        </div>
                        <div class="row review-orders-table-items review-orders-blue">
                            <div class="col-md-9">
                                <i class="fa fa-money" aria-hidden="true"></i> {{Vars::getVar('Total')}}
                            </div>
                            <div class="col-md-3">{{sprintf('%.2f',$total)}} {{ Vars::getVar("$") }}</div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="row" style="margin-bottom: 5px;">
                        <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                            <a href="{{route('home')}}" class="btn btn-primary btn-block" style="font-size: 17px;"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ Vars::getVar("Continue_shopping") }}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right" style="padding-left: 0px; padding-right: 0px;">
                            <a href="{{route('Web.checkout')}}" class="btn btn-success btn-block" style="font-size: 17px;"><i class="fa fa-check" aria-hidden="true"></i> {{ Vars::getVar("Proceed_to_Checkout") }}</a>
                        </div>
                    </div>
                    @if (isset($items))
                    @foreach ($items as $key=>$item)
                    @if(isset($item['dist_from']))
                    <div class="row review-items">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>
                                    Transfer From {{$item['dist_from']}} To {{$item['dist_to']}}
                                </h1>
                            </div>
                        </div>
                        <div class="row review-all-details">
                            <div class="col-md-4">

                                <img src="{{asset('images/Airport-Transfer.jpg')}}" style="width: 100%;" alt="">
                            </div>
                            <div class="col-md-5 review-item-details">
                                <div class="col-md-12">
                                    {{ vars::getVar("Date") }}: {{$item['date']}}
                                </div>

                                <div class="col-md-12">
                                    {{ vars::getVar("Transfer_Type") }}:{{vars::getVar($item['transfer_type'])}}
                                </div>
                                <div class="col-md-12">
                                    @if($item['transfer_times']==2)
                                    {{ vars::getVar("Go/Return") }}
                                    @else
                                    {{ vars::getVar("One_Way") }}
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    {{ vars::getVar("Pax") }}: {{$item['pax']}}
                                </div>
                                <div class="col-md-12">
                                    <a href="{{route('remove.from.cart',['id'=>$key])}}" id="remove-cart-item"><i class="fa fa-trash" aria-hidden="true"></i> {{Vars::getVar('remove') }}</a>
                                </div>
                            </div>
                            <div class="col-md-3 review-item-price">
                                {{sprintf('%.2f',$item['price'])}} <span>{{ Vars::getVar("$") }}</span>
                            </div>
                        </div>
                    </div>
                    @else
                    <!-- tours items review -->
                    <div class="row review-items">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>
                                    {{App\MyModels\Admin\Item::find($key)->title}}
                                </h1>
                            </div>
                        </div>
                        <div class="row review-all-details">
                            <div class="col-md-4">

                                <img src="{{asset('images/items/thumb/'.App\MyModels\Admin\Item::find($key)->img)}}" style="width: 100%;" alt="{{App\MyModels\Admin\Item::find($key)->title}}">
                            </div>
                            <div class="col-md-5 review-item-details">
                                <div class="col-md-12">
                                    {{Vars::getVar('Travel_date') }}: {{$item['date']}}
                                </div>
                                <div class="col-md-12">
                                    {{Vars::getVar('Number_of_Adult') }}: {{$item['st_no']}}
                                </div>
                                <div class="col-md-12">
                                    {{Vars::getVar('Number_of_Child') }}: {{$item['sec_no']}}
                                </div>
                                <div class="col-md-12">
                                    <a href="{{route('remove.from.cart',['id'=>$key])}}" id="remove-cart-item"><i class="fa fa-trash" aria-hidden="true"></i> {{Vars::getVar('remove') }}</a>
                                </div>
                            </div>
                            <div class="col-md-3 review-item-price">
                                {{sprintf('%.2f',$item['price'])}} <span>{{ Vars::getVar("$") }}</span>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="col-md-4">
                @include('Web.Layouts.TrnasferForm')
                <div class="row">
                    <div class="col-md-12 youtube-holder">
                        <iframe id="youtube"  height="315" src="https://www.youtube.com/embed/jnfwoGw3fnU" frameborder="0" allowfullscreen></iframe>
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
@section('_extra_css')

<link rel="stylesheet" href="{{asset('adminlte/plugins/daterangepicker/daterangepicker.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/select2/select2.min.css')}}">
@endsection
@section('_extra_js')
<script src="{{asset('adminlte/plugins/select2/select2.full.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script>
$(function() {
//Initialize Select2 Elements
    $(".select2").select2();
    $('#reservation').daterangepicker({
        startDate: new Date(),
        minDate: new Date()

    });

});
</script>
@endsection