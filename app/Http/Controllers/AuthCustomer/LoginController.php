<?php

namespace App\Http\Controllers\AuthCustomer;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Src\SocialMedia\FacebookLogin\FacebookSdk;
use App\Src\WishList\WishList;

class LoginController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest:customer', ['except' => 'logout']);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        $attemptArray = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];
        if (Auth::guard('customer')->attempt($attemptArray, $request->get('remember'))) {
            $this->syncWishLists();
            return redirect()->back();
        }
        return redirect()
            ->back()
            ->with('failure', sprintf('The email or password you entered isn\'t correct. If you\'ve forgotten your password, please reset it. <a href="%s">Click here</a>', route('customer.password.reset')));
    }

    /**
     * Handling login using facebook
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */

    public function facebookLogin(Request $request)
    {
        $data = FacebookSdk::getUserData($request);
        $this->validator($data);
        $id = $this->checkCustomerId($data['email']) ? $this->checkCustomerId($data['email']) : $this->createCustomer($data);

        if (Auth::guard('customer')->loginUsingId($id)) {
            $this->syncWishLists();
            return redirect()->back();
        }
        return redirect()->home()->with('failure', 'Oops! Something went wrong');
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->back();
    }

    /**
     * Validation Requested Data
     *
     * @param array $data
     * @return mixed
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email',
            'name' => 'required'
        ])->validate();
    }

    /**
     * Checking if customer is already exists
     *
     * @param $email
     * @return bool
     */
    private function checkCustomerId($email)
    {
        if (Customer::where('email', $email)->exists()) {
            return Customer::where('email', $email)->first()->id;
        }
        return false;
    }

    /**
     * Storing new customer
     *
     * @param array $data
     * @return mixed
     */
    private function createCustomer(array $data)
    {
        $password = md5(uniqid(rand(), true));
        $user = Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($password),
            'newsletter' => 1,
        ]);
        $user->information()->create([]);
        return $user->id;

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
