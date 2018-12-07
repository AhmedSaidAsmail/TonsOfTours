<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Admin\ReservationController;
use App\Mail\CustomerNotificationMail;
use App\Models\Item;
use App\Src\Cart\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Shopping\Cart\CartManager;

class CartController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = shoppingCart()->fetch('items');
        return view('frontEnd.cart.index', ['cart' => $cart]);
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

    public function store()
    {
        shoppingCart()->add('items')->save();
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
     * @param string $collection
     * @param $key
     * @return \Illuminate\Http\RedirectResponse
     */

    public function itemRemove($collection, $key)
    {
        $cart = shoppingCart()->fetch($collection);
        try {
            $cart->remove($key);
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('failure', $e->getMessage());
        }
        return redirect()->route('cart.index')->with('success', 'Item has been removed successfully');
    }

    /**
     * Displaying Checkout Form
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        $cart = shoppingCart()->fetch('items');
        return view('frontEnd.cart.checkout', ['cart' => $cart]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function checkoutDone(Request $request)
    {
        $checkout = new Checkout($request);
        $checkout->validator();
        try {
            $checkout->make();
            return redirect()->to($checkout->link);
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
                $reservation = App::make(ReservationController::class)->update($request, $reservation_id,
                    $reservation_unique_id);
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

}
