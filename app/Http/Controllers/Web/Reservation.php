<?php
namespace App\Http\Controllers\Web;

use App\MyModels\Cart;
use App\MyModels\Admin\Tour;
use App\MyModels\Admin\res_transfer;
use App\MyModels\Admin\Item;

class Reservation {

    protected $tours     = [];
    protected $transfers = [];
    public function __construct(Cart $cart) {
        foreach ($cart->items as $key => $item) {
            if (array_key_exists('dist_from', $item)) {
                $this->transfers[$key] = $item;
            } else {
                $this->tours[$key] = $item;
            }
        }
    }
    public function getTours() {
        return $this->tours;
    }
    public function getTransfers() {
        return $this->transfers;
    }
    public function InsertItems($id) {
        $this->insertTours($id)
                ->insertTransfers($id);
    }
    public function insertTours($id) {
        foreach ($this->tours as $key => $tour) {
            $item                   = Item::find($key);
            $tour['reservation_id'] = $id;
            $tour["title"]          = $item->title;
            $tour['st_name']        = $item->price->st_name;
            $tour['sec_name']       = $item->price->sec_name;
            Tour::create($tour);
        }
        return $this;
    }
    public function insertTransfers($id) {
        foreach ($this->transfers as $transfer) {
            $transfer['reservation_id'] = $id;
            $transfer['title']          = "Transfer from " . $transfer['dist_from'] . " To " . $transfer['dist_to'];
            // $transfer['child']          = (!isset($transfer['child'])) ? $transfer['child'] : 0;
            res_transfer::create($transfer);
        }
    }

}