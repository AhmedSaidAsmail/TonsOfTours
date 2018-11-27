<?php

namespace App\Src\Cart;


use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class Cart
{
    /**
     * Instance of Request Manager
     *
     * @var Request $request
     */
    private $request;
    /**
     * Holding CartCollection instance
     *
     * @var CartCollection
     */
    private $cart;

    /**
     * Cart constructor.
     * @param Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        if ($request->session()->has('cart')) {
            $this->cart = $request->session()->get('cart');
        } else {
            $this->cart = new CartCollection();
        }

    }

    /**
     * Add Cart Item
     *
     * @param array $data
     * @param string $addType should to be item or transfer
     */

    public function add(array $data, $addType = "item")
    {
        $this->cart = $this->cart->add($data, $addType);
        $this->save();
    }

    /**
     * Removing cart form stock
     *
     * @param $key
     * @param string $stock
     */
    public function remove($key, $stock = "items")
    {
        $this->cart = $this->cart->remove($key, $stock);
        $this->save();
    }

    /**
     * Get the cart collection
     *
     * @return CartCollection
     */
    public function all()
    {
        return $this->cart;
    }

    /**
     * Saving instance of cart collection
     *
     */

    public function save()
    {
        $this->request->session()->put('cart', $this->cart);
    }

    /**
     * Storing cart items in database
     *
     * @param HasMany $items
     * @param string $stock define target stock
     */
    public function store(HasMany $items, $stock = "items")
    {
        $this->cart->store($items, $stock);
    }

    public function destroy()
    {
        $this->request->session()->put('cart', new CartCollection());
    }

}