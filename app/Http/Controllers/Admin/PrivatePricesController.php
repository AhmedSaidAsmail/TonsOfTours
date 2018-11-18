<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyModels\Admin\Private_price as privates;

class PrivatePricesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id) {
        $this->validate($request, [
            'item_id' => 'required|integer'
        ]);
        try {
            privates::create($request->all());
        } catch (\Exception $e) {
            $request->session()->flash('errorDetails', $e->getMessage());
            $request->session()->flash('errorMsg', "Oops something went wrong !!");
        }
        return redirect()->route('Items.edit', ['id' => $id]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($itemID, $id) {
        $data = privates::findOrFail($id);
        return view('Admin.PrivatePriceEdit', ['itemID' => $itemID, 'price' => $data]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $itemID, $id) {

        $data   = privates::findOrFail($id);
        $update = $request->all();
        $data->update($update);
        return redirect()->route('Items.edit', ['itemID' => $itemID]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($itemID, $id) {
        $data = privates::findOrFail($id);
        $data->delete();
        return redirect()->route('Items.edit', ['itemID' => $itemID]);
    }

}