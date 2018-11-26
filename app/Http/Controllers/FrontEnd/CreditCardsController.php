<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Customer;
use App\Http\Controllers\Controller;

class CreditCardsController extends Controller
{
    /**
     *Storing new credit card
     *
     * @param array $data
     * @param Customer $customer
     * @param bool $dataHasCredit
     * @return void
     */
    public function store(array $data, Customer $customer, $dataHasCredit = true)
    {
        if ($dataHasCredit) {
            $this->storeCredit($data, $customer);
        }
    }

    /**
     * @param array $data
     * @param Customer $customer
     */
    private function storeCredit(array $data, Customer $customer)
    {
        if (!$this->CustomerHasThisCredit($customer, $data['cc_no'])) {
            $customer->credits()->create($data);
        }

    }

    /**
     * Check if this customer has this credit card
     *
     * @param Customer $customer
     * @param $cc_no
     * @return bool
     */
    private function CustomerHasThisCredit(Customer $customer, $cc_no)
    {
        return null !== $customer->credits()->where('cc_no', $cc_no)->first();

    }
}
