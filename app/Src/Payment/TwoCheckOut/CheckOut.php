<?php

namespace Payment\TwoCheckOut;

use Payment\Exception\NoSettingFoundException;
use Payment\Exception\PaymentException;
use Payment\Payment;
use Payment\PaymentGateway;
use Twocheckout;
use Twocheckout_Charge;


class CheckOut implements PaymentGateway
{
    /**
     * @var Payment $payment
     */
    public $payment;
    /**
     * @var array stored TwoCheckout setting
     */
    public $two_checkout_setting = [];

    /**
     * @var string $sellerId 2CheckOut Seller Id
     */
    public $sellerId;


    /**
     * @var Payer $billingAddr ;
     */
    public $billingAddr;
    /**
     * @var Payer $shippingAddr ;
     */
    public $shippingAddr;
    /**
     * @var Seller $seller
     */
    private $seller;
//    /**
//     * @var int $total
//     */
//    public $total;
//    /**
//     * @var Request $request
//     */
//    public $request;
//    /**
//     * @var string $redirectLink response link redirect
//     */
//    private $redirectLink;


    /**
     * CheckOut constructor.
     * @param Payment $payment
     */
    public function __construct(Payment $payment)
    {
//        $this->request = $payment->request;
//        $this->total = $payment->total;
//        $this->redirectLink = $payment->redirectLink;
        $this->payment = $payment;
    }

    /**
     * @return $this
     * @throws NoSettingFoundException
     */
    public function init()
    {
        if ($this->payment->hasTwoCheckout) {
            $this->two_checkout_setting = $this->payment->twoCheckout->getAllAttr();
            return $this;
        }
        throw new NoSettingFoundException('No setting found for 2Checkout Payment Gateway in your Database');
    }


    public function pay($billingAddress = 'billingAddress', $shippingAddress = 'shippingAddress')
    {
        $this->billingAddr = new Payer($this->payment->request, $billingAddress);
        $this->shippingAddr = new Payer($this->payment->request, $shippingAddress);
        $this->seller = new Seller($this);
        return $this->checkOutPay($this->seller->__toArray());

    }


    /**
     * @param array $sellerDetails
     * @return array|false|mixed|string
     * @throws PaymentException
     */
    public function checkOutPay(array $sellerDetails)
    {
        try {
            Twocheckout::privateKey($this->two_checkout_setting['private_key']);
            Twocheckout::sellerId($this->two_checkout_setting['partner_id']);
            Twocheckout::verifySSL($this->two_checkout_setting['ssl']);
            Twocheckout::sandbox($this->two_checkout_setting['sandbox']);
            $charge = Twocheckout_Charge::auth($sellerDetails, 'array');
            return (new CheckoutResponseLink($this->payment->redirectLink))
                ->makeResponseQueries($charge['response'])
                ->make();

        } catch (\Exception $e) {
            throw new PaymentException($e->getMessage());
        }

    }

//    /**
//     * @param array $data
//     * @return null|string
//     */
//    protected function analysisResponseQueries(array $data)
//    {
//        if ($data['responseCode'] == "APPROVED") {
//            $query = http_build_query([
//                'paymentId' => $data['transactionId'],
//                'orderNumber' => $data['orderNumber']
//            ]);
//            return $query;
//        }
//        return null;
//    }

}