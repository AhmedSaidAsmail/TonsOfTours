@extends('frontEnd.layouts._master')
@section('meta_tags')
    <title>{{ translate('Password_reset')}} | {{Request::getHost()}}</title>
@endsection
@section('header-nav')
    <div class="row insider-header-container-sp">
        @include('frontEnd.layouts._mainNav')
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="container">
            <div class="row customer-setting-form">
                <div class="col-md-9 customer-setting-details">
                    <h1>{{translate('Reset_Password')}}</h1>
                    <span class="reset-password-txt">Enter the email address associated with your account and we'll send you a link to reset your password.</span>
                    <form action="{{route('customer.password.reset')}}" method="post">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fas fa-at"></i>
                                        </div>
                                        <input class="form-control" name="email" value=""
                                               autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <button class="btn btn-primary btn-block">
                                    Send Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection