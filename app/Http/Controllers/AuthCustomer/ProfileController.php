<?php

namespace App\Http\Controllers\Auth_Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\resetEmail;
use App\Customer;
use Auth;

class ProfileController extends Controller {

    protected $redirectTo = '/home';

    public function __construct() {
//        $this->middleware('auth:customer',['except' => ['resetPassword','sendResetLink','resetPasswordBack','resetSuccess','resetPasswordFinal']]);
        $this->middleware('auth:customer', ['only' => ['showProfileForm', 'updateProfile', 'showPasswordForm', 'updatePassword','booking','bookingsItems']]);
    }

    public function showProfileForm() {
        return view('Web.11_customer_profile', ['active' => "profile"]);
    }

    public function updateProfile(Request $request) {
        $customer = Customer::find($request->id);
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
        ]);
        $customer->update($request->all());
        return redirect()->back();
    }

    public function showPasswordForm() {
        return view('Web.12_customer_password', ['active' => "password"]);
    }

    public function updatePassword(Request $request) {
        $customer = Customer::find($request->id);
        $this->validate($request, ['password' => 'required|min:6|confirmed']);
        $customer->update(['password' => bcrypt($request->password)]);
        return redirect()->back();
    }

    public function resetPassword() {
        return view('Web.13_customer_password_reset');
    }

    public function sendResetLink(Request $request) {
        $email = $request->email;
        $customer = Customer::where('email', $email)->first();
        if (count($customer) > 0) {
            $token = $customer->remember_token;
            $this->sendingResetEmail("test@sharm4all.com", $token, "Reset Your A2ZTravelMarket Password", $email);
            return redirect()->route('customer.password.reset.success');
        }
        return redirect()->back()->with('failure-email', 'Email account does not exist');
    }

    public function resetSuccess() {
        return view("Web.14_customer_password_reset_success");
    }

    public function resetPasswordBack($email, $token, $seesion_time) {
        $current_time = time();
        $timeed_passed = $current_time - $seesion_time;
        $expire_session = 60 * 15;
        if ($timeed_passed > $expire_session) {
            return redirect()->route('home')->with('expired', ' Oops your session has expired');
        }
        return view('Web.15_customer_password_reset_final', ['email' => $email, 'token' => $token]);
    }

    public function resetPasswordFinal(Request $request) {
        $this->validate($request, ['password' => 'required|min:6|confirmed']);
        $customer = Customer::where('email', $request->email)->where('remember_token', $request->token)->first();
        $customer->update(['password' => bcrypt($request->password)]);
        return redirect()->route('customer.password.reset.success')->with('sucess_reset', 'Your Password has benn reset');
    }

    private function sendingResetEmail($email, $token, $subject, $sending_mail) {
        Mail::to($sending_mail)->send(new resetEmail($email, $token, $subject, $sending_mail));
    }

    public function bookings() {
        $reservations = Auth::guard('customer')->user()->reservations()->get();
        return view('Web.19_customer_booking_all',['reservations'=>$reservations]);
    }
    public function bookingsItems($reservation_id){
        $reservations = Auth::guard('customer')->user()->reservations()->where('id',$reservation_id)->first();
        if(!is_null($reservations)){
            $tours=$reservations->tours()->get();
            return view('Web.20_customer_booking_items',['reservation'=>$reservations,'items'=>$tours]);
        }
    }


}
