<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyModels\Admin\Transfer;
use Illuminate\Support\Facades\Session;

class TransferController extends Controller {

    public function index() {
        $transfers = Transfer::all();
        return view('Admin.Transfers', ['transfers' => $transfers]);
    }
    public function store(Request $request) {

        $insert = $request->all();
        try {
            Transfer::create($insert);
        } catch (\Exception $e) {
            $request->session()->flash('errorDetails', $e->getMessage());
            $request->session()->flash('errorMsg', "Oops something went wrong !!");
        }
        return redirect()->route('Transfers.index');
    }
    public function edit($id) {
        $transfer = Transfer::find($id);
        return view('Admin.TransferEdit', ['transfer' => $transfer]);
    }
    public function update(Request $request, $id) {
        $transfer = Transfer::find($id);
        $update   = $request->all();
        $transfer->update($update);
        return redirect()->route('Transfers.index');
    }
    public function destroy($id) {
        $transfer = Transfer::find($id);
        $transfer->delete();
        Session::flash('deleteStatus', "Category No: {$id} is Deleted !!");
        return redirect()->route('Transfers.index');
    }

}