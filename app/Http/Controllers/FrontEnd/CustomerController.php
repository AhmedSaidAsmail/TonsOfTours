<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;

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

    /**
     * Return Customer instance
     *
     * @param Request $request
     * @return Customer
     */
    public function customerInstance(Request $request)
    {
        if ($this->checkCustomerExists($request->get('email'))) {
            return $this->create($request->all());
        }
        return $this->getCurrentCustomer($request->get('email'));

    }

    /**
     * Check if Customer exists
     *
     * @param $email
     * @return bool
     */
    private function checkCustomerExists($email)
    {
        return null == Customer::where('email', $email)->first();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return Customer
     */
    private function create(array $data)
    {
        $newsletter = isset($data['newsletter']) ? 1 : 0;
        $user = Customer::create([
            'name' => $data['first_name'] . " " . $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt(md5(uniqid(rand(), true))),
            'newsletter' => $newsletter,
        ]);
        $user->information()->create(['phone' => $data['phone']]);
        return $user;
    }

    /**
     * Getting the current customer with the same email
     *
     * @param $email
     * @return mixed
     */
    private function getCurrentCustomer($email)
    {
        return Customer::where('email', $email)->first();

    }


}
