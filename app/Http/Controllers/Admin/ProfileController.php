<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function showProfileForm()
    {
        $user = Auth::guard('web')->user();
        return view('Admin._settings.adminProfile.update_profile_form', ['user' => $user]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::guard('web')->user();
        $this->validator($request);
        $this->validateEmail($request, $user);
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        try {
            $user->update($data);
        } catch (Exception $e) {
            return redirect()->back()->with('failure', $e->getMessage());
        }
        return redirect()->back()->with('success', 'Your profile has been updated');
    }

    /**
     * Validate Form
     *
     * @param Request $request
     * @return mixed
     */
    private function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required',
            'password' => 'required|min:4|confirmed'
        ])->validate();

    }

    /**
     * Validate Email if its changed
     *
     * @param Request $request
     * @param User $user
     * @return mixed
     */
    private function validateEmail(Request $request, User $user)
    {
        if ($user->email != $request->get('email')) {
            return Validator::make($request->all(), [
                'email' => 'required|email|max:255|unique:users'
            ])->validate();

        }
    }

}
