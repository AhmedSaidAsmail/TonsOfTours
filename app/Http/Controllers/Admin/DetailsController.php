<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyModels\Admin\Detail;

class DetailsController extends Controller {

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
    public function store(Request $request, $itemID) {
        $this->validate($request, [
            'started_at'   => 'required|date_format:"H:i"',
            'availability' => 'required|min:1'
        ]);
        $data                 = $request->all();
        $data['item_id']      = $itemID;
        $data['availability'] = serialize($request->availability);
        Detail::create($data);
        return redirect()->route('Items.edit', ['item' => $itemID]);
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
    public function edit($itemId, $detail) {
        $data     = Detail::findOrFail($detail);
        $weekDays = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Thursday', 'Wednesday', 'Friday'];
        $days     = unserialize($data->availability);
        //return array_values(array_diff($weekDays, $days));
        return view('Admin.DetailsEdit', ['itemID' => $itemId, 'detail' => $data, 'days' => $days, 'week' => $weekDays]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $itemID, $detail) {
        $this->validate($request, [
            'started_at'   => 'required|date_format:"H:i"',
            'availability' => 'required|min:1'
        ]);
        $update                 = $request->all();
        $update['availability'] = serialize($request->availability);
        $data                   = Detail::findOrFail($detail);
        $data->update($update);
        return redirect()->route('Items.edit', ['itemID' => $itemID]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}