<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TwoCheckOut;

class PaymentTwoCheckoutController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'partner_id' => 'required',
            'public_key' => 'required',
            'private_key' => 'required'
        ]);
        $data = $request->all();
        $data['sandbox'] = array_key_exists('sandbox', $data) ? $data['sandbox'] : 0;
        $data['ssl'] = array_key_exists('ssl', $data) ? $data['ssl'] : 0;
        try {
            TwoCheckOut::create($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('failure', $e->getMessage());
        }
        return redirect()->back()->with('success', '2 Checkout has been set');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'partner_id' => 'required',
            'public_key' => 'required',
            'private_key' => 'required'
        ]);
        $data = $request->all();
        $data['sandbox'] = array_key_exists('sandbox', $data) ? $data['sandbox'] : 0;
        $data['ssl'] = array_key_exists('ssl', $data) ? $data['ssl'] : 0;
        $two_checkout = TwoCheckOut::find($id);
        try {
            $two_checkout->update($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('failure', $e->getMessage());
        }
        return redirect()->back()->with('success', '2 Checkout has been set');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $two_checkout = TwoCheckOut::find($id);
        $two_checkout->delete();
        return redirect()->back()->with('success', 'Paypal has been destroyed');
    }
}
