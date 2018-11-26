<?php

namespace App\Src\Payment;


use App\Src\Payment\Exception\NoSettingFoundException;
use App\Src\Payment\Exception\PaymentException;
use Illuminate\Http\Request;

interface PaymentGateway
{
    /**
     * PaymentGateway constructor.
     * @param Request $request
     * @param $total
     * @param $successLink
     * @param $failureLink
     */
    public function __construct(Request $request, $total, $successLink, $failureLink);

    /**
     * @return void
     * @throws NoSettingFoundException
     */
    public function init();

    /**
     * @return string
     * @throws PaymentException
     */

    public function pay();

}