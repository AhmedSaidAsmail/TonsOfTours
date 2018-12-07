<?php

namespace Payment;


use Payment\Exception\NoSettingFoundException;
use Payment\Exception\PaymentException;

interface PaymentGateway
{
    /**
     * PaymentGateway constructor.
     * @param Payment $payment
     */
    public function __construct(Payment $payment);

    /**
     * @return void
     * @throws NoSettingFoundException
     */
    public function init();

    /**
     * @return string
     * @throws PaymentException
     */

    public function pay();

}