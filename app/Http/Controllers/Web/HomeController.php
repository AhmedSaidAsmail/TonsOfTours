<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyModels\Admin\Sort;
use App\MyModels\Admin\Item;
use App\MyModels\Admin\Topic;
use App\MyModels\Cart;
use App\MyModels\Admin\Transfer;
use App\Http\Controllers\Web\PaypalSettings;
use Illuminate\Support\Facades\Session;
use App\MyModels\Admin\Reservation;
use App\Http\Controllers\Web\Reservation as reservationController;
use Illuminate\Support\Facades\Mail;
use App\Mail\bookingRminder;
use App\Mail\clientMailResponse;
use App\Http\Controllers\Admin\VarsController;
use App\Http\Controllers\Web\paybalPayment;

class HomeController extends Controller
{

    protected $mail = "booking@egyptalltours.com";
//    protected $info_mail;
//    protected $name;
//    protected $web;
//    protected $mob;
    public function error404(Request $request)
    {
//        return redirect()->route('home');
        dd($request->all());
    }

    protected function catgories()
    {
        return Sort::where('status', 1)->get();
    }

    protected function get_dist_from()
    {
        return Transfer::select('dist_from')->distinct()->get();
    }

    public function welcome()
    {
        $Categories = Sort::where('status', 1)->get();
        //$welcomeCategories=
        return view('Web.welcome', ['Categories' => $Categories]);
    }

    public function allTours()
    {
        $Categories = Sort::where('status', 1)->get();
        return view('Web.allTours', ['Categories' => $Categories]);
    }

    public function topicsShow($topicName)
    {
        if (strtolower($topicName) == "home") {
            return redirect()->route('home');
        }
        $topic = urldecode($topicName);
        $topicFetch = Topic::where('name', $topic)->first();
        // transfer
        $dist_from = Transfer::select('dist_from')->distinct()->get();
        // category
        $category = Sort::where('recommended', 1)->first();
        // all categories
        $Categories = Sort::where('status', 1)->get();
        return view('Web.topicsShow', [
            'topic' => $topicFetch,
            'dist_from' => $dist_from,
            'category' => $category,
            'Categories' => $Categories]);

        //$topicName;
    }

    public function citiesShow($city, $id)
    {
        $category = Sort::where('id', $id)->first();
        $Categories = Sort::where('status', 1)->get();
        $transfer = Transfer::all();
        $dist_from = Transfer::select('dist_from')->distinct()->get();
        return view('Web.citiesShow', [
            'category' => $category,
            'city' => $city,
            'Categories' => $Categories,
            'activeLink' => $id,
            'transfers' => $transfer,
            'dist_from' => $dist_from]);
    }

    public function hotDealsShow()
    {
        $items = Item::where('offer', 1)->get();
        // transfer
        $transfer = Transfer::all();
        $dist_from = Transfer::select('dist_from')->distinct()->get();
        // category
        $category = Sort::where('recommended', 1)->first();
        // all categories
        $Categories = Sort::where('status', 1)->get();
        return view('Web.hotDeals', [
            'items' => $items,
            'transfers' => $transfer,
            'dist_from' => $dist_from,
            'category' => $category,
            'Categories' => $Categories
        ]);
    }

    public function transferShow()
    {
        // Transfer Topic
        $transferTopic = Topic::where('name', 'transfer')->first();
        // transfer
        $transfer = Transfer::all();
        $dist_from = Transfer::select('dist_from')->distinct()->get();
        // category
        $category = Sort::where('recommended', 1)->first();
        // all categories
        $Categories = Sort::where('status', 1)->get();
        return view('Web.transferShow', [
            'transfers' => $transfer,
            'dist_from' => $dist_from,
            'category' => $category,
            'Categories' => $Categories,
            'topic' => $transferTopic
        ]);
    }

    public function tourShow($city, $tour, $id)
    {
        $item = Item::find($id);
        $Categories = Sort::where('status', 1)->get();
        return view('Web.tourShow', [
            'Categories' => $Categories,
            'item' => $item]);
    }

    public function addToCart($id, Request $request)
    {
        $this->validate($request, [
            'date' => 'required',
            'st_no' => 'required|integer'
        ]);
        $item = Item::find($id);
        $price = 0;
        $oldCart = (Session::has('cart')) ? Session::get('cart') : null;
        if (isset($item->price)) {
            $price = Cart::getPrice([
                'st_no' => $request->st_no,
                'st_price' => $item->price->st_price,
                'sec_no' => $request->sec_no,
                'sec_price' => $item->price->sec_price
            ]);
        }
        $itemCart = [
            'price' => $price,
            'date' => $request->date,
            'st_no' => (int)$request->st_no,
            'st_price' => $item->price->st_price,
            'sec_no' => (int)$request->sec_no,
            'sec_price' => $item->price->sec_price
        ];
        $cart = new Cart($oldCart);
        $cart->add($itemCart, $id);
        $request->session()->put('cart', $cart);
        return redirect()->route('cart');
    }

