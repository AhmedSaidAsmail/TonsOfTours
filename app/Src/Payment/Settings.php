<?php

namespace Payment;

use App\Models\PaymentSetting;
use App\Models\Paypal;
use App\Models\TwoCheckOut;
use Payment\Exception\NoSettingFoundException;

class Settings
{
    /**
     * @var string $currency Default App Currency
     */
    public $currency = null;
    /**
     * @var string $currency_symbol Default App Currency Symbol
     */
    public $currency_symbol = null;
    /**
     * @var int $default_percentage Default App Deposit Percentage
     */
    public $default_percentage = 0;
    /**
     * @var bool $hasPaypal Define if app has paypal setting
     */
    public $hasPaypal = false;
    /**
     * @var \Payment\Models\PaymentGateway $paypalModel
     */
    public $paypal;
    /**
     * @var bool $hasTwoCheckout Define if app has 2checkout setting
     */
    public $hasTwoCheckout = false;
    /**
     * @var \Payment\Models\PaymentGateway $TwoCheckoutModel
     */
    public $twoCheckout;
    /**
     * @var int $total Total whicj have tp paid
     */
    public $total = 0;
    /**
     * @var string|null $payment_method The Payment Method if exists
     */
    public $payment_method = null;
    /**
     * @var string $redirectLink
     */
    public $redirectLink;

    /**
     * @return void
     * @throws NoSettingFoundException
     */
    public function init()
    {
        $this->setPaymentSetting();
        $this->hasPaypal();
        $this->hasTowCheckout();
    }

    /**
     * @return void
     * @throws NoSettingFoundException
     */
    private function setPaymentSetting()
    {
        $paymentSetting = $this->appHasPaymentSettings();
        $this->currency = $paymentSetting->getAttribute('currency');
        $this->currency_symbol = $paymentSetting->getAttribute('currency_symbol');
        $this->default_percentage = $paymentSetting->getAttribute('default_percentage');


    }

    /**
     * @return PaymentSetting
     * @throws NoSettingFoundException
     */
    private function appHasPaymentSettings()
    {
        $paymentSetting = PaymentSetting::first();
        if (!is_null($paymentSetting)) {
            return $paymentSetting;
        }
        $msg = "There is no Payment Setting found in the app,\n";
        $msg .= "go to the Admin Panel > setting > Payment Setting, and set the payment currency and default percentage";
        throw new NoSettingFoundException($msg);
    }

    /**
     * Setting PaypalModel
     *
     */
    private function hasPaypal()
    {
        $this->hasPaypal = $this->setPaypal() !== null;

    }

    /**
     * @return \App\Models\Paypal|null
     */
    private function setPaypal()
    {
        $this->paypal = Paypal::first();
        return $this->paypal;
    }

    /**
     * Setting TwoCheckout
     *
     */
    private function hasTowCheckout()
    {
        $this->hasTwoCheckout = $this->setTwoCheckout() !== null;

    }

    /**
     * @return \App\Models\TwoCheckOut|null
     */
    private function setTwoCheckout()
    {
        $this->twoCheckout = TwoCheckOut::first();
        return $this->twoCheckout;
    }

    /**
     * Setting Total to pay and the Payment Method if exists
     *
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->total = $data['deposit'];
        $this->payment_method = isset($data['payment_method']) ? $data['payment_method'] : null;
    }

    public function setTotal($total)
    {
        $this->total = $total;

    }

    public function setPaymentMethod($payment_method)
    {
        $this->payment_method = $payment_method;
    }

    /**
     * Setting the redirect link
     *
     * @param $redirectLink
     */
    public function setRedirectLink($redirectLink)
    {
        $this->redirectLink = $redirectLink;
    }

}