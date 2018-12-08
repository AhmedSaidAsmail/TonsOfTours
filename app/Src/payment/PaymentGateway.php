<?php

namespace Payment;


use Illuminate\Database\Eloquent\Relations\HasOne;
use Payment\Exception\AddressException;
use Payment\Exception\NoSettingFoundException;
use Payment\Exception\PaymentException;

abstract class PaymentGateway
{
    /**
     * @var array $addressFields Required address fields keys
     */
    protected $addressFields = ['name', 'email', 'phone', 'address', 'city', 'state', 'zipCode', 'country'];
    /**
     * @var Payment $payment
     */
    public $payment;
    /**
     * @var array $billingAddressFields Billing Address fields key
     */
    protected $billingAddressFields = [];
    /**
     * @var array $billingAddress Billing Address data
     */
    public $billingAddress = [];
    /**
     * @var array $shippingAddressFields Shipping Address fields key
     */
    protected $shippingAddressFields = [];
    /**
     * @var array $shippingAddress Shipping Address data
     */
    public $shippingAddress = [];

    /**
     * AbstractPaymentGateway constructor.
     * @param Payment $payment
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
        $this->init();
    }

    /**
     * Setting Billing Address
     *
     * @param array $billingAddress
     * @param HasOne|null $related Storing Model
     * @return $this
     */
    public function setBillingAddress(array $billingAddress, HasOne $related = null)
    {
        $this->validateAndSettingAddress($billingAddress, $this->billingAddressFields, $this->billingAddress);
        $this->storeAddress($billingAddress, $related);
        return $this;
    }

    /**
     * Setting Shipping Address
     *
     * @param array $shippingAddress
     * @param HasOne|null $related Storing Model
     * @return $this
     */
    public function setShippingAddress(array $shippingAddress, HasOne $related = null)
    {
        $this->validateAndSettingAddress($shippingAddress, $this->shippingAddressFields, $this->shippingAddress);
        $this->storeAddress($shippingAddress, $related);
        return $this;
    }

    /**
     * @param array $data
     * @param HasOne|null $related
     */
    private function storeAddress(array $data, HasOne $related = null)
    {
        if (!is_null($related)) {
            $related->create($data);
        }

    }

    /**
     * @param array $address
     * @param array $addressEmulator
     * @param array $destination
     * @throws AddressException
     */
    private function validateAndSettingAddress(array $address, array $addressEmulator, array &$destination)
    {
        foreach ($address as $key => $val) {
            if (in_array($key, $this->addressFields)) {
                $this->setDestinationFields($addressEmulator, $destination, $key, $val);
            } else {
                throw new AddressException(sprintf('given key:%s is not valid address field ,The address must be at one of this fields:[ %s ]',
                    $key, implode(",", $this->addressFields)));
            }
        }

    }

    /**
     * @param array $addressEmulator
     * @param array $destination
     * @param $key
     * @param $val
     */
    private function setDestinationFields(array $addressEmulator, array &$destination, $key, $val)
    {
        if (array_key_exists($key, $addressEmulator)) {
            $destination[$addressEmulator[$key]] = $val;
        }
    }

    /**
     * Initialize Payment Object
     *
     * @return void
     * @throws NoSettingFoundException
     */
    abstract function init();

    /**
     * @return string
     * @throws PaymentException
     */
    abstract function preparePaymentLink();

}