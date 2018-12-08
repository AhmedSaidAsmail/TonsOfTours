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
            <div class="booking-success">
                <h1>
                    <i class="fas fa-check"></i> {{translate('Your_booking_is_done_!')}}
                </h1>
                <span class="booking-msg">{{translate('Thank you for booking with us')}}</span>

                <h2>{{translate('Payment Details')}}</h2>
                <div class="payment-details">
                    <div class="row">
                        <div class="col-md-6">
                            <span>{{translate('Total Amount')}}:</span>
                            {{$reservation->total}} {{payment()->currency_symbol}}
                        </div>
                        <div class="col-md-6">
                            <span>{{translate('Deposit Amount')}}:</span>
                            {{$reservation->deposit}} {{payment()->currency_symbol}}
                        </div>
                    </div>
                    @if(!is_null($reservation->paymentId))
                        <div class="row">
                            <div class="col-md-6">
                                <span>{{translate('Payment Method')}}:</span>
                                {{$reservation->payment_method}}
                            </div>
                            <div class="col-md-6">
                                <span>{{translate('Transaction ID')}}:</span>
                                {{$reservation->paymentId}}
                            </div>
                        </div>
                    @endif
                </div>
                <span class="booking-email-notify">
                    {{translate('We have sent your booking details to')}} {{$reservation->customer->email}}
                </span>
            </div>
        </div>
    </div>
@endsection