<?php

namespace Payment;


use Payment\Exception\PaymentException;
use Payment\TwoCheckout\TowCheckout;
use Payment\Paypal\Paypal;

class PaymentFactory
{
    /**
     * @param Payment $payment
     * @return PaymentGateway
     * @throws PaymentException
     */
    public static function factory(Payment $payment)
    {
        switch ($payment->payment_method) {
            case 'credit':
                return new TowCheckout($payment);
            case "paypal":
                return new Paypal($payment);
            default:
                throw new PaymentException('This Payment method is not exists');

        }

    }

}