    public function addTransferToCart(Request $request)
    {
        $price = Cart::getTransferPrice($request);
        $transferDeatils = [
            'price' => $price,
            'date' => $request->date,
            'dist_from' => $request->dist_from,
            'dist_to' => $request->dist_to,
            'transfer_type' => $request->transfer_type,
            'transfer_times' => $request->transfer_times,
            'pax' => $request->pax,
        ];
        $oldCart = (Session::has('cart')) ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->addTransfer($transferDeatils);
        $request->session()->put('cart', $cart);
        return redirect()->route('cart');
    }

    public function removeFromCart($id, Request $request)
    {
        $oldCart = (Session::has('cart')) ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove($id);
        $request->session()->put('cart', $cart);
        return redirect()->route('cart');
    }

    public function cartShow()
    {

        $oldCart = (Session::has('cart')) ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        return view('Web.shoping-cart', [
            'items' => $cart->items,
            'total' => $cart->totalPrice,
            'Categories' => $this->catgories(),
            'dist_from' => $this->get_dist_from(),
            'percent' => PaypalSettings::percentage()]);
    }

    public function checkOut()
    {
        $oldCart = (Session::has('cart')) ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $transferExist = $cart->checkTransferExist();
        $transferTimes = $cart->checkTransferTimes();
        return view('Web.CheckOut', [
            'items' => $cart->items,
            'total' => $cart->totalPrice,
            'Categories' => $this->catgories(),
            'dist_from' => $this->get_dist_from(),
            'percent' => PaypalSettings::percentage(),
            'transferExist' => $transferExist,
            'transferTimes' => $transferTimes]);
    }

    public static function vars($word)
    {
        return $word . "test";
    }

    public function searchItems(Request $request)
    {
        $text = $request->text;
        $items = Item::where('name', 'like', '%' . $text . '%')
            ->orWhere('title', 'like', '%' . $text . '%')
            ->orWhere('intro', 'like', '%' . $text . '%')
            ->get();
        return view('Web.searchResult', ["items" => $items]);
    }

    public function searchDist(Request $request)
    {
        $dist_from = $request->dist_from;
        $dist_to = Transfer::select('dist_to')->distinct()->where('dist_from', '=', $dist_from)->get();
        $result = null;
        foreach ($dist_to as $dist_to) {
            $result .= '<option value="' . $dist_to->dist_to . '">' . $dist_to->dist_to . '</option>';
        }
        return $result;
    }

    public function finalCheckOut(Request $request)
    {
        $oldCart = (Session::has('cart')) ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $reservationController = new reservationController($cart);
        $reservation = $request->all();
        $reservation['tours'] = count($reservationController->getTours());
        $reservation['transfers'] = count($reservationController->getTransfers());
        $booking = Reservation::create($reservation);
        $booking_id = $booking->id;
        $reservationController->InsertItems($booking_id);
        // if there no deposit
        if (PaypalSettings::percentage() > 0) {
            $payment = new paybalPayment($request->total, asset('booking-done'), $booking_id);
            $redirectLink = $payment->finalMethod();
            //dd($redirectLink);
            return redirect()->to($redirectLink);
        } else {
            $this->sendBookingMail($booking_id);
            $this->sendClentMail($request->f_name, $request->email);
            return redirect()->to(asset('booking-done?success=approval'));
        }
    }

    public function sendBookingMail($id)
    {
        Mail::to($this->mail)->send(new bookingRminder($id, $this->mail));
    }

    private function sendClentMail($name, $mail)
    {

        Mail::to($mail)->send(new clientMailResponse($name, VarsController::getVar('MyWebsite'), VarsController::getVar('informaion_mail'), VarsController::getVar('iformation_mob'), $this->mail));
    }

    public function bookingDone(Request $request)
    {
        $approval = $request->success;
        if ($approval == 'approval') {
            $request->session()->forget('cart');
        }
        return view('Web.BookingDone', [
            'Categories' => $this->catgories(),
            'dist_from' => $this->get_dist_from(),
            'success' => $approval]);
    }

    public function getDays($id)
    {
        $daysOff = [];
        $weekDays = [0 => "Sunday", 1 => "Monday", 2 => "Tuesday", 3 => "Thursday", 4 => "Wednesday", 5 => "Friday", 6 => "Saturday"];
        $item = Item::find($id);
        if (isset($item->detail)):
            $days = unserialize($item->detail->availability);
            $daysOff = array_diff($weekDays, $days);
            $returnDays = array_keys($daysOff);
            return json_encode($returnDays);
        else:
            return $daysOff;
        endif;
    }

}