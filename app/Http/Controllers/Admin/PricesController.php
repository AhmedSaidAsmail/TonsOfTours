<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyModels\Admin\Price;

class PricesController extends Controller {

    public function store(Request $request, $id) {
        $this->validate($request, [
            'item_id'   => 'required|integer',
            'st_name'   => 'required',
            'st_price'  => 'required|integer',
            'sec_price' => 'integer'
        ]);
        try {
            Price::create($request->all());
        } catch (\Exception $e) {
            return redirect()->route('Items.edit', ['id' => $id])->with('error', $e->getMessage());
        }
        return redirect()->route('Items.edit', ['id' => $id]);
    }
    public function edit($itemID, $id) {
        $data = Price::findOrFail($id);
        return view('Admin.PriceEdit', ['itemID' => $itemID, 'price' => $data]);
    }
    public function update(Request $request, $itemID, $id) {
        $this->validate($request, [
            'st_name'   => 'required',
            'st_price'  => 'required|integer',
            'sec_price' => 'integer'
        ]);
        $data   = Price::findOrFail($id);
        $update = $request->all();
        $data->update($update);
        return redirect()->route('Items.edit', ['itemID' => $itemID]);
    }
    public function destroy($itemID, $id) {
        $data = Price::findOrFail($id);
        $data->delete();
        return redirect()->route('Items.edit', ['itemID' => $itemID]);
    }

}