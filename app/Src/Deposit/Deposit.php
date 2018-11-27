<?php

namespace App\Src\Deposit;

use App\Models\Paypal_setting;
use App\Models\ProductInterface;

class Deposit
{
    private $paypal_account_id = null;
    private $paypal_secret_key = null;
    public $default_percentage = 0;
    public $percentage;

    public function __construct()
    {
        $paypal_setting = Paypal_setting::first();
        if (!is_null($paypal_setting)) {
            $this->paypal_account_id = $paypal_setting->account_id;
            $this->paypal_secret_key = $paypal_setting->secret_id;
            $this->default_percentage = $paypal_setting->pay_percentage;
        }
    }

    public static function deposit(ProductInterface $product, $price)
    {
        $depositResolver = new DepositResolver($product, new self);
        return $depositResolver
            ->setDepositPercentage()
            ->getDeposit($price);
    }

    public function getDeposit($price)
    {
        return $this->percentage * $price / 100;
    }
}