<?php

namespace App\Src\Cart;


class CartStock
{
    /**
     * Holding carts
     *
     * @var Product[] $carts
     */
    public $carts = [];
    /**
     * Total Price for all stock carts
     *
     * @var int $total
     */
    public $total = 0;
    /**
     * @var int $deposit Deposit due for all products
     */
    public $deposit = 0;
    /**
     * Number of how many carts there are
     *
     * @var int $qty
     */
    public $qty = 0;

    /**
     * Adding Cart object
     *
     * @param Product $cart
     * @param CartCollection $collection
     * @return CartCollection $collection
     */
    public function add(Product $cart, CartCollection $collection)
    {
        $key = spl_object_hash($cart);
        $this->carts[$key] = $cart;
        $this->total += $cart->total;
        $this->deposit += $cart->deposit;
        $this->qty++;
        return $this->updateCollection($collection, $cart->total, $cart->deposit);

    }

    /**
     * Removing cart from carts array
     *
     * @param $key
     * @param CartCollection $collection
     * @return CartCollection
     */
    public function remove($key, CartCollection $collection)
    {
        if (array_key_exists($key, $this->carts)) {
            $cart = $this->carts[$key];
            $this->total -= $cart->total;
            $this->deposit -= $cart->deposit;
            --$this->qty;
            unset($this->carts[$key]);
            return $this->updateRemovingCollection($collection, $cart->total, $cart->deposit);

        }
    }

    public function all()
    {
        return $this->carts;
    }


    public function store()
    {

    }

    /**
     * @param CartCollection $collection
     * @param int $total
     * @param int $deposit
     * @return CartCollection
     */
    private function updateCollection(CartCollection $collection, $total, $deposit)
    {
        $collection->total += $total;
        $collection->deposit += $deposit;
        $collection->qty++;
        return $collection;
    }

    /**
     * @param CartCollection $collection
     * @param $total
     * @param int $deposit
     * @return CartCollection
     */
    private function updateRemovingCollection(CartCollection $collection, $total, $deposit)
    {
        $collection->total -= $total;
        $collection->deposit -= $deposit;
        --$collection->qty;
        return $collection;
    }

}