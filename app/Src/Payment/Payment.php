<?php

namespace Payment;

use Illuminate\Http\Request;
use Payment\Deposit\Deposit;
use Payment\Deposit\ProductInterface;


/**
 * @property boolean $hasPaypal                             Paypal setting exists
 * @property string $currency                               Setting Currency
 * @property int $total                                     Total Deposit due
 * @property string $redirectLink                           Redirect link
 * @property boolean $hasTwoCheckout                        TwoCheckOut setting exists
 * @property \Payment\Models\PaymentGateway $twoCheckout    Stored 2Checkout settings
 * @property string $currency_symbol                        Setting Currency symbol
 * @property string $payment_method                         Returning Setting Payment Method if exists
 */
class Payment
{
    /**
     * @var Settings $setting Stored Payment Settings
     */
    public $setting;
    /**
     * @var Request $request
     */
    public $request;

    /**
     * Payment constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->setting = new Settings();
        $this->setting->init();
        $this->setTotalFromRequest()
            ->setPaymentMethodFromRequest();


    }

    public function deposit(ProductInterface $product, $total)
    {
        return (new Deposit($this->setting, $product, $total))->calculate();
    }

    public function setTotalFromRequest($key = "deposit")
    {
        if ($this->request->has($key)) {
            $this->setting->setTotal($this->request->get($key));
        }
        return $this;
    }

    public function setPaymentMethodFromRequest($key = "payment_method")
    {
        if ($this->request->has($key)) {
            $this->setting->setPaymentMethod($this->request->get($key));
        }
        return $this;

    }

    public function setTotal($total)
    {
        $this->setting->setTotal($total);
        return $this;
    }

    public function setPaymentMethod($payment_method)
    {
        $this->setting->setPaymentMethod($payment_method);
        return $this;
    }

    public function setRedirectLink($redirectLink)
    {
        $this->setting->setRedirectLink($redirectLink);
        return $this;
    }

    /**
     * @return string
     * @throws Exception\NoSettingFoundException
     * @throws Exception\PaymentException
     */
    public function pay()
    {
        if ($this->setting->total > 0) {
            $paymentGateway = PaymentFactory::factory($this);
            $paymentGateway->init();
            return $paymentGateway->pay();

        }
        return $this->setting->redirectLink . "?approval=success";
    }

    public function __get($name)
    {
        if (property_exists($this->setting, $name)) {
            return $this->setting->{$name};
        }
    }

}