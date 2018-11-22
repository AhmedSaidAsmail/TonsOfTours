<?php

namespace App\Src\PayPal;

use App\MyModels\Admin\Paypal_setting;

class PayPal
{
    public static $currency = "USD";
    /**
     * @var Paypal_setting
     */
    private $model;
    /**
     * @var int $percentage Percentage which have to paid
     */
    public $percentage = 0;
    /**
     * @var string|null Paypal account id
     */
    public $account = null;
    /**
     * @var string Paypal secret id
     */
    public $secret = null;
    /**
     * @var int $total Total of money for all items
     */
    public $total;
    /**
     * @var float $deposit Deposit which should paid
     */
    public $deposit;
    /**
     * @var string $link Redirecting Link
     */
    public $link;
    /**
     * @var int $reservation_id Reservation ID
     */
    public $reservation_id;
    /**
     * @var int $unique_id Confirmation ID  for reservation
     */
    public $unique_id;
    /**
     * @var string $description Title of booking
     */
    public $description;
    /**
     * @var PayPalApi
     */
    private $payPalApi;

    public function __construct()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $this->model = Paypal_setting::first();
        $this->init();

    }

    /**
     * Setting Object Properties
     *
     */
    private function init()
    {
        if (!is_null($this->model)) {
            $this->percentage = $this->model->pay_percentage;
            $this->account = $this->model->account_id;
            $this->secret = $this->model->secret_id;
        }
    }

    private function initPay($total, $link, $reservation_id, $unique_id, $description)
    {
        $this->link = $link;
        $this->total = $total;
        $this->reservation_id = $reservation_id;
        $this->unique_id = $unique_id;
        $this->deposit = sprintf('%.2f', $total * $this->percentage / 100);
        $this->description = $description;
    }

    public function linkGenerate($total, $link, $reservation_id, $unique_id, $description)
    {
        if ($this->percentage > 0) {
            $this->initPay($total, $link, $reservation_id, $unique_id, $description);
            $payPalApi = new PayPalApi($this);
            return $payPalApi->redirectLink();
        }
        return $link . "?success=true";
    }

}