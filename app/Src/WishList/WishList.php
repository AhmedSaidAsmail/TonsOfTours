<?php

namespace App\Src\WishList;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class WishList
{
    /**
     * @var WishListProvider $provider
     */
    protected $provider;
    /**
     * @var WishListProvider|null $session_provider
     */
    protected $session_provider = null;
    /**
     * @var WishListProvider|null $eloquent_provider
     */
    protected $eloquent_provider = null;
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * WishList constructor.
     */
    public function __construct()
    {
        $this->request = App::make('request');
        $this->session_provider = new SessionProvider($this->request);
        if (Auth::guard('customer')->check()) {
            $this->eloquent_provider = new EloquentProvider(Auth::guard('customer')->user());
        }
        $this->setProvider();
    }

    /**
     * Setting the default provider
     *
     */
    private function setProvider()
    {
        if (!is_null($this->eloquent_provider)) {
            $this->provider = $this->eloquent_provider;
            return;
        }
        $this->provider = $this->session_provider;
    }

    public function all()
    {
        return $this->provider->all();
    }

    public function add($item_id)
    {
        $this->provider->add($item_id);
    }

    public function remove($id)
    {
        $this->provider->remove($id);
    }

    public function destroy()
    {
        $this->provider->destroy();
    }

    public function check($id)
    {
        return $this->provider->check($id);
    }

    public function sync()
    {
        $sessionList = $this->session_provider->all();
        if (count($sessionList) > 0) {
            array_map(function ($item) {
                $this->eloquent_provider->add($item->item_id);
            }, $sessionList);
            $this->session_provider->destroy();
        }

    }

}