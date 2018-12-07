<?php

namespace Payment\Deposit;


interface ProductInterface
{
    /**
     * @return bool
     */
    public function hasDeposit();

    /**
     * @return int
     */
    public function depositPercentage();

}