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
     * @param string $successLink
     * @param string $failureLink
     * @return PaymentGateway
     */
    public static function factory(Request $request, $total, $payment_method, $successLink, $failureLink)
    {
        switch ($payment_method) {
            case 'credit':
                return new CheckOut($request, $total, $successLink, $failureLink);
            case "paypal":
                return new Paypal($request, $total, $successLink, $failureLink);
        }

    }

}