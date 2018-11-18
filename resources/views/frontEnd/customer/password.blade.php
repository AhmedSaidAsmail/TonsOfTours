@extends('frontEnd.layouts._master')
@section('meta_tags')
    <title>{{ translate('Settings')}} | {{Request::getHost()}}</title>
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
                <div class="col-md-3 setting-links-holder">
                    <ul class="list-group list-group-sp">
                        <li class="list-group-item">
                            <a href="{{route('customer.booking')}}">
                                <i class="fas fa-plane-departure"></i> {{translate('Bookings')}}
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{route('customer.setting')}}">
                                <i class="fa fa-user"></i> {{translate('Profile')}}
                            </a>
                        </li>
                        <li class="list-group-item active">
                            <a href="{{route('customer.password')}}">
                                <i class="fa fa-lock"></i> {{translate('Password')}}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9 customer-setting-details">
                    <h1>{{translate('Password')}}</h1>
                    <form action="{{route('customer.password')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <input type="password" class="form-control" name="password" value=""
                                               autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fas fa-at"></i>
                                        </div>
                                        <input type="password" class="form-control" name="password_confirmation"
                                               value="" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success btn-block">
                                    <i class="fas fa-save"></i> Update Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection