<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Customer;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Admin\ReservationController;
use App\Src\Cart\Cart;
use App\Src\Payment\Payment;

class Checkout
{
    /**
     * @var Request $request
     */
    private $request;
    /**
     * @var Customer $customer
     */
    private $customer;
    /**
     * @var Reservation $reservation
     */
    private $reservation;
    /**
     * @var string $link Redirect link
     */
    public $link;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @throws \Exception
     */
    public function make()
    {
        $data = $this->request->all();
        $this->init();
        try {
            $payment = new Payment($this->request, $data, route('cart.checkout.response', [
                'reservation_id' => $this->reservation->id,
                'reservation_unique_id' => $this->reservation->unique_id
            ]));
            $this->link = $payment->pay();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Init checkout functions
     */
    private function init()
    {
        $this->customerInstance()
            ->addCustomerCreditCard()
            ->storeReservation();
    }

    /**
     * Set Customer instance
     *
     * @return $this
     */
    private function customerInstance()
    {
        $this->customer = App::make(CustomerController::class)
            ->customerInstance($this->request);
        return $this;
    }

    /**
     * Storing credit card if not exists for this customer
     *
     * @return $this
     */
    private function addCustomerCreditCard()
    {
        if ($this->request->get('deposit') > 0) {
            App::make(CreditCardsController::class)
                ->store($this->request->get('credit'), $this->customer, $this->request->get('payment_method') == 'credit');
        }
        return $this;
    }

    /**
     * Storing Reservation data
     */
    private function storeReservation()
    {
        $this->reservation = App::make(ReservationController::class)->store($this->request, $this->customer);
        $this->storeReservationItems($this->reservation);
    }

    /**
     * Storing Reservation items
     *
     * @param Reservation $reservation
     */
    private function storeReservationItems(Reservation $reservation)
    {
        $cart = new Cart($this->request);
        $cart->store($reservation->items());
    }

    /**
     * Validate Request data
     *
     * @return mixed
     */
    public function validator()
    {
        return Validator::make($this->request->all(), [
            'deposit' => 'integer|required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'payment_method' => [Rule::in(['credit', 'paypal'])],
            'token' => 'required_if:payment_method,==,credit',
            'credit.name' => 'required_if:payment_method,==,credit',
            'credit.cc_no' => 'required_if:payment_method,==,credit|digits:16',
            'credit.cc_expire_month' => 'required_if:payment_method,==,credit|digits:2',
            'credit.cc_expire_year' => 'required_if:payment_method,==,credit|digits:4',
            'credit.ccv' => 'required_if:payment_method,==,credit|digits:3',
            'credit.country' => 'required_if:payment_method,==,credit',
        ])->validate();
    }


}