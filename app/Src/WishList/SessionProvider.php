<?php

namespace App\Src\WishList;

use Illuminate\Http\Request;

class SessionProvider implements WishListProvider
{
    /**
     * @var SessionCollection
     */
    private $current;
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        if ($request->session()->has('wish_list')) {
            $this->current = $request->session()->get('wish_list');
        } else {
            $this->current = new SessionCollection();
        }
        $this->request = $request;

    }

    public function all()
    {
        return $this->current->all();
    }

    public function add($item_id)
    {
        $collection = $this->current->add($item_id);
        $this->request->session()->put('wish_list', $collection);
    }

    public function remove($id)
    {
        $collection = $this->current->remove($id);
        $this->request->session()->put('wish_list', $collection);
    }

    public function destroy()
    {
        $this->request->session()->put('wish_list', null);
    }

    public function check($id)
    {
        return $this->current->check($id);
    }
}