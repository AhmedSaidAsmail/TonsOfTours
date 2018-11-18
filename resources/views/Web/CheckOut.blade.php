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
                    <div class="col-md-4 col-xs-4 checkout-refrences checkout-refrences-inactive">
                        <i class="fa fa-users" aria-hidden="true"></i> {{ Vars::getVar("Review_Orders") }}
                        <div class="checkout-refrences-arrow"></div>
                        <div class="checkout-refrences-arrow-bg"></div>
                    </div>
                    <div class="col-md-4 col-xs-4 checkout-refrences checkout-refrences-active">
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


                <form action="{{route('finalCheckOut')}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <input type="hidden" name="deposit" value="{{$total*$percent/100}}">
                    <input type="hidden" name="total" value="{{$total}}">
                    <div class="box">

                        <div class="box-body" style="border: 1px solid #000; padding-top: 20px; margin-top: 20px; background-color: #FFF;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ Vars::getVar("First_Name") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input class="form-control" name="f_name" value="" placeholder="Enter Your Full Name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ Vars::getVar("Family_Name") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input class="form-control" name="sur_name" value="" placeholder="Enter Your Full Name" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ Vars::getVar("Email") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-inbox"></i>
                                            </div>

                                            <input class="form-control" type="email" name="email" value="" placeholder="Enter Your Email Address" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ Vars::getVar("Mobile") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input type="text" class="form-control" name="mobile" data-inputmask="'mask': ['999-999-9999 [x99999]', '+99 999 999 99999999']" data-mask required>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ Vars::getVar("Hotel") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-hotel"></i>
                                            </div>
                                            <input type="text" class="form-control" name="hotel" >
                                        </div>

                                    </div>
                                </div>
                            </div>

                            @if($transferExist==true)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ Vars::getVar("Arrival_Flight_No") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-plane"></i>
                                            </div>
                                            <input type="text" class="form-control" name="arrival_flight_no" >
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ Vars::getVar("Arrival_Flight_Time") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                            <input type="text" class="form-control" name="arrival_flight_time" >
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @if($transferTimes==true)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ Vars::getVar("Departure_Flight_No") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-plane"></i>
                                            </div>
                                            <input type="text" class="form-control" name="departure_flight_no" >
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ Vars::getVar("Departure_Flight_Time") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                            <input type="text" class="form-control" name="departure_flight_time" >
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endif
                            @endif


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ Vars::getVar("Departure_&_arrival_date-time") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                            <input type="text" name="date" class="form-control pull-right" id="reservationtime">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-success btn-block" style="font-size: 18px;">
                                            @if($percent>0)
                                            <i class="fa fa-paypal"></i>
                                            @else
                                            <i class="fa fa-check"></i>
                                            @endif
                                            {{ Vars::getVar("CheckOut") }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>





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

<link rel="stylesheet" href="{{asset('adminlte/plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/daterangepicker/daterangepicker.css')}}">
@endsection
@section('_extra_js')
<script src="{{asset('adminlte/plugins/select2/select2.full.min.js')}}"></script>
<!-- Input Mask -->

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
    // data range
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'DD/MM/YYYY h:mm A'});

});
</script>
@endsection