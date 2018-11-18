<?php

namespace App\Http\Controllers\FrontEnd;

use App\Src\WishList\WishList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WishListController extends Controller
{
    public function index()
    {
        $wishLists = (new WishList())->all();
//        dd($wishLists);
        return view('frontEnd.wishList.index', ['wishLists' => $wishLists]);
    }

    public function store($item_id)
    {
        $wishList = new WishList();
        $wishList->add($item_id);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $wishList = new WishList();
        $wishList->remove($id);
        return redirect()->route('wish-list.index');
    }
}
