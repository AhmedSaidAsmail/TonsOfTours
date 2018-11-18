<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyModels\Admin\Paypal_setting;

class PaypalController extends Controller {

    public function index() {
        $paypal = Paypal_setting::all();
        return view('Admin.Paypal', ['paypal' => $paypal]);
    }
    public function store(Request $request) {
        $this->validate($request, [
            'acount_id'      => 'required',
            'secret_id'      => 'required',
            'pay_percentage' => 'required|integer'
        ]);
        $paypal = Paypal_setting::all();
        try {
            Paypal_setting::create($request->all());
        } catch (\Exception $e) {
            return redirect()->route('Paypal.index')->with('error', $e->getMessage());
        }
        return redirect()->route('Paypal.index', ['paypal' => $paypal]);
    }
    public function update(Request $request, $id) {
        $this->validate($request, [
            'acount_id'      => 'required',
            'secret_id'      => 'required',
            'pay_percentage' => 'required|integer'
        ]);
        $paypal         = Paypal_setting::all();
        $paypal_setting = Paypal_setting::findOrFail($id);
        $update         = $request->all();
        $paypal_setting->update($update);
        return redirect()->route('Paypal.index', ['paypal' => $paypal]);
    }
    public function destroy($id) {
        $paypal_setting = Paypal_setting::findOrFail($id);
        $paypal_setting->delete();
        $paypal         = Paypal_setting::all();
        return redirect()->route('Paypal.index', ['paypal' => $paypal]);
    }

}