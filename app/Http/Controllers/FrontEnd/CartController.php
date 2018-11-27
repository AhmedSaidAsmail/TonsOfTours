<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Admin\ReservationController;
use App\Mail\CustomerNotificationMail;
use App\Models\Customer;
use App\Models\Item;
use App\Src\Cart\Cart;
use App\Src\Payment\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = new Cart($request);
        return view('frontEnd.cart.index', ['cart' => $cart->all()]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function checkAvailability(Request $request, $id)
    {
        $this->validate($request, [
            'date' => 'required',
            'st_num' => 'required|integer|min:1|max:40',
            'sec_num' => 'required|integer|min:0|max:20'
        ]);
        $item = Item::find($id);
        $data = $request->all();
        return view('frontEnd.layouts._bookingReview', [
            'item' => $item,
            'data' => $data,
            'price' => $this->setPriceRange($item, $data['st_num']),
            'total' => $this->setTotal($item, $data)
        ]);
    }

    public function store(Request $request)
    {
        $dat = $request->all();
        $item = Item::find($dat['item_id']);
        $cart = new Cart($request);
        $cart->add(array_merge($dat, ['model' => $item]));
        return redirect()->route('cart.index');
    }

    /**
     * Setting the price range
     *
     * @param Item $item
     * @param $adultTotal
     * @return mixed
     */
    private function setPriceRange(Item $item, $adultTotal)
    {
        if ($item->packages()->count() > 0) {
            $price = $item->packages()
                ->where('min', '<=', $adultTotal)
                ->where('max', '>=', $adultTotal)
                ->first();
            return !is_null($price) ? $price : $item->price()->first();
        }
        return $item->price()->first();
    }

    /**
     * @param Item $item
     * @param array $data
     * @return float|int
     */

    private function setTotal(Item $item, array $data)
    {
        $price = $this->setPriceRange($item, $data['st_num']);
        return ($price->st_price * $data['st_num']) + ($price->sec_price * $data['sec_num']);
    }

    /**
     * Removing item from cart
     *
     * @param Request $request
     * @param $key
     * @return \Illuminate\Http\RedirectResponse
     */

    public function itemRemove(Request $request, $key)
    {
        $cart = new Cart($request);
        $cart->remove($key);
        return redirect()->route('cart.index');
    }

    /**
     * Displaying Checkout Form
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        $cart = new Cart($request);
        return view('frontEnd.cart.checkout', ['cart' => $cart->all()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function checkoutDone(Request $request)
    {
        $data = $request->all();
        $this->validator($request->all());
        /** @var Customer $customer */
        $customer = App::make(CustomerController::class)
            ->customerInstance($request);
        // store customer credit card
        $this->addCustomerCreditCard($request, $customer);
        // storing reservation
        $reservation = App::make(ReservationController::class)->store($request, $customer);
        (new Cart($request))->store($reservation->items());
        //payment gateway
        try {
            $payment = new Payment($request, $data, route('cart.checkout.response', [
                'reservation_id' => $reservation->id,
                'reservation_unique_id' => $reservation->unique_id
            ]));
            return redirect()->to($payment->pay());
        } catch (\Exception $e) {
            return redirect()->back()->with('failure', $e->getMessage());
        }

    }

    /**
     * @param Request $request
     * @param $reservation_id
     * @param $reservation_unique_id
     * @return \Illuminate\Http\Response
     */
    public function checkoutResponse(Request $request, $reservation_id, $reservation_unique_id)
    {
        $data = $request->all();
        if (isset($data['approval']) && $data['approval'] == "success") {
            try {
                $reservation = App::make(ReservationController::class)->update($request, $reservation_id, $reservation_unique_id);
                (new Cart($request))->destroy();
                Mail::to($reservation->customer->email)
                    ->send(new CustomerNotificationMail($reservation, $request));
                return view('frontEnd.cart.success', ['reservation' => $reservation]);
            } catch (\Exception $e) {
                return redirect()->route('cart.checkout')->with('failure', $e->getMessage());
            }

        }
        return redirect()->route('cart.checkout')->with('failure', '!Oops ,something went wrong');
    }

    protected function validator(array $array)
    {
        return Validator::make($array, [
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

    /**
     * Storing credit card if not exists for this customer
     *
     * @param Request $request
     * @param Customer $customer
     */
    private function addCustomerCreditCard(Request $request, Customer $customer)
    {
        if ($request->get('deposit') > 0) {
            App::make(CreditCardsController::class)
                ->store($request->get('credit'), $customer, $request->get('payment_method') == 'credit');
        }
    }

}
