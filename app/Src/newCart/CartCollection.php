<?php

namespace Shopping\Cart;

use Illuminate\Support\Facades\App;
use Shopping\Cart\Exceptions\NotFoundItemException;

class CartCollection
{
    /**
     * @var string $cart_name Collection name
     */
    public $cart_name;
    /**
     * @var CartItem[] $items
     */
    public $items = [];
    /**
     * @var int $total All Collection items total
     */
    public $total;
    /**
     * @var int $deposit All Collection items deposit
     */
    public $deposit;
    /**
     * @var int $quantity Number of exists items
     */
    public $quantity = 0;

    /**
     * CartCollection constructor.
     * @param $cart_name
     */

    public function __construct($cart_name)
    {
        $this->cart_name = $cart_name;
    }

    /**
     * Adding Item to cart collection
     *
     * @param array $data
     * @return CartItem
     */
    public function add(array $data)
    {
        $item = new CartItem($data, $this);
        $item->make();
        return $item;

    }

    /**
     * @param $total
     */

    public function increaseTotal($total)
    {
        $this->total += $total;
    }

    /**
     * @param $total
     */
    public function decreaseTotal($total)
    {
        $this->total -= $total;
    }

    /**
     * @param $deposit
     */
    public function increaseDeposit($deposit)
    {
        $this->deposit += $deposit;
    }

    /**
     * @param $deposit
     */
    public function decreaseDeposit($deposit)
    {
        $this->deposit -= $deposit;
    }

    /**
     * Increasing Collection Quantity
     *
     * @return void
     */

    public function increaseQuantity()
    {
        $this->quantity++;
    }

    /**
     * Fetching all collection items
     *
     * @return CartItem[]
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * Removing item from Collection
     *
     * @param $key
     * @return bool
     * @throws NotFoundItemException
     */
    public function remove($key)
    {
        if ($this->itemHasKey($key)) {
            $item = $this->items[$key];
            $this->decreaseTotal($item->total);
            $this->decreaseDeposit($item->deposit);
            $this->quantity--;
            unset($this->items[$key]);
            return true;
        }
        throw new NotFoundItemException('Given cart item not exists');

    }

    /**
     * Checking if this collection has specified item
     *
     * @param $key
     * @return bool
     */

    private function itemHasKey($key)
    {
        return array_key_exists($key, $this->items);
    }

    /**
     * Storing Collection in session request
     *
     */
    public function save()
    {
        /** @var \Illuminate\Http\Request $request */
        $request = App::make('request');
        $request->session()->put($this->cart_name, $this);
    }

    /**
     * Converting stored CartItem to array
     *
     * @return array
     */
    public function toArray()
    {

        return array_map(function ($item) {
            /** @var CartItem $item */
            return $item->toArray();
        }, array_values($this->items));
    }


}