<section class="customer-login">
    <div class="login-area">
        <div class="login-container animated bounceInDown">
            <!-- bounceInDown bounceOutUp -->
            <i class="fa fa-times-circle" id="close-login"></i>
            <h2>Log in to A2ZTravel</h2>
            <span class="login-header-span">
            {{translate('Log_in_to_add_things_to_your_Wish_List_and_access_your_bookings_from_any_device.')}}
            </span>
            <a href="{{route('customer.facebook.redirect')}}" class="btn btn-block btn-social btn-facebook">
                <i class="fa fa-facebook"></i> {{translate('Log_in_with_Facebook')}}
            </a>
            <a class="btn btn-block btn-social btn-default">
                <i class="fa fa-google"></i> {{translate('Log_in_with_Google')}}
            </a>
            <span class="login-or">or</span>
            <form method="post" action="{{route('customer.login')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" class="form-control" name="email" value="" placeholder="Email address">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" value="" placeholder="Password">
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> {{translate('Remember_Me')}}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6 text-right">
                        <a href="{{route('customer.password.reset')}}" class="reset-password">
                            {{translate('Forgot_your_password?')}}
                        </a>
                    </div>
                </div>
                <button class="btn btn-success btn-block sign-up">{{translate('Log_in')}}</button>
            </form>
            <div class="sign-up-section">
                {{translate('New_here?')}} <a href="{{route('customer.register')}}">{{translate('Sign_up_here!')}}</a>
            </div>


        </div>
    </div>
</section>
@section('_extra_js')
    @parent
    <script>
        $(function () {
            let login = $("div.login-area");
            $("a#login").on('click', function (event) {
                event.preventDefault();
                open_closed_login();
            });
            $("i#close-login").on('click', function () {
                open_closed_login();
            });

            function open_closed_login() {
                if (login.is(':visible')) {
                    login.fadeOut();
                    return true;
                }
                login.show();

            }
        });
    </script>
@endsection