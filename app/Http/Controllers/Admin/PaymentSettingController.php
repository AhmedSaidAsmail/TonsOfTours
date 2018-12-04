<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentSetting;
use App\Models\Paypal;
use App\Models\TwoCheckOut;

class PaymentSettingController extends Controller
{
    const currencies = [
        '$' => 'USD',
        '€' => 'EUR',
        '£' => 'GBP'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_setting = PaymentSetting::first();
        $paypal = Paypal::first();
        $two_checkout = TwoCheckOut::first();
        return view('Admin._settings.payment.index', [
            'payment_setting' => $payment_setting,
            'paypal' => $paypal,
            'two_checkout' => $two_checkout,
            'currencies' => self::currencies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'default_percentage' => 'required|integer|min:1',
            'currency' => 'required'
        ]);
        $data = $request->all();
        $data['currency_symbol'] = $data['currency'];
        $data['currency'] = self::currencies[$data['currency']];
        try {
            PaymentSetting::create($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('failure', $e->getMessage());
        }
        return redirect()->back()->with('success', 'Deposit has been set');
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
            'default_percentage' => 'required|integer|min:1',
            'currency' => 'required'
        ]);
        $data = $request->all();
        $data['currency_symbol'] = $data['currency'];
        $data['currency'] = self::currencies[$data['currency']];
        $payment_setting = PaymentSetting::find($id);
        try {
            $payment_setting->update($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('failure', $e->getMessage());
        }
        return redirect()->back()->with('success', 'Deposit has been set');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment_setting = PaymentSetting::find($id);
        $payment_setting->delete();
        return redirect()->back()->with('success', 'Deposit has been destroyed');
    }
}
