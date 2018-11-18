<?php

namespace App\Src\Cart;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OLD
{
    /**
     * @var null|CartCollection
     */
    private $oldCart;
    /**
     * @var array stored items
     */
    public $items = [];
    /**
     * @var int Total of items quantity
     */
    public $totalQty = 0;
    /**
     * @var int Total of all items price
     */
    public $totalPrice = 0;

    public function __construct()
    {
    }

    /**
     * Setting the old cart
     *
     * @param Request $request
     * @return $this
     */
    public function setOldCart(Request $request)
    {
        $this->oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $this->init();
        return $this;
    }

    /**
     * Setting starting object properties
     *
     */
    private function init()
    {
        if (!is_null($this->oldCart)) {
            $this->items = $this->oldCart->items;
            $this->totalPrice = $this->oldCart->totalPrice;
            $this->totalQty = $this->oldCart->totalQty;
        }
    }

    /**
     * Adding the new item to Items array
     *
     * @param integer $id
     * @param array $item
     * @return $this
     */
    public function add($id, array $item)
    {
        if (array_key_exists($id, $this->items)) {
            $this->totalPrice -= $this->items[$id]['price'];
        } else {
            $this->totalQty++;
        }
        $this->items[$id] = $item;
        $this->totalPrice += $item['price'];
        return $this;

    }

    /**
     * Removing Item from CartCollection
     *
     * @param $id
     * @return $this
     */
    public function remove($id)
    {
        if (isset($this->items) && array_key_exists($id, $this->items)) {
            $this->totalPrice -= $this->items[$id]['price'];
            $this->totalQty--;
            unset($this->items[$id]);
        }
        return $this;
    }

    /**
     * Storing the object in session
     *
     * @param Request $request
     */
    public function save(Request $request)
    {
        $request->session()->put('cart', $this);

    }

    /**
     * Storing CartCollection Items into Database
     *
     * @param HasMany $reservationItems
     * @return $this
     */
    public function store(HasMany $reservationItems)
    {
        $reservationItems->createMany($this->items);
        return $this;
    }

    /**
     * Reset the object
     *
     * @param Request $request
     */
    public function reset(Request $request)
    {
        $request->session()->put('cart', new self);
    }

}