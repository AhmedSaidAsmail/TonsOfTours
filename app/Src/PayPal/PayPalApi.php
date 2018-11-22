<?php

namespace App\Src\PayPal;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;

class PayPalApi
{
    /**
     * @var string $access_token sandbox|live
     */
    private static $access_token = "sandbox";

    /**
     * @var ApiContext
     */
    private $api;
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
     * @var PayPal
     */
    private $payPal;

    public function __construct(PayPal $payPal)
    {
        $this->payPal = $payPal;
        $this->payer = new Payer();
        $this->details = new Details();
        $this->amount = new Amount();
        $this->transaction = new Transaction();
        $this->payment = new Payment();
        $this->redirectUrls = new RedirectUrls();
    }

    /**
     * Preparing Paypal Api
     *
     * @return $this
     */

    private function setApi()
    {
        $this->api = new ApiContext(new OAuthTokenCredential($this->payPal->account, $this->payPal->secret));
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
            'mode' => self::$access_token,
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
            ->setSubtotal($this->payPal->deposit);
        return $this;
    }

    /**
     * Setting the amount and currency and payment details
     *
     * @return $this
     */
    private function setAmount()
    {
        $this->amount->setTotal($this->payPal->deposit)
            ->setCurrency(PayPal::$currency)
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
            ->setDescription($this->payPal->description);
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
        $this->redirectUrls->setReturnUrl($this->payPal->link . "?" . http_build_query([
                'success' => 'true',
                'reservation_id' => $this->payPal->reservation_id,
                'unique_id' => $this->payPal->unique_id
            ]))
            ->setCancelUrl($this->payPal->link . "?success=false");
        $this->payment->setRedirectUrls($this->redirectUrls);
        return $this;
    }

    /**
     * Configure the PayPal Api
     *
     * @return $this
     */
    private function configure()
    {
        return $this->setApi()
            ->setConfig($this->api)
            ->setPayer()
            ->setDetails()
            ->setAmount()
            ->setTransaction()
            ->setPayment()
            ->setRedirect();

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
     * @return string
     * @throws \RuntimeException
     */
    public function redirectLink()
    {
        try {
            $this->configure()->createApi();
            foreach ($this->payment->getLinks() as $link) {
                if ($link->getRel() == 'approval_url') {
                    $redirectUrl = $link->getHref();
                    return $redirectUrl;
                }
            }
        } catch (\RuntimeException $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }

}