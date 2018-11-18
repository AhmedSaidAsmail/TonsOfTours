<?php

namespace App\Src\WishList;


use App\Models\Item;

class SessionItem
{
    public $id;
    public $item_id;
    public $item;

    public function __construct($item_id)
    {
        $this->id = $item_id;
        $this->item_id = $item_id;
        $this->item = $this->setItemModel($item_id);
    }

    /**
     * @param $item_id
     * @return Item
     */
    private function setItemModel($item_id)
    {
        return Item::findOrFail($item_id);
    }

}