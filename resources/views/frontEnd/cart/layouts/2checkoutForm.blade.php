@if(payment()->hasTwoCheckout)
    <section class="checkout-form-section" id="credit-section">
        <h3>{{translate('Payment_Details')}}</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Cardholder Name*</label>
                    <input class="form-control" name="credit[name]" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Credit Card Number*</label>
                    <input class="form-control" name="credit[cc_no]" id="ccNo" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Expiration Date*</label>
                    <select name="credit[cc_expire_month]" class="form-control" id="expMonth"
                            required>
                        <option value="">MM</option>
                        @for($i=1;$i<=12;$i++)
                            <option value="{{sprintf('%02d',$i)}}">{{sprintf('%02d',$i)}}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>-</label>
                    <select name="credit[cc_expire_year]" class="form-control" id="expYear"
                            required>
                        <option value="">YYYY</option>
                        @for($i=0;$i<20;$i++)
                            <option value="{{\Carbon\Carbon::now()->addYear($i)->format('Y')}}">
                                {{\Carbon\Carbon::now()->addYear($i)->format('Y')}}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>CVV Number*</label>
                    <input class="form-control" name="credit[ccv]" id="cvv" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Country*</label>
                    <select name="credit[country]" class="form-control">
                        @include('frontEnd.cart.layouts.countryList')
                    </select>
                </div>
            </div>
        </div>
    </section>
@endif
@section('_extra_js')
    @parent
    @if(payment()->hasTwoCheckout)
        <script src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
        <script>
            let successCallback = function (data) {
                let form = document.getElementById('checkOutForm');
                form.token.value = data.response.token.token;
                form.submit();
            };
            let errorCallback = function (data) {
                if (data.errorCode === 200) {
                    tokenRequest();
                } else {
                    alert(data.errorMsg);
                }
            };
            let tokenRequest = function () {
                let args = {
                    sellerId: "{{payment()->twoCheckout->getAllAttr()['partner_id']}}",
                    publishableKey: "{{payment()->twoCheckout->getAllAttr()['public_key']}}",
                    ccNo: $("#ccNo").val(),
                    cvv: $("#cvv").val(),
                    expMonth: $("#expMonth").val(),
                    expYear: $("#expYear").val()
                };
                // Make  token request
                TCO.requestToken(successCallback, errorCallback, args);
            };
            $(function () {
                // Pull in the public encryption key for our environment
                TCO.loadPubKey('sandbox');

                $('#checkOutForm').submit(function (e) {
                    if (!$(this).hasClass('paypal')) {
                        tokenRequest();
                        return false;
                    }
                });
            });
        </script>
    @endif
@endsection