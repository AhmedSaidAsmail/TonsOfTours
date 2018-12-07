<?php

namespace Payment\Paypal;

use Payment\Exception\PaymentException;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;

class PaypalApiBuilder
{
    /**
     * @var Payer $payer
     */
    private $payer;
    /**
     * @var Details $details
     */
    private $details;
    /**
     * @var Amount $amount
     */
    private $amount;
    /**
     * @var Transaction $transaction
     */
    private $transaction;
    /**
     * @var Payment $payment
     */
    private $payment;
    /**
     * @var RedirectUrls $redirectUrls
     */
    private $redirectUrls;
    /**
     * @var Paypal
     */
    private $paypal_instance;
    /**
     * @var ApiContext $api
     */
    private $api;
    /**
     * @var PaypalResponseLink $responseLink ;
     */
    private $responseLink;

    /**
     * PaypalApiBuilder constructor.
     * @param Paypal $paypal_instance
     */
    public function __construct(Paypal $paypal_instance)
    {
        $this->payer = new Payer();
        $this->details = new Details();
        $this->amount = new Amount();
        $this->transaction = new Transaction();
        $this->payment = new Payment();
        $this->redirectUrls = new RedirectUrls();
        $this->paypal_instance = $paypal_instance;
        $this->responseLink = new PaypalResponseLink($paypal_instance->payment->redirectLink);
    }

    /**
     * Preparing Paypal Api
     *
     * @return $this
     */

    private function setApi()
    {
        $this->api = new ApiContext(new OAuthTokenCredential($this->paypal_instance->paypal_setting['client_id'],
            $this->paypal_instance->paypal_setting['secret']));
        return $this;
    }

    /**
     * Setting the config
     *
     * @param ApiContext $api
     * @return $this
     */
    private function setConfig(ApiContext $api)
    {
        $api->setConfig([
            'mode' => $this->paypal_instance->paypal_setting['sandbox'] ? "sandbox" : "live",
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => false,
            'log.LogFileName' => '',
            'log.LogLevel' => 'fine',
            'validation.level' => 'log'
        ]);
        return $this;
    }

    /**
     * Setting PayPal Payer
     *
     * @return $this
     */
    private function setPayer()
    {
        $this->payer->setPaymentMethod('paypal');
        return $this;
    }

    /**
     * Setting Payment Details
     *
     * @return $this
     */
    private function setDetails()
    {
        $this->details->setTax('0.00')
            ->setShipping('0.00')
            ->setSubtotal($this->paypal_instance->payment->total);
        return $this;
    }

    /**
     * Setting the amount and currency and payment details
     *
     * @return $this
     */
    private function setAmount()
    {
        $this->amount->setTotal($this->paypal_instance->payment->total)
            ->setCurrency($this->paypal_instance->payment->currency)
            ->setDetails($this->details);
        return $this;
    }

    /**
     * Setting PayPal Transaction
     *
     * @return $this
     */
    private function setTransaction()
    {
        $this->transaction->setAmount($this->amount)
            ->setDescription($this->paypal_instance->paypal_setting['description']);
        return $this;
    }

    /**
     * Doing Payment
     *
     * @return $this
     */
    private function setPayment()
    {
        $this->payment->setIntent('sale')
            ->setPayer($this->payer)
            ->setTransactions([$this->transaction]);
        return $this;
    }


    /**
     * Making the success redirect link
     *
     * @return $this
     */
    private function setRedirect()
    {
        $this->redirectUrls->setReturnUrl($this->responseLink->makeResponseQueries(['approval' => "success"])->make())
            ->setCancelUrl($this->responseLink->makeResponseQueries(['approval' => "canceled"])->make());
        $this->payment->setRedirectUrls($this->redirectUrls);
        return $this;
    }

    /**
     * @return void
     * @throws \RuntimeException
     */
    private function createApi()
    {
        $this->payment->create($this->api);
    }

    /**
     * Configure the PayPal Api
     *
     *
     */
    private function init()
    {
        $this->setApi()
            ->setConfig($this->api)
            ->setPayer()
            ->setDetails()
            ->setAmount()
            ->setTransaction()
            ->setPayment()
            ->setRedirect()
            ->createApi();

    }

    /**
     * @throws PaymentException
     */
    public function preparePaymentLink()
    {
        try {
            $this->init();
            foreach ($this->payment->getLinks() as $link) {
                if ($link->getRel() == 'approval_url') {
                    $redirectUrl = $link->getHref();
                    return $redirectUrl;
                }
            }
        } catch (\Exception $e) {
            throw new PaymentException($e->getMessage());
        }
    }

}