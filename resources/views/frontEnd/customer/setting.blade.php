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
                        <li class="list-group-item active">
                            <a href="{{route('customer.setting')}}">
                                <i class="fa fa-user"></i> {{translate('Profile')}}
                            </a>
                        </li>
                        <li class="list-group-item ">
                            <a href="{{route('customer.password')}}">
                                <i class="fa fa-lock"></i> {{translate('Password')}}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9 customer-setting-details">
                    <h1>{{translate('Personal_information')}}</h1>
                    <form action="{{route('customer.setting')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <input class="form-control" name="name" value="{{$customer->name}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fas fa-at"></i>
                                        </div>
                                        <input class="form-control" name="email" value="{{$customer->email}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fas fa-mobile-alt"></i>
                                        </div>
                                        <input class="form-control" name="information[phone]"
                                               value="{{$customer->information->phone}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fas fa-location-arrow"></i>
                                        </div>
                                        <input class="form-control" name="information[address]"
                                               value="{{$customer->information->address}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>City</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fas fa-city"></i>
                                        </div>
                                        <input class="form-control" name="information[city]"
                                               value="{{$customer->information->city}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Country</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fas fa-flag"></i>
                                        </div>
                                        <input class="form-control" name="information[country]"
                                               value="{{$customer->information->country}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success btn-block">
                                    <i class="fas fa-save"></i> Update Information
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection