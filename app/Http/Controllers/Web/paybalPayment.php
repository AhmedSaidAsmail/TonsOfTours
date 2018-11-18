<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\PaypalSettings;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;

class paybalPayment {

    protected $total;
    protected $link;
    protected $reservation_id;
    protected $deposit;
    protected $percentage;
    protected $paypalUser;
    protected $PaybalSecret;
    protected $api;
    protected $payer;
    protected $details;
    protected $amount;
    protected $transaction;
    protected $payment;
    protected $redirectUrls;
    public function __construct($total, $link, $reservation_id) {
        $this->total          = $total;
        $this->link           = $link;
        $this->reservation_id = $reservation_id;
        $this->percentage     = PaypalSettings::percentage();
        $this->paypalUser     = PaypalSettings::getUser();
        $this->PaybalSecret   = PaypalSettings::getSecret();
        $this->deposit        = sprintf('%.2f', $total * $this->percentage / 100);
        // paypal Calsses
        $this->payer          = new Payer();
        $this->details        = new Details();
        $this->amount         = new Amount();
        $this->transaction    = new Transaction();
        $this->payment        = new Payment();
        $this->redirectUrls   = new RedirectUrls();
    }
    public function setApi() {
        $this->api = new ApiContext(new OAuthTokenCredential($this->paypalUser, $this->PaybalSecret));
        return $this;
    }
    public function setConfig(ApiContext $api) {
        $api->setConfig([
            'mode'                   => 'sandbox',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled'         => false,
            'log.LogFileName'        => '',
            'log.LogLevel'           => 'fine',
            'validation.level'       => 'log']);
        return $this;
    }
    // payer
    public function setPayer() {
        $this->payer->setPaymentMethod('paypal');
        return $this;
    }
    // details
    public function setDetails() {
        $this->details->setTax('0.00')
                ->setShipping('0.00')
                ->setSubtotal($this->deposit);
        return $this;
    }
    // amount
    public function setAmount() {
        $this->amount->setTotal($this->deposit)
                ->setCurrency('GBP')
                ->setDetails($this->details);
        return $this;
    }
    // transaction
    public function setTransaction() {
        $this->transaction->setAmount($this->amount)
                ->setDescription("excursions booking deposit ");
        return $this;
    }
    // payment
    public function setPayment() {
        $this->payment->setIntent('sale')
                ->setPayer($this->payer)
                ->setTransactions([$this->transaction]);
        return $this;
    }
    //redirectUrls
    public function setRedirect() {
        $this->redirectUrls->setReturnUrl($this->link . "?success=approval&reservation_id=" . $this->reservation_id)
                ->setCancelUrl($this->link . "?success=false");
        $this->payment->setRedirectUrls($this->redirectUrls);
        return $this;
    }
    public function doRedirect() {
        $this->setApi()
                ->setConfig($this->api)
                ->setPayer()
                ->setDetails()
                ->setAmount()
                ->setTransaction()
                ->setPayment()
                ->setRedirect();
        return $this;
    }
    public function createApi() {
        try {
            $this->payment->create($this->api);
        } catch (\Exception $ex) {
            return $ex->getTraceAsString();
        }
    }
    public function finalMethod() {
        $this->doRedirect()->createApi();
        foreach ($this->payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirectUrl = $link->getHref();
                return $redirectUrl;
            }
        }
        //return $this->payment->getLinks();
        //return $this->PaybalSecret;
    }

}