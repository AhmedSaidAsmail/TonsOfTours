<?php

namespace Payment\TwoCheckout;


use Payment\Exception\NoArgumentGivenException;

class TwoCheckoutSeller
{
    private $fillable = [
        'sellerId',
        'merchantOrderId',
        'token',
        'currency',
        'total',
        'billingAddr',
        'shippingAddr'
    ];
    /**
     * @var string $sellerId
     */
    private $sellerId;
    /**
     * @var int $merchantOrderId
     */
    private $merchantOrderId;
    /**
     * @var string $token
     */
    private $token;
    /**
     * @var string $currency
     */
    private $currency;
    /**
     * @var int $total
     */
    private $total;
    /**
     * @var array $billingAddr
     */
    private $billingAddr;
    /**
     * @var array $shippingAddr
     */
    private $shippingAddr;

    /**
     * Seller constructor.
     * @param TowCheckout $towCheckout
     */
    public function __construct(TowCheckout $towCheckout)
    {
        $this->sellerId = $towCheckout->payment_gateway_setting['partner_id'];
        $this->currency = $towCheckout->payment->currency;
        $this->token = $towCheckout->payment->request->get('token');
        $this->total = $towCheckout->payment->total;
        $this->merchantOrderId = md5(uniqid(rand(), true));
        $this->shippingAddr = $towCheckout->shippingAddress;
        $this->billingAddr = $towCheckout->shippingAddress;


    }

    /**
     * @return array
     */
    public function toArray()
    {

        $sellerArray = [];
        array_filter($this->fillable, function ($field) use (&$sellerArray) {
            if (property_exists(self::class, $field) && !is_null($this->{$field})) {
                $sellerArray[$field] = $this->{$field};
            } else {
                throw new NoArgumentGivenException(sprintf('Can not find the %s key in given data', $field));
            }
        });
        return $sellerArray;

    }

}