<?php

namespace App\Src\Cart;


interface CartInterface
{
    /**
     * @return int
     */
    public function getTotal();
    public function init();

}