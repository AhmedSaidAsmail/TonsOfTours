<?php

namespace Payment\Paypal;


use Payment\Exception\NoSettingFoundException;
use Payment\Exception\PaymentException;
use Payment\PaymentGateway;

class Paypal extends PaymentGateway
{
    public $paypal_setting;

    /**
     * Initialize Payment Object
     *
     * @return void
     * @throws NoSettingFoundException
     */
    function init()
    {
        if ($this->payment->hasPaypal) {
            $this->paypal_setting = $this->payment->paypal->getAllAttr();
            return;
        }
        throw new NoSettingFoundException('No setting found for Paypal Payment Gateway in your Database');
    }

    /**
     * @return string
     * @throws PaymentException
     */
    function preparePaymentLink()
    {
        $paypal = new PaypalApiBuilder($this);
        try {
            return $paypal->preparePaymentLink();
        } catch (\Exception $e) {
            throw new PaymentException($e->getMessage());
        }
    }
}