<?php

namespace App\Src\WishList;


interface WishListProvider
{
    public function all();

    public function add($item_id);

    public function remove($id);

    public function destroy();

    public function check($id);

}