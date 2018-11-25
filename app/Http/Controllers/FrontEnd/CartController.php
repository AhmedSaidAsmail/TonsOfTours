<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Item;
use App\Src\Cart\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        dd($request->all());
    }
}
