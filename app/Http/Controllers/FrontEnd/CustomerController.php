<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function showSetting()
    {
        $customer = Auth::guard('customer')->user();
        return view('frontEnd.customer.setting', ['customer' => $customer]);
    }

    public function updateSetting(Request $request)
    {
        $data = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'name' => 'required'
        ]);
        Auth::guard('customer')->user()->update($data);
        Auth::guard('customer')->user()->information()->update($data['information']);
        return redirect()->back();

    }

    public function showPasswordForm()
    {
        return view('frontEnd.customer.password');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed'
        ]);
        $password = bcrypt($request->get('password'));
        Auth::guard('customer')->user()->update(['password' => $password]);
        return redirect()->back()->with('success', 'Password has been updated');

    }

    public function passwordReset()
    {
        return view('frontEnd.customer.passwordReset');
    }

    public function passwordResetEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);
        $email = $request->get('email');
        if (!$this->emailExists($email)) {
            return redirect()->back()->with('failure', 'this email is not exists');
        }
    }

    private function emailExists($email)
    {
        return Customer::where('email', $email)->count();
    }
}
