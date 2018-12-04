<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Paypal;

class PaymentPaypalController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'client_id' => 'required',
            'secret' => 'required',
            'description' => 'required'
        ]);
        $data = $request->all();
        $data['sandbox'] = array_key_exists('sandbox', $data) ? $data['sandbox'] : 0;
        try {
            Paypal::create($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('failure', $e->getMessage());
        }
        return redirect()->back()->with('success', 'Paypal has been set');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'client_id' => 'required',
            'secret' => 'required',
            'description' => 'required'
        ]);
        $data = $request->all();
        $data['sandbox'] = array_key_exists('sandbox', $data) ? $data['sandbox'] : 0;
        $paypal = Paypal::find($id);
        try {
            $paypal->update($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('failure', $e->getMessage());
        }
        return redirect()->back()->with('success', 'Paypal has been set');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paypal = Paypal::find($id);
        $paypal->delete();
        return redirect()->back()->with('success', 'Paypal has been destroyed');
    }
}
