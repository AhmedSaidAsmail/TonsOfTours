<?php

namespace Payment;


use Payment\TwoCheckOut\CheckOut;
//use App\Src\Payment\Paypal\Paypal;

class PaymentFactory
{
    /**
     * @param Payment $payment
     * @return PaymentGateway
     */
    public static function factory(Payment $payment)
    {
        switch ($payment->payment_method) {
            case 'credit':
                return new CheckOut($payment);
            case "paypal":
//                return new Paypal($request, $total, $redirectLink);

        }

    }

}