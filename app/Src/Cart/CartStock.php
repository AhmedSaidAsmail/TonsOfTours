<?php

namespace App\Src\Cart;


class CartStock
{
    /**
     * Holding carts
     *
     * @var CartInterface[] $carts
     */
    public $carts = [];
    /**
     * Total Price for all stock carts
     *
     * @var int $total
     */
    public $total = 0;
    /**
     * Number of how many carts there are
     *
     * @var int $qty
     */
    public $qty = 0;

    /**
     * Adding Cart object
     *
     * @param CartInterface $cart
     * @param CartCollection $collection
     * @return CartCollection $collection
     */
    public function add(CartInterface $cart, CartCollection $collection)
    {
        $key = spl_object_hash($cart);
        $this->carts[$key] = $cart;
        $total = $cart->getTotal();
        $this->total += $total;
        $this->qty++;
        return $this->updateCollection($collection, $total);

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
            $total = $cart->getTotal();
            $this->total -= $total;
            --$this->qty;
            unset($this->carts[$key]);
            return $this->updateRemovingCollection($collection, $total);

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
     * @return CartCollection
     */
    private function updateCollection(CartCollection $collection, $total)
    {
        $collection->total += $total;
        $collection->qty++;
        return $collection;
    }

    /**
     * @param CartCollection $collection
     * @param $total
     * @return CartCollection
     */
    private function updateRemovingCollection(CartCollection $collection, $total)
    {
        $collection->total -= $total;
        --$collection->qty;
        return $collection;
    }

}