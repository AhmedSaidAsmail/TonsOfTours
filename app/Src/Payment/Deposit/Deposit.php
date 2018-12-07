<?php

namespace Payment\Deposit;

use Payment\Settings;

class Deposit
{
    private $setting;
    private $total;
    private $product;

    public function __construct(Settings $setting, ProductInterface $product, $total)
    {
        $this->setting = $setting;
        $this->total = $total;
        $this->product = $product;
    }

    public function calculate()
    {
        return $this->total * $this->getDepositPercentage() / 100;
    }

    private function getDepositPercentage()
    {
        if ($this->product->hasDeposit()) {
            return $this->depositPercentage();
        }
        return 0;
    }

    private function depositPercentage()
    {
        if ($this->product->depositPercentage() > 0) {
            return $this->product->depositPercentage();
        }
        return $this->setting->default_percentage;
    }

}