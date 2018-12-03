<?php

namespace App\Http\Controllers\AuthCustomer;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Src\WishList\WishList;

class RegisterController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:customer');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('frontEnd.customer.registration');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $data = $request->all();
        $this->validator($data);
        event(new Registered($user = $this->create($data)));
        Auth::guard('customer')->attempt(['email' => $data['email'], 'password' => $data['password']], 1);
        $this->syncWishLists();
        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:customers',
            'password' => 'required|min:6|confirmed',
        ])->validate();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return Customer
     */
    protected function create(array $data)
    {
        $newsletter = isset($data['newsletter']) ? 1 : 0;
        $user = Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'newsletter' => $newsletter,
        ]);
        $user->information()->create([]);
        return $user;
    }

    /**
     * Syncing the wish lists exists in session to eloquent storage
     */
    private function syncWishLists()
    {
        $wishLists = new WishList();
        $wishLists->sync();
    }

}
