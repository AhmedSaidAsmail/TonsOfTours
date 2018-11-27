<?php

namespace App\Src\Payment;

use Illuminate\Http\Request;

class Payment
{
    /**
     * @var Request $request
     */
    private $request;
    /**
     * @var integer $total
     */
    private $total;
    /**
     * @var string $payment_method
     */
    private $payment_method;
    /**
     * @var string $redirectLink
     */
    private $redirectLink;

    /**
     * Payment constructor.
     * @param Request $request
     * @param array $data
     * @param string $redirectLink
     */
    public function __construct(Request $request, array $data, $redirectLink)
    {
        $this->request = $request;
        $this->total = $data['deposit'];
        $this->payment_method = isset($data['payment_method']) ? $data['payment_method'] : null;
        $this->redirectLink = $redirectLink;
    }

    /**
     * @return string
     * @throws Exception\NoSettingFoundException
     * @throws Exception\PaymentException
     */
    public function pay()
    {
        if ($this->total > 0) {
            $paymentGateway = PaymentFactory::factory($this->request, $this->total, $this->payment_method, $this->redirectLink);
            $paymentGateway->init();
            return $paymentGateway->pay();

        }
        return $this->redirectLink . "?approval=success";
    }

}