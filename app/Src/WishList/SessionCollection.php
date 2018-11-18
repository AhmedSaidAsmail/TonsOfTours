<?php

namespace App\Src\WishList;

class SessionCollection
{
    /**
     * @var SessionItem[]
     */
    private $collection = [];

    /**
     * @return SessionItem[]
     */
    public function all()
    {
        return $this->collection;
    }

    /**
     * @param $item_id
     * @return $this
     */
    public function add($item_id)
    {
        $this->collection[$item_id] = new SessionItem($item_id);
        return $this;

    }

    /**
     * @param $id
     * @return $this
     */
    public function remove($id)
    {
        if (array_key_exists($id, $this->collection)) {
            unset($this->collection[$id]);
        }
        return $this;
    }

    /**
     * @param $id
     * @return bool
     */
    public function check($id)
    {
        if (array_key_exists($id, $this->collection)) {
            return true;
        }
        return false;
    }

}