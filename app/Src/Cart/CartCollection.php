<?php

namespace App\Src\Cart;


class CartCollection
{
    /**
     * Holding instance of cart stock for items cart
     *
     * @var CartStock $itemsCart
     */
    public $itemsCart;
    /**
     * Holding instance of cart stock for transfers cart
     *
     * @var CartStock $transfersCart
     */
    public $transfersCart;
    /**
     * Holding cart stocks instance
     *
     * @var CartStock[] $stocks
     */
    private $stocks = [];
    /**
     * All carts price total
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
     * CartCollection constructor.
     */
    public function __construct()
    {
        $this->stocks['item'] = new CartStock();
        $this->stocks['transfer'] = new CartStock();

    }

    /**
     * Adding cart to instance stock
     *
     * @param array $data
     * @param string $addType should to be item or transfer
     * @return $this
     */
    public function add(array $data, $addType = "item")
    {
        switch ($addType) {
            case "item":
                return $this->stocks['item']->add($this->initItemCart($data), $this);
            default:
                return $this->stocks['item']->add($this->initItemCart($data), $this);
        }
    }

    /**
     * Removing Cart form stock instance
     *
     * @param $key
     * @param $stock
     * @return $this
     */
    public function remove($key, $stock)
    {
        switch ($stock) {
            case 'items':
                return $this->stocks['item']->remove($key, $this);
            default:
                return $this->stocks['item']->remove($key, $this);
        }

    }

    /**
     * Preparing ItemCart object
     *
     * @param array $data
     * @return ItemCart
     */
    private function initItemCart(array $data)
    {
        $cart = new itemCart($data);
        $cart->init();
        return $cart;

    }

    /**
     * Returning all items cart
     *
     * @return CartStock
     */
    public function items()
    {
        return $this->stocks['item'];
    }

    /**
     * returning transfers cart stock
     *
     * @return CartStock
     */
    public function transfers()
    {
        return $this->stocks['transfer'];
    }


}