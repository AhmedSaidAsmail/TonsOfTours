@extends('Admin.Layouts._master')
@section('title','Payment Settings')
@section ('Extra_Css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1> Payment
                <small>Payment Details</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel </a></li>
                <li><a href="#">Payment</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <span>Default Deposit Percentage</span>
                        </div>
                        <div class="box-body">
                            @if(!is_null($payment_setting))
                                <form method="post" id="depositDelete"
                                      action="{{route('setting.payment.payment-setting.destroy',['id'=>$payment_setting->id])}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                </form>
                                <form method="post"
                                      action="{{route('setting.payment.payment-setting.update',['id'=>$payment_setting->id])}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Currency</label>
                                                <select name="currency" class="form-control">
                                                    <option value="">Select Currency</option>
                                                    @foreach($currencies as $sympole=>$currency)
                                                        <option value="{{$sympole}}"{!! $payment_setting->currency_symbol==$sympole?"selected":null !!}>{{$currency}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Percentage</label>
                                                <input class="form-control" name="default_percentage"
                                                       value="{{$payment_setting->default_percentage}}">
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="padding-top: 25px;">
                                            <ul class="list-inline">
                                                <li>
                                                    <button class="btn btn-success">
                                                        <i class="fa fa-save"></i>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="btn btn-danger" form="depositDelete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <form method="post" action="{{route('setting.payment.payment-setting.store')}}">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Currency</label>
                                                <select name="currency" class="form-control">
                                                    <option value="">Select Currency</option>
                                                    @foreach($currencies as $sympole=>$currency)
                                                        <option value="{{$sympole}}">{{$currency}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Percentage</label>
                                                <input class="form-control" name="default_percentage" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="padding-top: 25px;">
                                            <button class="btn btn-success"><i class="fa fa-save"></i></button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header with-border">
                            <span>Paypal</span>
                        </div>
                        <div class="box-body">
                            @if(!is_null($paypal))
                                <form method="post" id="paypalDelete"
                                      action="{{route('setting.payment.paypal.destroy',['id'=>$paypal->id])}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                </form>
                                <form method="post"
                                      action="{{route('setting.payment.paypal.update',['id'=>$paypal->id])}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label style="display: block">Sandbox</label>
                                                <input type="checkbox" name="sandbox"
                                                       value="1" {!! $paypal->sandbox?'checked':null !!}>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Client ID</label>
                                                <input class="form-control" name="client_id"
                                                       value="{{$paypal->client_id}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Secret</label>
                                                <input class="form-control" name="secret" value="{{$paypal->secret}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input class="form-control" name="description"
                                                       value="{{$paypal->description}}">
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="padding-top: 25px;">
                                            <ul class="list-inline">
                                                <li>
                                                    <button class="btn btn-success">
                                                        <i class="fa fa-save"></i> Update
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="btn btn-danger" form="paypalDelete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </form>
                            @else
                                <form method="post"
                                      action="{{route('setting.payment.paypal.store')}}">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label style="display: block">Sandbox</label>
                                                <input type="checkbox" name="sandbox"
                                                       value="1">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Client ID</label>
                                                <input class="form-control" name="client_id" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Secret</label>
                                                <input class="form-control" name="secret" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input class="form-control" name="description" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="padding-top: 25px;">
                                            <ul class="list-inline">
                                                <li>
                                                    <button class="btn btn-success">
                                                        <i class="fa fa-save"></i> Save
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                    {{--  2 checkout--}}
                    <div class="box">
                        <div class="box-header with-border">
                            <span>2 Checkout</span>
                        </div>
                        <div class="box-body">
                            @if(!is_null($two_checkout))
                                <form method="post" id="checkoutDelete"
                                      action="{{route('setting.payment.two-checkout.destroy',['id'=>$two_checkout->id])}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                </form>
                                <form method="post"
                                      action="{{route('setting.payment.two-checkout.update',['id'=>$two_checkout->id])}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label style="display: block">Sandbox</label>
                                                <input type="checkbox" name="sandbox"
                                                       value="1" {!! $two_checkout->sandbox?'checked':null !!}>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label style="display: block">SSL</label>
                                                <input type="checkbox" name="ssl"
                                                       value="1" {!! $two_checkout->ssl?'checked':null !!}>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Partner ID</label>
                                                <input class="form-control" name="partner_id"
                                                       value="{{$two_checkout->partner_id}}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Public Key</label>
                                                <input class="form-control" name="public_key"
                                                       value="{{$two_checkout->public_key}}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Private Key</label>
                                                <input class="form-control" name="private_key"
                                                       value="{{$two_checkout->private_key}}">
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="padding-top: 25px;">
                                            <ul class="list-inline">
                                                <li>
                                                    <button class="btn btn-success">
                                                        <i class="fa fa-save"></i> Update
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="btn btn-danger" form="checkoutDelete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <form method="post"
                                      action="{{route('setting.payment.two-checkout.store')}}">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label style="display: block">Sandbox</label>
                                                <input type="checkbox" name="sandbox"
                                                       value="1">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label style="display: block">SSL</label>
                                                <input type="checkbox" name="ssl"
                                                       value="1">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Partner ID</label>
                                                <input class="form-control" name="partner_id"
                                                       value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Public Key</label>
                                                <input class="form-control" name="public_key" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Private Key</label>
                                                <input class="form-control" name="private_key" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="padding-top: 25px;">
                                            <ul class="list-inline">
                                                <li>
                                                    <button class="btn btn-success">
                                                        <i class="fa fa-save"></i> Save
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection