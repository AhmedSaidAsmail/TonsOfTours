<?php

namespace App\Src\Payment;


use App\Src\Payment\TwoCheckOut\CheckOut;
use App\Src\Payment\Paypal\Paypal;
use Illuminate\Http\Request;

class PaymentFactory
{
    /**
     * @param Request $request
     * @param $total
     * @param $payment_method
     * @param string $redirectLink
     * @return PaymentGateway
     */
    public static function factory(Request $request, $total, $payment_method, $redirectLink)
    {
        switch ($payment_method) {
            case 'credit':
                return new CheckOut($request, $total, $redirectLink);
            case "paypal":
                return new Paypal($request, $total, $redirectLink);
        }

    }

}