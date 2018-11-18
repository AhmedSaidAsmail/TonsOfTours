<?php
namespace App\MyModels;

use Illuminate\Http\Request;
use App\MyModels\Admin\Transfer;

class Cart {

    public $items      = null;
    public $totalQty   = 0;
    public $totalPrice = 0;
    public function __construct($oldCart) {
        if (isset($oldCart)) {
            $this->items      = $oldCart->items;
            $this->totalQty   = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }
    public function add($item, $id) {
        if (isset($this->items) && array_key_exists($id, $this->items)) {
            // remove ex item price from total
            $this->totalPrice -= $this->items[$id]['price'];
        } else {
            $this->totalQty++;
        }
        $this->items[$id] = $item;
        $this->totalPrice += $item['price'];
    }
    public function addTransfer($transferArray) {
        $this->totalQty++;
        $this->items[]    = $transferArray;
        $this->totalPrice += $transferArray['price'];
    }
    public function remove($id) {
        if (isset($this->items) && array_key_exists($id, $this->items)) {
            $this->totalPrice -= $this->items[$id]['price'];
            $this->totalQty--;
            unset($this->items[$id]);
        }
    }
    public static function getPrice(array $prices) {
        $price = 0;
        $price += ($prices['st_no'] * $prices['st_price']);
        $price += (isset($prices['sec_no']) && isset($prices['sec_price'])) ? ($prices['sec_no'] * $prices['sec_price']) : 0;
        return $price;
    }
    public static function getTransferPrice(Request $request) {
        $indvidualPrice = self::getTranfer($request->dist_from, $request->dist_to, $request->transfer_type);
        $price          = $indvidualPrice * $request->transfer_times;
        return $price;
    }
    public static function getTranfer($dist_from, $dist_to, $transfer_type) {
        $transfer = Transfer::where([
                    ['dist_from', '=', $dist_from],
                    ['dist_to', '=', $dist_to]])->first();
        return $transfer->$transfer_type;
    }
    public function checkTransferExist() {
        if (isset($this->items)) {
            foreach ($this->items as $item) {
                if (isset($item["dist_from"])) {
                    return TRUE;
                }
            }
        }
    }
    public function checkTransferTimes() {
        if (isset($this->items)) {
            foreach ($this->items as $item) {
                if (isset($item["transfer_times"]) && $item["transfer_times"] == 2) {
                    return TRUE;
                }
            }
        }
    }

}