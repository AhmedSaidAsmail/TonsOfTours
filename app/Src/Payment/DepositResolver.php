<?php

namespace App\Src\Payment;


use App\Models\ProductInterface;

class DepositResolver
{
    private $payment_instance;
    private $item_model;
    private $item_model_details;
    private $has_deposit = false;
    private $deposit_percentage = 0;

    public function __construct(ProductInterface $item_model, Payment $payment)
    {
        $this->item_model = $item_model;
        $this->item_model_details = $item_model->details()->first();
        $this->payment_instance = $payment;
    }

    public function setDepositPercentage()
    {
        if ($this->checkDeposit()) {
            $this->setDefaultDeposit();
        }
        return $this->payment_instance;
    }

    private function checkDeposit()
    {
        if (!is_null($this->item_model_details) && $this->item_model_details->has_deposit) {
            return true;
        }
        return false;
    }

    private function itemHasDeposit()
    {
        $item_deposit_percentage = $this->item_model_details->deposit_percentage;
        return $item_deposit_percentage > 0 ? $item_deposit_percentage : false;
    }

    private function setDefaultDeposit()
    {

//        $this->payment_instance->percentage = !$this->itemHasDeposit() ? !$this->itemHasDeposit() : $this->payment_instance->default_percentage;
        $this->payment_instance->percentage = !$this->itemHasDeposit() ? $this->payment_instance->default_percentage : $this->itemHasDeposit();
    }

}