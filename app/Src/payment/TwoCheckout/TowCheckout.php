<?php

namespace Payment\TwoCheckout;


use Payment\PaymentGateway;
use Payment\Exception\PaymentException;
use Payment\Exception\NoSettingFoundException;
use RecursiveIteratorIterator;
use RecursiveArrayIterator;
use Twocheckout as TwocheckoutApi;
use Twocheckout_Charge;

class TowCheckout extends PaymentGateway
{
    /**
     * @var array $billingAddressFields Billing Address fields key
     */
    protected $billingAddressFields = [
        'name' => 'name',
        'email' => 'email',
        'phone' => 'phoneNumber',
        'address' => 'addrLine1',
        'city' => 'city',
        'state' => 'state',
        'zipCode' => 'zipCode',
        'country' => 'country'
    ];
    /**
     * @var array $shippingAddressFields Shipping Address fields key
     */
    protected $shippingAddressFields = [
        'name' => 'name',
        'email' => 'email',
        'phone' => 'phoneNumber',
        'address' => 'addrLine1',
        'city' => 'city',
        'state' => 'state',
        'zipCode' => 'zipCode',
        'country' => 'country'
    ];
    /**
     * @var array $payment_gateway_setting 2Checkout required settings
     */
    public $payment_gateway_setting;

    /**
     * Initialize Payment Object
     *
     * @return void
     * @throws NoSettingFoundException
     */
    function init()
    {
        if ($this->payment->hasTwoCheckout) {
            $this->payment_gateway_setting = $this->payment->twoCheckout->getAllAttr();
            $this->setBillingAddress($this->setAvailableDefaults())
                ->setShippingAddress($this->setAvailableDefaults());
            return;

        }
        throw new NoSettingFoundException('No setting found for 2Checkout Payment Gateway in your Database');
    }

    /**
     * @return string
     * @throws PaymentException
     */
    function preparePaymentLink()
    {
        $seller = new TwoCheckoutSeller($this);
        $response = $this->twoCheckoutApiProcess($seller->toArray());
        return (new GatewayResponseLink($this->payment->redirectLink))
            ->makeResponseQueries($response['response'])
            ->make();
    }

    /**
     * @param array $seller
     * @return array
     * @throws PaymentException
     */
    private function twoCheckoutApiProcess(array $seller)
    {
        try {
            TwocheckoutApi::privateKey($this->payment_gateway_setting['private_key']);
            TwocheckoutApi::sellerId($this->payment_gateway_setting['partner_id']);
            TwocheckoutApi::verifySSL(false);
            TwocheckoutApi::sandbox(true);
            return Twocheckout_Charge::auth($seller, 'array');

        } catch (\Exception $e) {
            throw new PaymentException($e->getMessage());
        }

    }

    /**
     * Searching in given data for possible Address Fields
     *
     * @return array
     */

    private function setAvailableDefaults()
    {
        $default = $this->defaultAddressValues();
        array_walk($default, function (&$val, $key) {
            $val = $this->searchInData($this->payment->request->all(), $key, $val);

        });
        return $default;
    }

    /**
     * @return array Default Values for shipping and billing address
     */
    private function defaultAddressValues()
    {
        return [
            'name' => 'name',
            'email' => 'email',
            'phone' => 'phoneNumber',
            'address' => 'No_Add',
            'city' => 'No_City',
            'state' => 'No_State',
            'zipCode' => '22112',
            'country' => 'country'
        ];
    }

    /**
     * Searching in giving data for possible Address fields
     *
     * @param array $haystack
     * @param $needle
     * @param $defaultValue
     * @return mixed
     */

    private function searchInData(array $haystack, $needle, $defaultValue)
    {
        $iterator = new RecursiveArrayIterator($haystack);
        $recursive = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::SELF_FIRST);
        foreach ($recursive as $key => $val) {
            if ($key == $needle) {
                return $val;
            }
        }
        return $defaultValue;
    }
}