@extends('frontEnd.layouts._master')
@section('meta_tags')
    <title>{{ translate('Registration')}} | {{Request::getHost()}}</title>
@endsection
@section('header-nav')
    <div class="row insider-header-container-sp">
        @include('frontEnd.layouts._mainNav')
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="container">
            <div class="register-container">
                <span class="fa-stack">
                    <i class="fa fa-bookmark fa-stack-2x"></i>
                    <i class="fa fa-star fa-stack-1x fa-inverse"></i>
                </span>
                <h1>Start Enjoying the Rewards of Our Free Membership!</h1>
                <div class="row">
                    <div class="col-md-8 col-md-push-2">
                        <div>
                            <ul>
                                <li>Save up to 30% on selected activities</li>
                                <li>Sync your wish list across all devices</li>
                                <li>Cancel easily online for many activities</li>
                            </ul>
                            <a href="{{facebookLink()}}" class="btn btn-block btn-social btn-facebook">
                                <i class="fa fa-facebook"></i> Log in with Facebook
                            </a>
                            <a class="btn btn-block btn-social btn-default">
                                <i class="fa fa-google"></i>Log in with Google
                            </a>
                            <span class="login-or">or</span>
                            <form method="post" action="{{route('customer.register')}}" autocomplete="off">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" value="" placeholder="Full Name"
                                           autocomplete="off">
                                </div>
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <input type="email" class="form-control" name="email"
                                           value="" placeholder="Email address" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" value=""
                                           placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password_confirmation" value=""
                                           placeholder="Password">
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-left" style="padding-left: 0px;">
                                        <div class="checkbox icheck">
                                            <label>
                                                <input type="checkbox" name="newsletter" value="1">
                                                Receive travel tips and promotions
                                            </label>
                                        </div>

                                    </div>

                                </div>
                                <button class="btn btn-info btn-block btn-register">Create Account</button>
                            </form>
                            <div class="sign-up-section">
                                Already a member? <a href="#" id="login">Log in</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection