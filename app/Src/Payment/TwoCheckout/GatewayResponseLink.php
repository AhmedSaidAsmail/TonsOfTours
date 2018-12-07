<?php

namespace Payment\TwoCheckout;

use Payment\ResponseLink;

class GatewayResponseLink extends ResponseLink
{
    /**
     * Preparing 2Checkout Redirect link
     *
     * @param array $response
     * @return $this
     */
    public function makeResponseQueries(array $response = [])
    {
        $query = null;
        if ($response['responseCode'] == "APPROVED") {
            $query = http_build_query(array_merge($this->queries
                , [
                    'paymentId' => $response['transactionId'],
                    'orderNumber' => $response['orderNumber'],
                    'payment_method' => "2_check_out",
                    'approval' => "success"
                ]));
        } else {
            $query = http_build_query($this->queries);
        }
        $this->response = !is_null($query) ? "?" . $query : null;
        return $this;
    }
}