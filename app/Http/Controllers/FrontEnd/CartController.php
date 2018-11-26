<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Customer;
use App\Models\Item;
use App\Src\Cart\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
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
//        $cart->save();
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
     */
    public function checkoutDone(Request $request)
    {
        $this->validator($request->all());
        $customer = App::make(CustomerController::class)
            ->customerInstance($request);
        App::make(CreditCardsController::class)
            ->store($request->get('credit'), $customer, $request->get('payment_method') == 'credit');
        dd($request->all());
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

}
