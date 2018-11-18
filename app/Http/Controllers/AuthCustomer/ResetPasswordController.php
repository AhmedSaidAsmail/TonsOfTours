<?php

namespace App\Http\Controllers\AuthCustomer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerPasswordReset;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMail;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Displaying Reset Password form
     *
     * @return \Illuminate\Http\Response
     */
    public function passwordReset()
    {
        return view('frontEnd.customer.passwordReset');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function passwordResetEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);
        $email = $request->get('email');
        if (!$this->emailExists($email)) {
            return redirect()->back()->with('failure', 'this email is not exists');
        }
        $customer = Customer::where('email', $email)->first();
        $unique_id = md5(uniqid(rand(), true));
        Mail::to($email)->send(new PasswordResetMail(env('NO_REPLAY_MAIL'), $unique_id, $email));
        CustomerPasswordReset::create(['email' => $email, 'unique_id' => $unique_id]);
        return redirect()
            ->route('customer.password.reset.success', ['email' => $email, 'token' => $customer->remember_token]);
    }

    /**
     * Notify status of password sending link
     *
     * @param $email
     * @param $token
     * @return \Illuminate\Http\Response |\Illuminate\Http\RedirectResponse
     */
    public function passwordResetEmailSuccess($email, $token)
    {
        $customer = Customer::where('email', $email)->where('remember_token', $token)->first();
        if (!is_null($customer)) {
            return view('frontEnd.customer.successSendingMail');
        }
        return redirect()->route('home')->with('failure', 'This link is not a valid link');
    }

    /**
     * Checking the validate of email back link
     *
     * @param $email
     * @param $unique_id
     * @return \Illuminate\Http\Response
     */
    public function emailBack($email, $unique_id)
    {
        $password_reset = CustomerPasswordReset::where('email', $email)
            ->where('unique_id', $unique_id)->first();
        if (is_null($password_reset)) {
            return redirect()->route('home')->with('failure', 'This link is not valid link');
        }
        if ($this->checkLinkTimedOut($password_reset)) {
            Auth::guard('customer')->loginUsingId($this->getCustomerId($email));
            return redirect()->route('customer.password');
        }
        return redirect()->route('home')->with('failure', 'This link is not valid link');
    }

    private function emailExists($email)
    {
        return Customer::where('email', $email)->count();
    }

    /**
     * Check link time out
     *
     * @param CustomerPasswordReset $passwordReset
     * @return bool
     */
    private function checkLinkTimedOut(CustomerPasswordReset $passwordReset)
    {
        $created_at = Carbon::parse($passwordReset->created_at);
        $time_out = $created_at->diffInHours(Carbon::now());
        if ($time_out > 1) {
            return false;
        }
        return true;
    }

    /**
     * Getting customer user id
     *
     * @param $email
     * @return mixed
     */
    private function getCustomerId($email)
    {
        return Customer::where('email', $email)->first()->id;
    }
}
