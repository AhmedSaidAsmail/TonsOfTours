<?php

namespace App\Src\Payment\Paypal;

use App\Src\Payment\ResponseLink;

class PaypalResponseLink extends ResponseLink
{

    /**
     * @param array $response
     * @return $this
     */
    public function makeResponseQueries(array $response = [])
    {
        $query = null;
        if (isset($response['approval'])) {
            $query = http_build_query(array_merge($this->queries
                , [
                    'approval' => $response['approval'],
                    'payment_method' => "paypal"]));
        } else {
            $query = http_build_query($this->queries);
        }
        $this->response = !is_null($query) ? "?" . $query : null;
        return $this;
    }
}