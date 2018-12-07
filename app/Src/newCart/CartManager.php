<?php

namespace Shopping\Cart;

use Illuminate\Http\Request;

class CartManager
{
    /**
     * @var Request $request
     */
    public $request;

    /**
     * CartAdapter constructor.
     * @param Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Storing Cart Item to specified Collection
     *
     * @param $cartName
     * @return CartItem
     */
    public function add($cartName)
    {
        $cart = $this->fetch($cartName);
        return $cart->add($this->request->all());


    }

    /**
     * Checking Session has Cart collection with this name
     *
     * @param $cartName
     * @return bool
     */

    private function sessionHasCart($cartName)
    {
        return $this->request->session()->has($cartName);
    }

    /**
     * Checking is this collection instance of CartCollection
     *
     * @param $cartName
     * @return bool
     */
    private function validateRequestCartCollection($cartName)
    {
        return $this->request->session()->get($cartName) instanceof CartCollection;
    }

    /**
     * Fetching specified cart collection
     *
     * @param $cartName
     * @return CartCollection
     */

    public function fetch($cartName)
    {
        if ($this->sessionHasCart($cartName) && $this->validateRequestCartCollection($cartName)) {
            return $this->request->session()->get($cartName);
        }
        return new CartCollection($cartName);

    }

    /**
     * Destroying specified cart collection
     *
     * @param $cartName
     */
    public function destroy($cartName)
    {
        $this->request->session()->put($cartName, null);
    }

}