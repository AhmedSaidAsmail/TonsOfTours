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
                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-4 col-xs-4 checkout-refrences checkout-refrences-inactive">
                        {{ Vars::getVar("Add_to_Cart") }}
                        <div class="checkout-refrences-arrow"></div>
                        <div class="checkout-refrences-arrow-bg"></div>
                    </div>
                    <div class="col-md-4 col-xs-4 checkout-refrences checkout-refrences-inactive">
                        {{ Vars::getVar("Review_Orders") }}
                        <div class="checkout-refrences-arrow"></div>
                        <div class="checkout-refrences-arrow-bg"></div>
                    </div>
                    <div class="col-md-4 col-xs-4 checkout-refrences checkout-refrences-active">
                        {{ Vars::getVar("Secure_checkout") }}
                    </div>
                </div>

                @if(isset($success)&& $success=='approval' )
                <div class="row" style="margin-top: 20px;">
                    <h1>THANKS FOR BOOKING WITH US</h1>
                    <h3 style="color:#fe6500; margin-top: 15px; font-size: 18px; "><i class="fa fa-check"></i> We have received your email and our Customer Service team will be responding to you soon</h3>
                </div>
                @else
                <div class="row" style="margin-top: 20px;">

                    <h3 style="color:#fe6500; margin-top: 15px; font-size: 18px; "><i class="fa fa-close"></i> oops something went wrong</h3>
                </div>
                @endif
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

});
</script>
@endsection