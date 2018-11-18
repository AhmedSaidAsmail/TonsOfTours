<?php

namespace App\Src\WishList;


use App\Models\Customer;

class EloquentProvider implements WishListProvider
{
    /**
     * @var Customer
     */
    private $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function all()
    {
        return $this->customer->wish_lists()->get();
    }

    public function add($item_id)
    {
        if (!$this->check($item_id)) {
            $this->customer->wish_lists()->create(['item_id' => $item_id]);
        }
    }

    public function remove($id)
    {
        $this->customer->wish_lists()->get()->find($id)->delete();
    }

    public function destroy()
    {
        $this->customer->wish_lists()->delete();
    }

    public function check($id)
    {
        if ($this->customer->wish_lists()->get()->where('item_id', $id)->count() > 0) {
            return true;
        }
        return false;
    }
}