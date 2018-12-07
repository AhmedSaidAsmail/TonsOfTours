<?php

namespace Shopping\Cart;

use Illuminate\Support\Facades\App;

class CartItem
{
    /**
     * @var int $total Item Total
     */
    public $total;
    /**
     * @var int $deposit Item Deposit
     */
    public $deposit;
    /**
     * @var array $data Storing requested data
     */
    private $data;
    /**
     * @var CartCollection $collection
     */
    private $collection;
    /**
     * @var string Object hash
     */
    private $cart_hash;

    /**
     * CartItem constructor.
     * @param array $data
     * @param CartCollection $collection
     */
    public function __construct(array $data, CartCollection $collection)
    {
        $this->data = $data;
        $this->collection = $collection;
        $this->cart_hash = spl_object_hash($this);
    }

    /**
     * Making cart item
     *
     * @return void
     */

    public function make()
    {
        $this->addItemToCollection();
        $this->setTotalFromData();
        $this->setDepositFromData();
        $this->collection->increaseQuantity();

    }

    /**
     * Adding this object to parent collection
     *
     */
    private function addItemToCollection()
    {
        $this->collection->items[$this->cart_hash] = $this;

    }

    /**
     * Checking if requested data has total key
     *
     * @return bool
     */
    private function dataHasTotal()
    {
        return array_key_exists('total', $this->data);
    }

    /**
     * Setting total property from requested data
     *
     */
    private function setTotalFromData()
    {
        if ($this->dataHasTotal()) {
            $this->collection->items[$this->cart_hash]->total = $this->data['total'];
            $this->collection->increaseTotal($this->data['total']);
        }
    }

    /**
     * Checking if requested data has deposit key
     *
     * @return bool
     */
    private function dataHasDeposit()
    {
        return array_key_exists('deposit', $this->data);
    }

    /**
     * Setting deposit from requested data
     *
     */
    private function setDepositFromData()
    {
        if ($this->dataHasDeposit()) {
            $this->collection->items[$this->cart_hash]->deposit = $this->data['deposit'];
            $this->collection->deposit += $this->data['deposit'];
        }
    }

    /**
     * Setting Total property in object and parent Collection
     *
     * @param $total
     * @return $this
     */
    public function setTotal($total)
    {
        $this->collection->decreaseTotal($this->getOldTotal());
        $this->collection->items[$this->cart_hash]->total = $total;
        $this->collection->increaseTotal($total);
        $this->changeDataKeyValue('total', $total);
        return $this;
    }

    /**
     * Returning the old total property
     *
     * @return int
     */
    private function getOldTotal()
    {
        return $this->collection->items[$this->cart_hash]->total;
    }

    /**
     * @param $key
     * @param $value
     */
    private function changeDataKeyValue($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * Setting Deposit property in object and parent Collection
     *
     * @param $deposit
     * @return $this
     */
    public function setDeposit($deposit)
    {
        $this->collection->decreaseDeposit($this->getOldDeposit());
        $this->collection->items[$this->cart_hash]->deposit = $deposit;
        $this->collection->increaseDeposit($deposit);
        $this->changeDataKeyValue('deposit', $deposit);
        return $this;

    }

    /**
     * Returning the old deposit property
     *
     * @return int
     */

    private function getOldDeposit()
    {
        return $this->collection->items[$this->cart_hash]->deposit;
    }

    /**
     * Storing parent collection in session request
     *
     */

    public function save()
    {
        /** @var \Illuminate\Http\Request $request */
        $request = App::make('request');
        $request->session()->put($this->collection->cart_name, $this->collection);
    }

    /**
     * Returning removing item parameters with its collection and object reserved key
     *
     * @return array
     */
    public function removeParameters()
    {
        return [
            'collection' => $this->collection->cart_name,
            'id' => $this->cart_hash
        ];
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
    }

    public function toArray()
    {
        return $this->data;

    }


}