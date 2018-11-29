@extends('Admin.Layouts._master')
@section('title','Items Panel')
@section ('Extra_Css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Directory&Header -->
        <section class="content-header">
            <h1> Reservations
                <small>Reservations Details</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
                <li><a href="#">Reservations</a></li>
            </ol>
        </section>
        <!-- end Directory&Header -->
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <!-- box -->

                    <!-- end box 1 -->
                    <!-- /.box -->
                    <div class="box">
                        <div class="box-header">
                            Reservation Details
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-2">Name:</div>
                                <div class="col-md-4">{{$reservation->customer->name}}</div>
                                <div class="col-md-2">Email:</div>
                                <div class="col-md-4">{{$reservation->customer->email}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Mobile:</div>
                                <div class="col-md-4">{{$reservation->customer->information->phone}}</div>
                                <div class="col-md-2">Date:</div>
                                <div class="col-md-4">{{date('l, M d, Y',strtotime($reservation->date))}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Total:</div>
                                <div class="col-md-4">{{$reservation->total.$reservation->currency}}</div>
                                <div class="col-md-2">Deposit:</div>
                                <div class="col-md-4">{{$reservation->deposit.$reservation->currency}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Approval:</div>
                                <div class="col-md-4">
                                    @if($reservation->approval)
                                        <i class="fa fa-check fa-2x text-success"></i>
                                    @else
                                        <i class="fa fa-times fa-2x text-danger"></i>
                                    @endif
                                </div>
                                <div class="col-md-2">Payment Method</div>
                                <div class="col-md-4">{{$reservation->payment_method}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Transaction ID:</div>
                                <div class="col-md-4">{{$reservation->paymentId}}</div>
                                <div class="col-md-2">Order number:</div>
                                <div class="col-md-4">{{$reservation->orderNumber}}</div>
                            </div>
                        </div>
                    </div>
                    @foreach($reservation->items as $item)
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>{{$item->item->title}}</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">Total:</div>
                                    <div class="col-md-2">{{$item->total}}</div>
                                    <div class="col-md-2">Deposit:</div>
                                    <div class="col-md-2">{{$item->deposit}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-inline">
                                            <li>{{$item->st_num}} {{$item->st_name}} * {{$item->st_price}}</li>
                                            <li>{{$item->sec_num}} {{$item->sec_name}} * {{$item->sec_price}}</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-2">Date</div>
                                    <div class="col-md-4">{{date('l, M d, Y',strtotime($item->date))}}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    </div>
@endsection


