<section class="checkout-form-section">
    <ul>
        <li>You will be charged the deposit amount once your order is confirmed.</li>
        <li>If confirmation isn't received instantly, an authorization for the deposit amount
            will
            be held until your booking is confirmed.
        </li>
        <li>You can cancel for free up to 48 hours before the day of the experience, local
            time.
        </li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <?php
            $class = null;
            switch (true) {
                case payment()->hasTwoCheckout:
                    $class = "no-paypal";
                    break;
                case payment()->hasPaypal:
                    $class = "with-paypal";
                    break;
                default:
                    $class = "no-paypal";
            }
            ?>
            <button class="btn btn-block {{$class}}" id="bookNow">
                <span>{{translate('Book_Now')}}</span>
            </button>
        </div>
    </div>
</section>